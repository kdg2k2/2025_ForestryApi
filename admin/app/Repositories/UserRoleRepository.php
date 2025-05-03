<?php

namespace App\Repositories;

use App\Models\UserRole;

class UserRoleRepository
{
    public function list(array $request)
    {
        $records = UserRole::orderByDesc("id");
        if ($request['ignore_admin'] == 1)
            $records->where('id', '!=', 1);
        return $records->get()->toArray();
    }

    public function store(array $request)
    {
        return UserRole::create($request);
    }

    public function update(array $request)
    {
        $record = UserRole::find($request["id"]);
        $record->update($request);
        return $record;
    }

    public function delete(array $request)
    {
        return UserRole::find($request["id"])->delete();
    }

    public function findById(int $id)
    {
        return UserRole::find($id);
    }
}
