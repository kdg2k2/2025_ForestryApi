<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\VnpayService;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    protected $vnpService;

    public function __construct()
    {
        $this->vnpService = app(VnpayService::class);
    }

    public function vnpayReturn(Request $request)
    {
        $vnpResponse = $this->vnpService->vnpayReturn($request->all());
        return redirect()->route('admin.checkout.order', $vnpResponse['data']['vnp_TxnRef']);
    }

    public function order($orderCode)
    {
        return view('admin.pages.checkout.order');
    }
}
