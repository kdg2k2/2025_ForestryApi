<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class VnpayService extends BaseService
{
    public function createPaymentUrl(array $order)
    {
        return $this->tryThrow(function () use ($order) {
            $data = [
                'vnp_Version'    => '2.1.0',
                'vnp_TmnCode'    => config('vnpay.vnp_TmnCode'),
                'vnp_Amount'     => $order['total'] * 100,
                'vnp_Command'    => 'pay',
                'vnp_CreateDate' => now()->format('YmdHis'),
                'vnp_CurrCode'   => 'VND',
                'vnp_IpAddr'     => Http::get('https://api64.ipify.org?format=json')->json()['ip'],
                'vnp_Locale'     => 'vn',
                'vnp_OrderInfo'  => $order['info'],
                'vnp_OrderType'  => $order['type'],
                'vnp_ReturnUrl'  => route('vnpay.return'),
                'vnp_TxnRef'     => $order['code'],
            ];

            ksort($data);

            $query = http_build_query($data);

            $secureHash = hash_hmac('sha512', $query, config('vnpay.vnp_HashSecret'));

            return config('vnpay.vnp_Url') . '?' . $query . '&vnp_SecureHash=' . $secureHash;
        });
    }

    public function vnpayReturn(array $request)
    {
        return $this->tryThrow(function () use ($request) {
            $vnp_SecureHash = $request['vnp_SecureHash'];

            unset($request['vnp_SecureHash']);
            ksort($request);

            $secureHash = hash_hmac('sha512', http_build_query($request), config('vnpay.vnp_HashSecret'));

            $view = 'web.payment.payment_failed';

            if ($secureHash != $vnp_SecureHash)
                return [
                    'view' => $view,
                    'data' => null,
                    'status' => 400,
                ];

            if ($request['vnp_ResponseCode'] == '00')
                $view = 'web.payment.payment_success';

            return [
                'view' => $view,
                'data' => $request,
                'status' => 200,
            ];
        });
    }
}
