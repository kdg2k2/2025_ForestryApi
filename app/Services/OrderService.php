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

    public function update(array $request)
    {
        return $this->tryThrow(function () use ($request) {
            return $this->orderRepository->update($request);
        });
    }

    public function maxId()
    {
        return $this->tryThrow(function () {
            return $this->orderRepository->maxId();
        });
    }

    public function findByOrderCode(string $orderCode)
    {
        return $this->tryThrow(function () use ($orderCode) {
            return $this->orderRepository->findByOrderCode($orderCode);
        });
    }
}
