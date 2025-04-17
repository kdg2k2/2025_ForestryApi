<?php

namespace App\Services;

use App\Repositories\UserRoleRepository;
use App\Services\BaseService;

class UserRoleService extends BaseService
{
    protected $userRoleRepository;
    public function __construct()
    {
        $this->userRoleRepository = app(UserRoleRepository::class);
    }

    public function list(array $request)
    {
        return $this->catchAPI(function () use ($request) {
            return $this->userRoleRepository->list($request);
        });
    }

    public function store(array $request)
    {
        return $this->catchAPI(function () use ($request) {
            return $this->userRoleRepository->store($request);
        });
    }

    public function update(array $request)
    {
        return $this->catchAPI(function () use ($request) {
            return $this->userRoleRepository->update($request);
        });
    }

    public function delete(array $request)
    {
        return $this->catchAPI(function () use ($request) {
            return $this->userRoleRepository->delete($request);
        });
    }
}
