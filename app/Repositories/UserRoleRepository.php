<?php

namespace App\Repositories;

use App\Models\UserRole;
use App\Services\BaseService;

class UserRoleRepository extends BaseService
{
    public function list(array $request)
    {
        return $this->catchAPI(function () use ($request) {
            $query = UserRole::orderByDesc("id");

            if ($request['paginate'] == 1)
                return $query->paginate($request['per_page']);
            return $query->get();
        });
    }

    public function store(array $request)
    {
        return $this->catchAPI(function () use ($request) {
            return UserRole::create($request);
        });
    }

    public function update(array $request)
    {
        return $this->catchAPI(function () use ($request) {
            $record = UserRole::find($request['id']);
            $record->update($request);
            return $record;
        });
    }

    public function delete(array $request)
    {
        return $this->catchAPI(function () use ($request) {
            return UserRole::find($request['id'])->delete();
        });
    }
}
