<?php

namespace App\Services;

use App\Http\Requests\DocumentType\StoreRequest;
use App\Repositories\DocumentRepository;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use ReflectionClass;

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
            $request = $this->prepareData($request)['request'];
            return $this->documentRepository->store($request);
        });
    }

    public function update(array $request)
    {
        return $this->tryThrow(function () use ($request) {
            $prepare = $this->prepareData($request);
            $request = $prepare['request'];
            $removeOld = $prepare['removeOld'];
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

    protected function prepareData(array $request)
    {
        // dd(
        //     $request,
        //     $request['id_document_type'],
        // );
        // if (!isset($request['id_document_type']))
        //     dd($request);
        switch ($request['id_document_type']) {
            case config('documents.types.khac'):
                $request['id_document_type'] = $this->handleNewDocumentType($request['new_document_type']);
                unset($request['new_document_type']);
                break;
            default:
                break;
        }

        $removeOld = false;
        if (!empty($request["path"])) {
            $removeOld = true;
            $request["path"] = $this->fileUpload($request["path"]);
        }

        return [
            'request' => $request,
            'removeOld' => $removeOld,
        ];
    }

    protected function handleNewDocumentType($request)
    {
        $validated = $this->customValidateRequest(
            $request,
            app(StoreRequest::class),
        );

        return app(DocumentTypeService::class)->store($validated)->id;
    }

    protected function customValidateRequest($request, $customRequest)
    {
        $base = new Request($request);
        $custom = $customRequest->createFrom($base);
        $custom->setContainer(app())->setRedirector(app(Redirector::class));

        $custom->prepareForValidation();

        $validator = Validator::make(
            $custom->all(),
            $custom->rules(),
            $custom->messages(),
            $custom->attributes()
        );

        if ($validator->fails()) {
            $reflection = new ReflectionClass($validator);
            $property = $reflection->getProperty('failedRules');
            $property->setAccessible(true);
            $failedRules = $property->getValue($validator);

            throw ValidationException::withMessages([
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
                'failed_rules' => $failedRules
            ]);
        }

        return $validator->validated();
    }
}
