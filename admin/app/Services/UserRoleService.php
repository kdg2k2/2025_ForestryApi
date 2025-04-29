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
        return $this->tryThrow(function () use ($request) {
            $records = $this->userRoleRepository->list($request);
            if ($request["paginate"] == 1)
                $records = $this->paginate($records, $request["per_page"], $request["page"]);
            return $records;
        });
    }

    public function store(array $request)
    {
        return $this->tryThrow(function () use ($request) {
            return $this->userRoleRepository->store($request);
        });
    }

    public function update(array $request)
    {
        return $this->tryThrow(function () use ($request) {
            return $this->userRoleRepository->update($request);
        });
    }

    public function delete(array $request)
    {
        return $this->tryThrow(function () use ($request) {
            return $this->userRoleRepository->delete($request);
        });
    }
}
