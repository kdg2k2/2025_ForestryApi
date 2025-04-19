<?php

namespace App\Services;

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
            $records = $this->documentRepository->list($request);
            $records = $this->transformRecords($records);
            if ($request["paginate"] == 1)
                $records = $this->paginate($records, $request["per_page"], $request["page"]);
            return $records;
        });
    }

    public function store(array $request)
    {
        return $this->tryThrow(function () use ($request) {
            $request = $this->prepareData($request)['request'];

            $check = $this->separateNewArrays($request);

            $record = $this->documentRepository->store($check['main']);
            $relationship = $this->checkSpecialDocumentType($check['nested'], $record);
            $record = array_merge($record->toArray(), $relationship);

            $record = $this->transformRecord($record);
            return $record;
        });
    }

    public function update(array $request)
    {
        return $this->tryThrow(function () use ($request) {
            $prepare = $this->prepareData($request);
            $request = $prepare['request'];
            $removeOld = $prepare['removeOld'];
            $record = $this->documentRepository->update($request, $removeOld);
            $record = $this->transformRecord($record);
            return $record;
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

    protected function transformRecord($record)
    {
        if (!empty($record['uploader']))
            $record['uploader']['path'] = $this->getAssetImage($record['uploader']['path']);
        return $record;
    }

    protected function transformRecords($records)
    {
        return array_map([$this, 'transformRecord'], $records);
    }

    protected function fileUpload($path)
    {
        return (new FileUploadService())->storeDocument($path);
    }

    protected function prepareData(array $request)
    {
        // nếu là loại văn bản khác thì tự thêm record loại văn bản mới
        if ($request['id_document_type'] == config('documents.types.khac')) {
            $request['id_document_type'] = $this->newDocumentType($request['new_document_type']);
            unset($request['new_document_type']);
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

    protected function separateNewArrays(array $input)
    {
        $main = $nested = [];

        foreach ($input as $key => $value) {
            (is_array($value) && str_starts_with($key, 'new_'))
                ? $nested[$key] = $value
                : $main[$key] = $value;
        }

        return ['main' => $main, 'nested' => $nested];
    }

    protected function checkSpecialDocumentType(array $request, $record)
    {
        $new = [];
        switch ($record->id_document_type) {
            case config('documents.types.van-ban-phap-ly.id'):
                $request['new_document_legal']['id_document'] = $record->id;
                $new['legal'] = $this->newDocumentLegal($request['new_document_legal']);
                break;
            case config('documents.types.an-pham-khoa-hoc.id'):
                $request['new_document_scientific_publication']['id_document'] = $record->id;
                $new['document_scientific_publication'] = $this->newDocumentScientificPublication($request['new_document_scientific_publication']);
                break;
            case config('documents.types.da-dang-sinh-hoc.id'):
                $request['new_document_biodiversitie']['id_document'] = $record->id;
                $new['document_biodiversitie'] = $this->newDocumentBiodiversity($request['new_document_biodiversitie']);
                break;
            // case config('documents.types.van-ban-phap-ly.khac'):
            //     $request['id_document_type'] = $this->newDocumentLegalType($request['new_document_legal_type']);
            //     unset($request['new_document_legal_type']);
            //     break;
            // case config('documents.types.an-pham-khoa-hoc.khac'):
            //     $request['id_document_type'] = $this->newDocumentScientificPublicationType($request['new_document_scientific_publication_type']);
            //     unset($request['new_document_scientific_publication_type']);
            //     break;
            // case config('documents.types.da-dang-sinh-hoc.khac'):
            //     $request['id_document_type'] = $this->newDocumentBiodiversityType($request['new_document_biodiversity_type']);
            //     unset($request['new_document_biodiversity_type']);
            //     break;
            default:
                break;
        }
        return $new;
    }

    protected function newDocumentLegal(array $request)
    {
        $validated = $this->customValidateRequest(
            $request,
            new \App\Http\Requests\DocumentLegal\StoreRequest
        );

        return app(DocumentLegalService::class)->store($validated)->toArray();
    }

    protected function newDocumentScientificPublication(array $request)
    {
        $validated = $this->customValidateRequest(
            $request,
            new \App\Http\Requests\DocumentScientificPublication\StoreRequest
        );

        return app(DocumentScientificPublicationService::class)->store($validated)->toArray();
    }

    protected function newDocumentBiodiversity(array $request)
    {
        $validated = $this->customValidateRequest(
            $request,
            new \App\Http\Requests\DocumentBiodiversity\StoreRequest
        );

        return app(DocumentBiodiversityService::class)->store($validated)->toArray();
    }

    protected function newDocumentType(array $request)
    {
        $validated = $this->customValidateRequest(
            $request,
            new \App\Http\Requests\DocumentType\StoreRequest
        );

        return app(DocumentTypeService::class)->store($validated)->id;
    }

    protected function newDocumentLegalType(array $request)
    {
        $validated = $this->customValidateRequest(
            $request,
            new \App\Http\Requests\DocumentLegalType\StoreRequest
        );

        return app(DocumentLegalTypeService::class)->store($validated)->id;
    }

    protected function newDocumentScientificPublicationType(array $request)
    {
        $validated = $this->customValidateRequest(
            $request,
            new \App\Http\Requests\DocumentScientificPublicationType\StoreRequest
        );

        return app(DocumentScientificPublicationTypeService::class)->store($validated)->id;
    }

    protected function newDocumentBiodiversityType(array $request)
    {
        $validated = $this->customValidateRequest(
            $request,
            new \App\Http\Requests\DocumentBiodiversityType\StoreRequest
        );

        return app(DocumentBiodiversityTypeService::class)->store($validated)->id;
    }

    protected function createCustomRequest(array $request, $customRequest)
    {
        $base = new Request($request);
        return $customRequest->createFrom($base);
    }

    protected function customValidateRequest(array $request, $customRequest)
    {
        $custom = $this->createCustomRequest($request, $customRequest);

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

    public function getNeededDataFilter()
    {
        return [
            'allow_download' => [
                [
                    'key' => 0,
                    'title' => "Không được tải",
                ],
                [
                    'key' => 1,
                    'title' => "Có được tải",
                ],
            ],
            'is_shared' => [
                [
                    'key' => 0,
                    'title' => "Không được chia sẻ",
                ],
                [
                    'key' => 1,
                    'title' => "Có được chia sẻ",
                ],
            ],
            'issued_year' => $this->documentRepository->getIssuedYears(),
        ];
    }
}
