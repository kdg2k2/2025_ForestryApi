<?php

namespace App\Repositories;

use App\Models\UserUnit;
use App\Services\BaseService;

class UserUnitRepository extends BaseService
{
    public function list(array $request)
    {
        return $this->catchAPI(function () use ($request) {
            $query = UserUnit::orderByDesc("id");

            if ($request['paginate'] == 1)
                return $query->paginate($request['per_page']);
            return $query->get();
        });
    }

    public function store(array $request)
    {
        return $this->catchAPI(function () use ($request) {
            return UserUnit::create($request);
        });
    }

    public function update(array $request)
    {
        return $this->catchAPI(function () use ($request) {
            $record = UserUnit::find($request['id']);
            $record->update($request);
            return $record;
        });
    }

    public function delete(array $request)
    {
        return $this->catchAPI(function () use ($request) {
            return UserUnit::find($request['id'])->delete();
        });
    }
}
