<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\OrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $orderService;
    public function __construct()
    {
        $this->orderService = app(OrderService::class);
    }
    public function order($orderCode)
    {
        return $this->catchAPI(function() use ($orderCode) {
            $order = $this->orderService->findByOrderCode($orderCode);
            return response()->json(['data' => $order]);
        });
    }
}
