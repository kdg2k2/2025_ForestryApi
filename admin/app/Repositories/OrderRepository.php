<?php

namespace App\Repositories;

use App\Models\Order;

class OrderRepository
{
    public function store(array $request)
    {
        return Order::create($request);
    }

    public function update(array $request)
    {
        $record = Order::find($request["id"]);
        $record->update($request);
        return $record;
    }

    public function maxId()
    {
        return Order::max("id");
    }

    public function findByOrderCode(string $orderCode)
    {
        return Order::where("order_code", $orderCode)->first();
    }
}
