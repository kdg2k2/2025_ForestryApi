<?php

namespace App\Repositories;

use App\Models\Cart;

class CartRepository
{
    public function store(array $request)
    {
        return Cart::create($request);
    }


    public function deleteCartItems($userId, array $cartIds = [])
    {
        $cart = Cart::where('user_id', $userId)->first();
        return $cart->items()->whereIn('id', $cartIds)->delete();
    }
}
