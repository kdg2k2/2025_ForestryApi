<?php

namespace App\Repositories;

use App\Models\DocumentType;

class DocumentTypeRepository extends BaseRepository
{
    public function list(array $request)
    {
        $records = DocumentType::orderByDesc("id")->get()->toArray();

        if ($request["paginate"] == 1)
            $records = $this->paginate($records, $request["per_page"], $request["page"]);
        return $records;
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
}
