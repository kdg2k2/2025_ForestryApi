<?php

namespace App\Services;

use App\Repositories\DocumentLegalTypeRepository;

class DocumentLegalTypeService extends BaseService
{
    protected $documentLegalTypeRepository;
    public function __construct()
    {
        $this->documentLegalTypeRepository = new DocumentLegalTypeRepository();
    }

    public function list(array $request)
    {
        return $this->tryThrow(function () use ($request) {
            $records = $this->documentLegalTypeRepository->list($request);
            if ($request["paginate"] == 1)
                $records = $this->paginate($records, $request["per_page"], $request["page"]);
            return $records;
        });
    }

    public function store(array $request)
    {
        return $this->tryThrow(function () use ($request) {
            return $this->documentLegalTypeRepository->store($request);
        });
    }

    public function update(array $request)
    {
        return $this->tryThrow(function () use ($request) {
            return $this->documentLegalTypeRepository->update($request);
        });
    }

    public function delete(array $request)
    {
        return $this->tryThrow(function () use ($request) {
            return $this->documentLegalTypeRepository->delete($request);
        });
    }
}
