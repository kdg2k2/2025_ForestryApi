<?php

namespace App\Repositories;

use App\Models\OrderDocument;

class OrderDocumentRepository
{
    public function store(array $request)
    {
        return OrderDocument::create($request);
    }
    public function insetMany(array $request)
    {
        return OrderDocument::insert($request);
    }
}
