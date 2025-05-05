<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Str;

class VnpayService extends BaseService
{
    protected $orderService;
    protected $paymentService;
    protected $paymentLogService;
    protected $userRoleService;
    protected $documentService;
    public function __construct()
    {
        $this->documentService = app(DocumentService::class);
        $this->userRoleService = app(UserRoleService::class);
        $this->paymentLogService = app(PaymentLogService::class);
        $this->paymentService = app(PaymentService::class);
        $this->orderService = app(OrderService::class);
    }

    public function createPaymentUrl(array $request)
    {
        return $this->tryThrow(function () use ($request) {
            $maxOrderID = $this->orderService->maxId();
            $orderCode = "ORDER" . ($maxOrderID + 1) . date("dmYHis");
          
            $order = $this->orderService->store([
                'id_user' => auth('api')->id(),
                'order_code' => $orderCode,
                'total_amount' => $request['total'],
                'status' => 'pending',
            ]);

            $payment = $this->paymentService->store([
                'id_order' => $order->id,
                'vnp_TxnRef' => $orderCode,
                'vnp_Amount' => $request['total'],
                'status' => 'pending',
            ]);

            $data = [
                'vnp_Version' => '2.1.0',
                'vnp_TmnCode' => config('vnpay.vnp_TmnCode'),
                'vnp_Amount' => $payment->vnp_Amount * 100,
                'vnp_Command' => 'pay',
                'vnp_CreateDate' => now()->format('YmdHis'),
                'vnp_CurrCode' => 'VND',
                'vnp_IpAddr' => Http::get('https://api64.ipify.org?format=json')->json()['ip'],
                'vnp_Locale' => 'vn',
                'vnp_OrderInfo' => $request['info'],
                'vnp_OrderType' => $request['type'],
                'vnp_ReturnUrl' => $request['return_url'] ?? route('vnpay.return'),
                'vnp_TxnRef' => $payment->vnp_TxnRef,
            ];

            $make = $this->makeHashHtttQuery($data);
            $query = $make['query'];
            $secureHash = $make['secureHash'];
            $url = config('vnpay.vnp_Url') . '?' . $query . '&vnp_SecureHash=' . $secureHash;
            Log::info('createPaymentUrl payload:', [$url]);

            return [
                'order' => $order,
                'payment' => $payment,
                'url' => $url,
            ];
        });
    }

    public function vnpayReturn(array $request)
    {
        return $this->tryThrow(function () use ($request) {
            $format = $this->formatVnpayRequest($request);
            $request = $format['request'];
            $vnpSecureHash = $format['vnpSecureHash'];

            $make = $this->makeHashHtttQuery($request);
            $secureHash = $make['secureHash'];

            if ($secureHash != $vnpSecureHash)
                return [
                    'data' => null,
                    'status' => 400,
                    'message' => 'Giao dịch không hợp lệ',
                ];

            $success = $request['vnp_ResponseCode'] == '00';

            return [
                'data' => $request,
                'status' => $success ? 200 : 201,
                'message' => $success ? 'Giao dịch thành công' : 'Giao dịch thất bại',
            ];
        });
    }

    protected function makeHashHtttQuery(array $data)
    {
        ksort($data);
        $query = http_build_query($data);
        return [
            'query' => $query,
            'secureHash' => hash_hmac('sha512', $query, config('vnpay.vnp_HashSecret')),
        ];
    }

    protected function formatVnpayRequest(array $request)
    {
        $vnpSecureHash = $request['vnp_SecureHash'] ?? null;
        unset($request['vnp_SecureHash']);
        return [
            'vnpSecureHash' => $vnpSecureHash,
            'request' => $request,
        ];
    }

    public function vnpayIpn(array $request)
    {
        return $this->tryThrow(function () use ($request) {
            Log::info('VNPAY IPN payload:', $request);

            $format = $this->formatVnpayRequest($request);
            $request = $format['request'];
            $vnpSecureHash = $format['vnpSecureHash'];

            $make = $this->makeHashHtttQuery($request);
            $secureHash = $make['secureHash'];

            if ($secureHash != $vnpSecureHash)
                return [
                    'RspCode' => '97',
                    'Message' => 'Invalid checksum',
                ];

            $payment = $this->paymentService->findByVnpTxnRef($request['vnp_TxnRef']);
            if (! $payment)
                return [
                    'RspCode' => '01',
                    'Message' => 'Order not found',
                ];

            $amount = $request['vnp_Amount'] / 100;
            if ($amount != $payment->vnp_Amount)
                return [
                    'RspCode' => '04',
                    'Message' => 'Invalid amount',
                ];

            if ($payment->status == 'success') {
                return [
                    'RspCode' => '02',
                    'Message' => 'Order already confirmed',
                ];
            }

            if ($payment->status == 'pending') {
                $newStatus = $request['vnp_ResponseCode'] == '00' ? 'success' : 'failed';
                $this->paymentService->update([
                    'id' => $payment->id,
                    'status' => $newStatus,
                    'vnp_ResponseCode' => $request['vnp_ResponseCode'],
                    'vnp_TransactionNo' => $request['vnp_TransactionNo'] ?? null,
                    'vnp_BankCode' => $request['vnp_BankCode'] ?? null,
                ]);

                if ($newStatus == 'success') {
                    $this->orderService->update([
                        'id' => $payment->order->id,
                        'status' => 'paid',
                    ]);

                    $this->handleAfterPaySuccess($payment->order);
                }

                $this->paymentLogService->store([
                    'id_payment' => $payment->id,
                    'old_status' => 'pending',
                    'new_status' => $newStatus,
                    'note' => json_encode($request),
                ]);
            }

            return [
                'RspCode' => '00',
                'Message' => 'Confirm Success',
            ];
        });
    }

    protected function handleAfterPaySuccess($order)
    {
        if ($order->orderUserRole && $order->orderUserRole->count() > 0)
            $this->userRoleService->vnpayIpn($order);

        if ($order->orderDocument && $order->orderDocument->count() > 0)
            $this->documentService->vnpayIpn($order);
    }
}
