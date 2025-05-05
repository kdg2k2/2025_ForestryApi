<?php

namespace App\Repositories;

use App\Models\DocumentViewLog;

class DocumentViewLogRepository
{
    public function store(array $request)
    {
        return DocumentViewLog::create($request);
    }
}
