<?php

namespace App\Repositories;

use App\Models\DocumentLegalType;

class DocumentLegalTypeRepository
{
    public function list(array $request)
    {
        return DocumentLegalType::orderByDesc("id")->get()->toArray();
    }

    public function store(array $request)
    {
        return DocumentLegalType::create($request);
    }

    public function update(array $request)
    {
        $record = DocumentLegalType::find($request["id"]);
        $record->update($request);
        return $record;
    }

    public function delete(array $request)
    {
        return DocumentLegalType::find($request["id"])->delete();
    }
}
