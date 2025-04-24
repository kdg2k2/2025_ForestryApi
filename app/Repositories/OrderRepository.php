<?php

namespace App\Repositories;

use App\Models\Order;

class OrderRepository
{
    public function store(array $request)
    {
        return Order::create($request);
    }
}
