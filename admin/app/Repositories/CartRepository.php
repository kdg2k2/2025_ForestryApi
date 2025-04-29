<?php

namespace App\Repositories;

use App\Models\Cart;

class CartRepository
{
    public function store(array $request)
    {
        return Cart::create($request);
    }

    public function getCartItems($userId, array $cartIds = [])
    {
        return Cart::where('user_id', $userId)
            ->when($cartIds, function ($query) use ($cartIds) {
                return $query->whereIn('id', $cartIds);
            })
            ->get();
    }
}
