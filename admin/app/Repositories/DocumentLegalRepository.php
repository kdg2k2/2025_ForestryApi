<?php

namespace App\Repositories;

use App\Models\DocumentLegal;

class DocumentLegalRepository
{
    public function store(array $request)
    {
        return DocumentLegal::create($request)->load('type');
    }

    public function update(array $request)
    {
        $record = DocumentLegal::find($request["id"]);
        $record->update($request);
        return $record;
    }
}
