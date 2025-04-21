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
        return BioNationalPark::where('id', $id)->update($request);
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
        $query = BioNationalPark::query();

        if (isset($request['name'])) {
            $query->where('name', 'like', '%' . $request['name'] . '%');
        }

        if (isset($request['paginate']) && $request['paginate'] == 1) {
            return $query->paginate($request['per_page']);
        }

        return $query->get();
    }

    public function findById(int $id, $delete = false)
    {
        if ($delete) {
            return BioNationalPark::withTrashed()->find($id);
        }
        return BioNationalPark::find($id);
    }
}
