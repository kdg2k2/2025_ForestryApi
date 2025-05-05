<?php

namespace App\Services;

use App\Repositories\DocumentTypeRepository;
use Illuminate\Support\Facades\Log;

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
            $records = $this->documentTypeRepository->list($request);
            if ($request["paginate"] == 1)
                $records = $this->paginate($records, $request["per_page"], $request["page"]);
            return $records;
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
