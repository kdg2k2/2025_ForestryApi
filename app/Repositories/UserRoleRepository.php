<?php

namespace App\Repositories;

use App\Models\UserRole;

class UserRoleRepository extends BaseRepository
{
    public function list(array $request)
    {
        $records = UserRole::orderByDesc("id")->get()->toArray();

        if ($request["paginate"] == 1)
            return $this->paginate($records, $request["per_page"], $request["page"]);
        return $$records;
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
}
