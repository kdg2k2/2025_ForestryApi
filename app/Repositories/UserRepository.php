<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    public function list(array $request)
    {
        $query = User::orderByDesc("id");

        if (!empty($request["id_unit"]))
            $query->where("id_unit", $request["id_unit"]);

        if (!empty($request["id_role"]))
            $query->where("id_role", $request["id_role"]);

        return $query->get()->toArray();
    }

    public function store(array $request)
    {
        $record = User::create($request);
        return $record->toArray();
    }

    public function update(array $request, $removeOldPath)
    {
        $record = User::find($request["id"]);

        if ($removeOldPath == true)
            if (file_exists(public_path($record->path)))
                unlink(public_path($record->path));

        $record->update($request);
        return $record->toArray();
    }

    public function delete(array $request)
    {
        return User::find($request["id"])->delete();
    }
}
