<?php

namespace App\Services;

use App\Repositories\DocumentScientificPublicationRepository;
use App\Repositories\DocumentScientificPublicationTypeRepository;

class DocumentScientificPublicationTypeService extends BaseService
{
    protected $documentScientificPublicationTypeRepository;
    public function __construct()
    {
        $this->documentScientificPublicationTypeRepository = app(DocumentScientificPublicationTypeRepository::class);
    }

    public function list(array $request)
    {
        return $this->tryThrow(function () use ($request) {
            $records = $this->documentScientificPublicationTypeRepository->list($request);
            if ($request["paginate"] == 1)
                $records = $this->paginate($records, $request["per_page"], $request["page"]);
            return $records;
        });
    }

    public function store(array $request)
    {
        return $this->tryThrow(function () use ($request) {
            return $this->documentScientificPublicationTypeRepository->store($request);
        });
    }

    public function update(array $request)
    {
        return $this->tryThrow(function () use ($request) {
            return $this->documentScientificPublicationTypeRepository->update($request);
        });
    }

    public function delete(array $request)
    {
        return $this->tryThrow(function () use ($request) {
            return $this->documentScientificPublicationTypeRepository->delete($request);
        });
    }
}
