<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Checkout\StoreRequest;
use App\Services\CheckoutService;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    protected $checkoutService;
    public function __construct()
    {
        $this->checkoutService = app(CheckoutService::class);
    }
    public function checkout(StoreRequest $request)
    {
        $this->checkoutService->checkout(auth('api')->id(), $request->validated());
        return response()->json([
            'message' => 'Checkout successful',
        ]);
    }
}
