<?php

namespace App\Services;

use App\Repositories\CartRepository;
use App\Repositories\OrderRepository;
use Illuminate\Support\Facades\Log;

class CheckoutService
{
    protected $orderRepository;
    protected $cartRepository;

    public function __construct()
    {
        $this->orderRepository = app(OrderRepository::class);
        $this->cartRepository = app(CartRepository::class);
    }
    public function checkout(int $userId, array $request)
    {
        $cartItems = $this->cartRepository->getCartItems($userId, $request['cart_ids']);
        $totalPrice = 0;
        $idDocument = [];
        foreach ($cartItems as $item) {
            $totalPrice += $item->price * $item->quantity;
            Log::info($item);
        }
        //  Create order
        // $order = $this->orderRepository->store([
        //     "user_id" => $userId,
        //     "order_code" => $this->generateRandomCode(),
        //     "total_amount" => $totalPrice,
        //     "status" => 'pending',
        // ]);
    }

    protected function generateRandomCode($length = 16) {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $charactersLength = strlen($characters);
        $randomCode = '';

        for ($i = 0; $i < $length; $i++) {
            $randomCode .= $characters[rand(0, $charactersLength - 1)];
        }

        return $randomCode;
    }
}
