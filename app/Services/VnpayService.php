<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

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

            ksort($data);

            $query = http_build_query($data);

            $secureHash = hash_hmac('sha512', $query, config('vnpay.vnp_HashSecret'));

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
            $vnp_SecureHash = $request['vnp_SecureHash'] ?? null;
            unset($request['vnp_SecureHash']);
            ksort($request);

            $secureHash = hash_hmac('sha512', http_build_query($request), config('vnpay.vnp_HashSecret'));

            $view = 'web.payment.payment_failed';

            if ($secureHash != $vnp_SecureHash)
                return [
                    'view' => $view,
                    'data' => null,
                    'status' => 400,
                    'message' => 'Giao dịch không hợp lệ',
                ];

            $payment = $this->paymentService->findByVnpTxnRef($request['vnp_TxnRef']);

            $newStatus = $request['vnp_ResponseCode'] === '00' ? 'success' : 'failed';
            $oldStatus = $payment->status;

            $this->paymentService->update([
                'id' => $payment->id,
                'status' => $newStatus,
                'vnp_ResponseCode' => $request['vnp_ResponseCode'],
                'vnp_TransactionNo' => $request['vnp_TransactionNo'] ?? null,
                'vnp_BankCode' => $request['vnp_BankCode'] ?? null,
            ]);

            $this->paymentLogService->store([
                'id_payment' => $payment->id,
                'old_status' => $oldStatus,
                'new_status' => $newStatus,
                'note' => json_encode($request),
            ]);

            if ($newStatus == 'success') {
                $this->orderService->update([
                    'id' => $payment->order->id,
                    'status' => 'paid',
                ]);

                $view = 'web.payment.payment_success';
                $message = 'Giao dịch thành công';
                $status = 200;
            } else {
                $view = 'web.payment.payment_failed';
                $message = 'Giao dịch không thành công';
                $status = 201;
            }
            return [
                'view' => $view,
                'data' => $request,
                'status' => $status,
                'message' => $message,
            ];
        });
    }
}
