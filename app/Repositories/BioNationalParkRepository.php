<?php

namespace App\Repositories;

use App\Models\BioNationalPark;

class BioNationalParkRepository
{
    public function store(array $request)
    {
        return BioNationalPark::create($request);
    }

    public function update(array $request, int $id)
    {
        $park = BioNationalPark::find($id);
        $park->update($request);
        return $park;
    }

    public function deleteSoft(int $id)
    {
        return BioNationalPark::where('id', $id)->delete();
    }

    public function deleteHard(int $id)
    {
        return BioNationalPark::where('id', $id)->forceDelete();
    }

    public function restore(int $id)
    {
        return BioNationalPark::withTrashed()->where('id', $id)->restore();
    }

    public function list(array $request)
    {
        $records = BioNationalPark::all();
        return $records;
    }

    public function findById(int $id, $delete = false)
    {
        if ($delete) {
            return BioNationalPark::withTrashed()->find($id);
        }
        return BioNationalPark::find($id);
    }
}
