<?php

namespace App\Services;

use App\Repositories\DocumentTypeRepository;

class DocumentTypeService extends BaseService
{
    protected $documentTypeRepository;
    public function __construct()
    {
        $this->documentTypeRepository = app(DocumentTypeRepository::class);
    }

    public function list(array $request)
    {
        return $this->tryThrow(function () use ($request) {
            return $this->documentTypeRepository->list($request);
        });
    }

    public function store(array $request)
    {
        return $this->tryThrow(function () use ($request) {
            return $this->documentTypeRepository->store($request);
        });
    }

    public function update(array $request)
    {
        return $this->tryThrow(function () use ($request) {
            return $this->documentTypeRepository->update($request);
        });
    }

    public function delete(array $request)
    {
        return $this->tryThrow(function () use ($request) {
            return $this->documentTypeRepository->delete($request);
        });
    }
}
