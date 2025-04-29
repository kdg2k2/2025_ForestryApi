<?php

namespace App\Services;

use App\Repositories\DocumentViewLogRepository;

class DocumentViewLogService extends BaseService
{
    protected $documentViewLogRepository;
    public function __construct()
    {
        $this->documentViewLogRepository = app(DocumentViewLogRepository::class);
    }

    public function store(array $request)
    {
        return $this->tryThrow(function () use ($request) {
            return $this->documentViewLogRepository->store($request);
        });
    }
}
