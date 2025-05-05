<?php

namespace App\Services;

use App\Repositories\DocumentBiodiversityTypeRepository;

class DocumentBiodiversityTypeService extends BaseService
{
    protected $documentBiodiversityTypeRepository;
    public function __construct()
    {
        $this->documentBiodiversityTypeRepository = app(DocumentBiodiversityTypeRepository::class);
    }

    public function list(array $request)
    {
        return $this->tryThrow(function () use ($request) {
            $records = $this->documentBiodiversityTypeRepository->list($request);
            if ($request["paginate"] == 1)
                $records = $this->paginate($records, $request["per_page"], $request["page"]);
            return $records;
        });
    }

    public function store(array $request)
    {
        return $this->tryThrow(function () use ($request) {
            return $this->documentBiodiversityTypeRepository->store($request);
        });
    }

    public function update(array $request)
    {
        return $this->tryThrow(function () use ($request) {
            return $this->documentBiodiversityTypeRepository->update($request);
        });
    }

    public function delete(array $request)
    {
        return $this->tryThrow(function () use ($request) {
            return $this->documentBiodiversityTypeRepository->delete($request);
        });
    }
}
