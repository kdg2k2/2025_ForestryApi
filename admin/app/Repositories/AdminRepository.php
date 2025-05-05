<?php

namespace App\Repositories;

use App\Models\Admin;

class AdminRepository
{
    public function list(array $request)
    {
        $query = Admin::orderByDesc("id")->with("unit");

        if (!empty($request["id_unit"]))
            $query->where("id_unit", $request["id_unit"]);

        return $query->get()->toArray();
    }

    public function store(array $request)
    {
        $record = Admin::create($request);
        return $record->toArray();
    }

    public function update(array $request, $removeOldPath)
    {
        $record = Admin::find($request["id"]);

        if ($removeOldPath == true && !empty($record->path))
            if (file_exists(public_path($record->path)))
                unlink(public_path($record->path));

        $record->update($request);
        return $record->toArray();
    }

    public function delete(array $request)
    {
        return Admin::find($request["id"])->delete();
    }

    public function findById(int $id)
    {
        return Admin::find($id);
    }

    public function findByEmail(string $email)
    {
        return Admin::where("email", $email)->first();
    }
}
