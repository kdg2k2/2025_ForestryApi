<?php

namespace App\Services;

use App\Repositories\DocumentLegalRepository;

class DocumentLegalService extends BaseService
{
    protected $documentLegalRepository;
    public function __construct()
    {
        $this->documentLegalRepository = new DocumentLegalRepository();
    }

    public function store(array $request)
    {
        return $this->tryThrow(function () use ($request) {
            return $this->documentLegalRepository->store($request);
        });
    }

    public function update(array $request)
    {
        return $this->tryThrow(function () use ($request) {
            return $this->documentLegalRepository->update($request);
        });
    }
}
