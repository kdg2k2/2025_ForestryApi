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
            'total' => 100000,
            'type' => 'billpayment',
            'info' => 'Thanh toán đơn hàng',
        ];

        $res = $this->vnPayService->createPaymentUrl($order);
        return redirect($res['url']);
    }

    public function vnpayReturn(Request $request)
    {
        $res = $this->vnPayService->vnpayReturn($request->all());
        return empty($res['data'])
            ? view($res['view'])
            : view($res['view'], ['inputData' => $res['data']]);
    }

    public function vnpayIpn(Request $request)
    {
        $res = $this->vnPayService->vnpayIpn($request->all());
        return response()->json([
            'RspCode' => $res['RspCode'],
            'Message' => $res['Message'],
        ], 200);
    }
}
