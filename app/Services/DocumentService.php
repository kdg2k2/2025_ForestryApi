<?php

namespace App\Services;

use App\Repositories\DocumentRepository;

class DocumentService extends BaseService
{
    protected $documentRepository;
    public function __construct()
    {
        $this->documentRepository = app(DocumentRepository::class);
    }

    public function list(array $request)
    {
        return $this->tryThrow(function () use ($request) {
            return $this->documentRepository->list($request);
        });
    }

    public function store(array $request)
    {
        return $this->tryThrow(function () use ($request) {
            $request["path"] = $this->fileUpload($request["path"]);
            return $this->documentRepository->store($request);
        });
    }

    public function update(array $request)
    {
        return $this->tryThrow(function () use ($request) {
            $removeOld = false;
            if (!empty($request["path"])) {
                $removeOld = true;
                $request["path"] = $this->fileUpload($request["path"]);
            }
            return $this->documentRepository->update($request, $removeOld);
        });
    }

    public function delete(array $request)
    {
        return $this->tryThrow(function () use ($request) {
            return $this->documentRepository->delete($request);
        });
    }

    public function show(array $request)
    {
        return $this->tryThrow(function () use ($request) {
            return $this->documentRepository->show($request);
        });
    }

    protected function fileUpload($path)
    {
        return (new FileUploadService())->storeDocument($path);
    }
}
