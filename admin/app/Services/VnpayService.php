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
    public function __construct()
    {
        $this->paymentLogService = app(PaymentLogService::class);
        $this->paymentService = app(PaymentService::class);
        $this->orderService = app(OrderService::class);
    }

    public function createPaymentUrl(array $request)
    {
        return $this->tryThrow(function () use ($request) {
            $maxOrderID = $this->orderService->maxId();
            $orderCode = "ORDER" . ($maxOrderID + 1);
            if (isset($request['order_code']))
                $orderCode = $request['order_code'];
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
                'vnp_NotifyUrl' => route('vnpay.ipn'),
            ];

            $make = $this->makeHashHtttQuery($data, false);
            $query = $make['query'];
            $secureHash = $make['secureHash'];

            return [
                'order' => $order,
                'payment' => $payment,
                'url' => config('vnpay.vnp_Url') . '?' . $query . '&vnp_SecureHash=' . $secureHash,
            ];
        });
    }

    public function vnpayReturn(array $request)
    {
        return $this->tryThrow(function () use ($request) {
            $vnpSecureHash = $request['vnp_SecureHash'] ?? null;
            unset($request['vnp_SecureHash']);

            $make = $this->makeHashHtttQuery($request);
            $secureHash = $make['secureHash'];

            $view = 'web.payment.payment_failed';

            if ($secureHash != $vnpSecureHash)
                return [
                    'view' => $view,
                    'data' => null,
                    'status' => 400,
                    'message' => 'Giao dịch không hợp lệ',
                ];

            $success = $request['vnp_ResponseCode'] == '00';

            return [
                'view' => $view,
                'data' => $request,
                'status' => $success ? 200 : 201,
                'message' => $success ? 'Giao dịch thành công' : 'Giao dịch thất bại',
            ];
        });
    }

    protected function makeHashHtttQuery(array $data, bool $urldecode = true)
    {
        ksort($data);
        $query = http_build_query($data);
        if ($urldecode == true)
            $query = urlencode($query);
        return [
            'query' => $query,
            'secureHash' => hash_hmac('sha512', $query, config('vnpay.vnp_HashSecret')),
        ];
    }

    public function vnpayIpn(array $request)
    {
        return $this->tryThrow(function () use ($request) {
            Log::info('VNPAY IPN payload:', $request);

            $vnpSecureHash = $request['vnp_SecureHash'] ?? '';
            unset($request['vnp_SecureHash'], $request['vnp_SecureHashType']);

            $make = $this->makeHashHtttQuery($request);
            $secureHash = $make['secureHash'];

            if ($secureHash !== $vnpSecureHash)
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

            if ($payment->status == 'pending') {
                $newStatus = $request['vnp_ResponseCode'] == '00' ? 'success' : 'failed';
                $this->paymentService->update([
                    'id' => $payment->id,
                    'status' => $newStatus,
                    'vnp_ResponseCode' => $request['vnp_ResponseCode'],
                    'vnp_TransactionNo' => $request['vnp_TransactionNo'] ?? null,
                    'vnp_BankCode' => $request['vnp_BankCode'] ?? null,
                ]);

                if ($newStatus == 'success')
                    $this->orderService->update([
                        'id' => $payment->order->id,
                        'status' => 'paid',
                    ]);

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
}
