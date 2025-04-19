<?php

namespace App\Repositories;

use App\Models\UserUnit;

class UserUnitRepository
{
    public function list(array $request)
    {
        return UserUnit::orderByDesc("id")->get()->toArray();
    }

    public function store(array $request)
    {
        return UserUnit::create($request);
    }

    public function update(array $request)
    {
        $record = UserUnit::find($request["id"]);
        $record->update($request);
        return $record;
    }

    public function delete(array $request)
    {
        return UserUnit::find($request["id"])->delete();
    }
}
