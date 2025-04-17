<?php

namespace App\Repositories;

use App\Models\UserUnit;

class UserUnitRepository extends BaseRepository
{
    public function list(array $request)
    {
        $records = UserUnit::orderByDesc("id")->get()->toArray();

        if ($request["paginate"] == 1)
            return $this->paginate($records, $request["per_page"], $request["page"]);
        return $$records;
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
