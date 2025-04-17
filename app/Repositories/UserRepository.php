<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository extends BaseRepository
{
    public function list(array $request)
    {
        $query = User::orderByDesc("id");

        if (!empty($request["id_unit"]))
            $query->where("id_unit", $request["id_unit"]);

        if (!empty($request["id_role"]))
            $query->where("id_role", $request["id_role"]);

        $records = $this->transformList($query->get())->toArray();
        if ($request["paginate"] == 1)
            $records = $this->paginate($records, $request["per_page"], $request["page"]);
        return $records;
    }

    public function store(array $request)
    {
        $record = User::create($request);
        return $this->transformRecord($record);
    }

    public function update(array $request, $removeOldPath)
    {
        $record = User::find($request["id"]);

        if ($removeOldPath == true)
            if (file_exists(public_path($record->path)))
                unlink(public_path($record->path));

        $record->update($request);
        return $this->transformRecord($record);
    }

    public function delete(array $request)
    {
        return User::find($request["id"])->delete();
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
