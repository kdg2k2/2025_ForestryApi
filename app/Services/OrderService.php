<?php

namespace App\Services;

use App\Repositories\OrderRepository;

class OrderService extends BaseService
{
    protected $orderRepository;
    public function __construct()
    {
        $this->orderRepository = app(OrderRepository::class);
    }

    public function store(array $request)
    {
        return $this->tryThrow(function () use ($request) {
            return $this->orderRepository->store($request);
        });
    }
}
