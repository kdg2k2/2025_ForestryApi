<?php

namespace App\Repositories;

use App\Models\DocumentBiodiversityType;

class DocumentBiodiversityTypeRepository
{
    public function list(array $request)
    {
        return DocumentBiodiversityType::orderByDesc("id")->get()->toArray();
    }

    public function store(array $request)
    {
        return DocumentBiodiversityType::create($request);
    }

    public function update(array $request)
    {
        $record = DocumentBiodiversityType::find($request["id"]);
        $record->update($request);
        return $record;
    }

    public function delete(array $request)
    {
        return DocumentBiodiversityType::find($request["id"])->delete();
    }
}
