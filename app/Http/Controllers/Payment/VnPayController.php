<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Services\VnpayService;
use Illuminate\Http\Request;

class VnPayController extends Controller
{
    protected $vnPayService;
    public function __construct()
    {
        $this->vnPayService = app(VnpayService::class);
    }

    public function createPayment()
    {
        $order = [
            'code' => 'ORDER' . random_int(100000, 999999),
            'total' => 100000,
            'bankCode' => 'NCB',
            'type' => 'billpayment',
            'info' => 'Thanh toán đơn hàng',
        ];

        $url = $this->vnPayService->createPaymentUrl($order);
        return redirect($url);
    }

    public function vnpayReturn(Request $request)
    {
        $res = $this->vnPayService->vnpayReturn($request->all());
        if (!empty($res['data']))
            return view($res['view'], [
                'inputData' => $res['data']
            ]);
        return view($res['view']);
    }
}
