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

            if ($request['paginate'] == 1) {
                $data = $query->paginate($request['per_page']);
                return $this->transformList($data->getCollection());
            }
            return $this->transformList($query->get());
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
            $record = User::find($request['id']);
            $record->update($request);
            return $this->transformRecord($record);
        });
    }

    public function delete(array $request)
    {
        return $this->catchAPI(function () use ($request) {
            return User::find($request['id'])->delete();
        });
    }

    protected function transformList($data)
    {
        return $data->transform(function ($item) {
            return $this->transformRecord($item);
        });
    }

    protected function transformRecord($record)
    {
        $record->path = $this->getAssetImage($record->path);
        return $record;
    }
}
