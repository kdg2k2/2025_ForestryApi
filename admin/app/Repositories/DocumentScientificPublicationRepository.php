<?php

namespace App\Repositories;

use App\Models\DocumentScientificPublication;

class DocumentScientificPublicationRepository
{
    public function store(array $request)
    {
        return DocumentScientificPublication::create($request)->load('type');
    }

    public function update(array $request)
    {
        $record = DocumentScientificPublication::find($request["id"]);
        $record->update($request);
        return $record;
    }
}
