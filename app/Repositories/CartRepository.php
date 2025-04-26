<?php

namespace App\Repositories;

use App\Models\Cart;

class CartRepository
{
    public function store(array $request)
    {
        return Cart::create($request);
    }
}
