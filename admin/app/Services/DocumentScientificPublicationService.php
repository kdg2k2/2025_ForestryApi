<?php

namespace App\Services;

use App\Repositories\DocumentScientificPublicationRepository;

class DocumentScientificPublicationService extends BaseService
{
    protected $DocumentScientificPublicationRepository;
    public function __construct()
    {
        $this->DocumentScientificPublicationRepository = app(DocumentScientificPublicationRepository::class);
    }

    public function store(array $request)
    {
        return $this->tryThrow(function () use ($request) {
            return $this->DocumentScientificPublicationRepository->store($request);
        });
    }

    public function update(array $request)
    {
        return $this->tryThrow(function () use ($request) {
            return $this->DocumentScientificPublicationRepository->update($request);
        });
    }
}
