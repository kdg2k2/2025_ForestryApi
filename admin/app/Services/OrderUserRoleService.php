<?php

namespace App\Services;

use App\Repositories\OrderUserRoleRepository;

class OrderUserRoleService extends BaseService
{
    protected $orderUserRoleRepository;
    public function __construct()
    {
        $this->orderUserRoleRepository = app(OrderUserRoleRepository::class);
    }

    public function store(array $request)
    {
        return $this->tryThrow(function () use ($request) {
            return $this->orderUserRoleRepository->store($request);
        });
    }
}
