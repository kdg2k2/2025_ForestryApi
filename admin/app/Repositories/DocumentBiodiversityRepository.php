<?php

namespace App\Repositories;

use App\Models\DocumentBiodiversity;

class DocumentBiodiversityRepository
{
    public function list(array $request)
    {
        return DocumentBiodiversity::orderByDesc("id")->get()->toArray();
    }

    public function store(array $request)
    {
        return DocumentBiodiversity::create($request)->load('type');
    }

    public function update(array $request)
    {
        $record = DocumentBiodiversity::find($request["id"]);
        $record->update($request);
        return $record;
    }

    public function delete(array $request)
    {
        return DocumentBiodiversity::find($request["id"])->delete();
    }
}
