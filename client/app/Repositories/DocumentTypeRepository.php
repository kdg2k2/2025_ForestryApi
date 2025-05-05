<?php

namespace App\Repositories;

use App\Models\DocumentType;

class DocumentTypeRepository
{
    public function list(array $request)
    {
        return DocumentType::orderByDesc("id")->get()->toArray();
    }

    public function store(array $request)
    {
        return DocumentType::create($request);
    }

    public function update(array $request)
    {
        $record = DocumentType::find($request["id"]);
        $record->update($request);
        return $record;
    }

    public function delete(array $request)
    {
        return DocumentType::find($request["id"])->delete();
    }

    public function findById(int $id)
    {
        return DocumentType::find($id);
    }
}
