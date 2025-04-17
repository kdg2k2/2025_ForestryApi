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

            $records = $query->get()->toArray();
            if ($request["paginate"] == 1)
                return $this->paginate($records, $request["per_page"], $request["page"]);
            return $$records;
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
            $record = UserRole::find($request["id"]);
            $record->update($request);
            return $record;
        });
    }

    public function delete(array $request)
    {
        return $this->catchAPI(function () use ($request) {
            return UserRole::find($request["id"])->delete();
        });
    }
}
