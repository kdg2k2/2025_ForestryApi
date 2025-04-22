<?php

namespace App\Services;

use App\Repositories\DocumentRepository;

class DocumentService extends BaseService
{
    protected $documentRepository;
    protected $customValidateService;
    public function __construct()
    {
        $this->documentRepository = app(DocumentRepository::class);
        $this->customValidateService = app(CustomValidateRequestService::class);
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

            $check = $this->checkContrainTextInArray($request);

            $record = $this->documentRepository->store($check['main']);

            $this->checkSpecialDocumentType($request, $record);
            $record = $this->documentRepository->findById($record->id);

            $record = $this->transformRecord($record);
            return $record;
        });
    }

    public function update(array $request)
    {
        return $this->tryThrow(function () use ($request) {
            $prepare = $this->prepareData($request);

            $check = $this->checkContrainTextInArray($prepare['request']);

            $record = $this->documentRepository->update($check['main'], $prepare['removeOld']);

            $this->deleteRelationship($record);

            $this->checkSpecialDocumentType($prepare['request'], $record);
            $record = $this->documentRepository->findById($record->id);

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

    protected function deleteRelationship($record)
    {
        if ($record->legal) $record->legal->delete();
        if ($record->scientificPublication) $record->scientificPublication->delete();
        if ($record->biodiversity) $record->biodiversity->delete();
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
        if ($request['id_document_type'] == config('documents.types.other')) {
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

    protected function checkContrainTextInArray(array $input)
    {
        $main = $start = $end = [];
        $startWith = 'new_';
        $endWith = '_type';

        $main = $input;
        foreach ($input as $key => $value) {
            if (
                is_array($value) &&
                str_starts_with($key, needle: $startWith) &&
                !str_ends_with($key, $endWith)
            ) {
                $start[$key] = $value;
                unset($main[$key]);
            }

            if (
                is_array($value) &&
                str_ends_with($key, $endWith)
            ) {
                $end[$key] = $value;
                unset($main[$key]);
            }
        }

        return [
            'origin' => $input,
            'main' => $main,
            'start' => $start,
            'end' => $end,
        ];
    }

    protected function checkSpecialDocumentType(array $request, $record)
    {
        switch ($record->id_document_type) {
            case config('documents.types.legal.id'):
                // nếu là loại tài liệu văn bản pháp luật khác thì thêm mới loại này
                if ($request['new_document_legal']['id_type'] == config('documents.types.legal.other'))
                    $request['new_document_legal']['id_type'] = $this->newDocumentLegalType($request['new_document_legal_type']);

                // thêm mới văn bản pháp luật
                $request['new_document_legal']['id_document'] = $record->id;
                $this->newDocumentLegal($request['new_document_legal']);
                break;
            case config('documents.types.scientific_publication.id'):
                // nếu là loại tài liệu ấn phẩm khoa học khác thì thêm mới loại này
                if ($request['new_document_scientific_publication']['id_type'] == config('documents.types.scientific_publication.other'))
                    $request['new_document_scientific_publication']['id_type'] = $this->newDocumentScientificPublicationType($request['new_document_scientific_publication_type']);

                // thêm mới ấn phẩm khoa học
                $request['new_document_scientific_publication']['id_document'] = $record->id;
                $this->newDocumentScientificPublication($request['new_document_scientific_publication']);
                break;
            case config('documents.types.biodiversity.id'):
                // nếu là loại tài liệu đa dạng sinh học khác thì thêm mới loại này
                if ($request['new_document_biodiversitie']['id_type'] == config('documents.types.biodiversity.other'))
                    $request['new_document_biodiversitie']['id_type'] = $this->newDocumentBiodiversityType($request['new_document_biodiversitie_type']);

                // thêm mới tài liệu đa dạng sinh học
                $request['new_document_biodiversitie']['id_document'] = $record->id;
                $this->newDocumentBiodiversity($request['new_document_biodiversitie']);
                break;
            default:
                break;
        }
    }

    protected function newDocumentLegal(array $request)
    {
        $validated = $this->customValidateService->validate(
            $request,
            new \App\Http\Requests\DocumentLegal\StoreRequest
        );

        return app(DocumentLegalService::class)->store($validated)->toArray();
    }

    protected function newDocumentScientificPublication(array $request)
    {
        $validated = $this->customValidateService->validate(
            $request,
            new \App\Http\Requests\DocumentScientificPublication\StoreRequest
        );

        return app(DocumentScientificPublicationService::class)->store($validated)->toArray();
    }

    protected function newDocumentBiodiversity(array $request)
    {
        $validated = $this->customValidateService->validate(
            $request,
            new \App\Http\Requests\DocumentBiodiversity\StoreRequest
        );

        return app(DocumentBiodiversityService::class)->store($validated)->toArray();
    }

    protected function newDocumentType(array $request)
    {
        $validated = $this->customValidateService->validate(
            $request,
            new \App\Http\Requests\DocumentType\StoreRequest
        );

        return app(DocumentTypeService::class)->store($validated)->id;
    }

    protected function newDocumentLegalType(array $request)
    {
        $validated = $this->customValidateService->validate(
            $request,
            new \App\Http\Requests\DocumentLegalType\StoreRequest
        );

        return app(DocumentLegalTypeService::class)->store($validated)->id;
    }

    protected function newDocumentScientificPublicationType(array $request)
    {
        $validated = $this->customValidateService->validate(
            $request,
            new \App\Http\Requests\DocumentScientificPublicationType\StoreRequest
        );

        return app(DocumentScientificPublicationTypeService::class)->store($validated)->id;
    }

    protected function newDocumentBiodiversityType(array $request)
    {
        $validated = $this->customValidateService->validate(
            $request,
            new \App\Http\Requests\DocumentBiodiversityType\StoreRequest
        );

        return app(DocumentBiodiversityTypeService::class)->store($validated)->id;
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
