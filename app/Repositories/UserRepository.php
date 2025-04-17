<?php

namespace App\Repositories;

use App\Models\User;
use App\Services\BaseService;

class UserRepository extends BaseService
{
    public function list(array $request)
    {
        return $this->catchAPI(function () use ($request) {
            $query = User::orderByDesc("id");

            if (!empty($request["id_unit"]))
                $query->where("id_unit", $request["id_unit"]);

            if (!empty($request["id_role"]))
                $query->where("id_role", $request["id_role"]);

            $records = $this->transformList($query->get())->toArray();
            if ($request["paginate"] == 1)
                $records = $this->paginate($records, $request["per_page"], $request["page"]);
            return $records;
        });
    }

    public function store(array $request)
    {
        return $this->catchAPI(function () use ($request) {
            $record = User::create($request);
            return $this->transformRecord($record);
        });
    }

    public function update(array $request)
    {
        return $this->catchAPI(function () use ($request) {
            $record = User::find($request["id"]);
            $record->update($request);
            return $this->transformRecord($record);
        });
    }

    public function delete(array $request)
    {
        return $this->catchAPI(function () use ($request) {
            return User::find($request["id"])->delete();
        });
    }

    protected function transformList($records)
    {
        return $records->transform(function ($item) {
            return $this->transformRecord($item);
        });
    }

    protected function transformRecord($record)
    {
        $record->path = $this->getAssetImage($record->path);
        return $record;
    }
}
