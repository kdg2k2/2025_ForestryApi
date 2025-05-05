<?php

namespace App\Repositories;

use App\Models\BioNationalParkType;

class BioNationalParkTypeRepository
{
    public function store(array $request)
    {
        return BioNationalParkType::create($request);
    }

    public function update(array $request, int $id)
    {
        $record = BioNationalParkType::find($id);
        $record->update($request);
        return $record;
    }

    public function deleteSoft(int $id)
    {
        return BioNationalParkType::where('id', $id)->delete();
    }

    public function deleteHard(int $id)
    {
        return BioNationalParkType::where('id', $id)->forceDelete();
    }

    public function restore(int $id)
    {
        return BioNationalParkType::withTrashed()->where('id', $id)->restore();
    }

    public function list()
    {
        return BioNationalParkType::all();
    }

    public function findById(int $id, $delete = false)
    {
        if (!$delete) return BioNationalParkType::find($id);
        return BioNationalParkType::withTrashed()->find($id);
    }
}
