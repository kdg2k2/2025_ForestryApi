<?php
namespace App\Repositories;

use App\Models\DocumentScientificPublicationType;

class DocumentScientificPublicationTypeRepository{
    public function list(array $request)
    {
        return DocumentScientificPublicationType::orderByDesc("id")->get()->toArray();
    }

    public function store(array $request)
    {
        return DocumentScientificPublicationType::create($request);
    }

    public function update(array $request)
    {
        $record = DocumentScientificPublicationType::find($request["id"]);
        $record->update($request);
        return $record;
    }

    public function delete(array $request)
    {
        return DocumentScientificPublicationType::find($request["id"])->delete();
    }
}