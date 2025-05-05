<?php

namespace App\Services;

use App\Repositories\DocumentImageRepository;
use App\Repositories\DocumentRepository;
use Exception;
use Illuminate\Support\Facades\Gate;

class DocumentService extends BaseService
{
    protected $documentRepository;
    protected $documentImageRepository;
    protected $customValidateService;
    protected $orderService;
    public function __construct()
    {
        $this->documentRepository = app(DocumentRepository::class);
        $this->documentImageRepository = app(DocumentImageRepository::class);
        $this->customValidateService = app(CustomValidateRequestService::class);
        $this->orderService = app(OrderService::class);
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

            $this->renderImage($record->id);
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

            if ($prepare['removeOld'] == true)
                $this->renderImage($record->id);
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

    public function show(int $id)
    {
        return $this->tryThrow(function () use ($id) {
            $document = $this->documentRepository->findById($id);
            $document->path = asset($document['path']);
            $message = null;

            return [
                'document' => $document,
                'message' => $message,
            ];
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
        return (new FileUploadService())->storeDocument($path, false);
    }

    protected function prepareData(array $request)
    {
        // nếu là loại văn bản khác thì tự thêm record loại văn bản mới
        if ($request['id_document_type'] == config('documents.types.other.id')) {
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

    public function payment(int $id)
    {
        $document = $this->documentRepository->findById($id);

        $res = (new VnpayService())->createPaymentUrl([
            'total' => $document->price,
            'type' => 'billpayment',
            'info' => 'Thanh toán mua tài liệu ' . $document->name,
            'return_url' => route('admin.document.vnpay-return'),
        ]);

        $orderDocument = (new OrderDocumentService())->store([
            'id_order' => $res['order']['id'],
            'id_document' => $document->id,
            'price' => $document->price,
            'quantity' => 1,
        ]);

        return $res['url'];
    }

    public function vnpayReturn(array $request)
    {
        $res = (new VnpayService())->vnpayReturn($request);
        return [
            'route' => route('admin.document.index'),
            'message' => $res['message'],
            'message_type' => in_array($res['status'], [400, 201]) ? 'err' : 'success',
        ];
    }

    public function vnpayIpn($order)
    {
        return $this->tryThrow(function () use ($order) {
            $user = $order->user;
            $paths = array_filter($order->orderDocument->map(function ($item) {
                $path = public_path($item->document->path);
                if (file_exists($path))
                    return $path;
                return null;
            })->toArray(), fn($item) => !empty($item));

            (new EmailService())->sendMail(
                'emails.payment',
                'Thanh toán mua tài liệu thành công',
                [$user->email],
                [],
                $paths,
            );
        });
    }

    protected function renderImage(int $id)
    {
        return $this->tryThrow(function () use ($id) {
            $document = $this->documentRepository->findById($id);
            $this->documentImageRepository->deleteByIdDocument($id);

            $fullPathToPdf = public_path($document->path);
            if (!file_exists($fullPathToPdf))
                throw new Exception("File gốc không tồn tại");

            $folder = "uploads/documents/$id/images";
            $outputDir = public_path($folder);
            if (!is_dir($outputDir))
                mkdir($outputDir, 0777, true);

            $paths = (new PdfToImageService())->pdfToImage($fullPathToPdf, $outputDir);
            $paths = array_map(function ($item) use ($id, $folder) {
                return [
                    "id_document" => $id,
                    "path" => "$folder/$item",
                ];
            }, $paths);

            (new DocumentImageService())->insert($paths);
        });
    }

    protected function renderPdf(int $id)
    {
        $document = $this->documentRepository->findById($id);
        $user = auth('api')->user();

        $res = [
            "path" => null,
            "message" => null,
        ];
        $limitPage = $user->role->page_view_limit;
        $limitedImages = $originImages = $document->images->toArray();
        $isUnlimitPage = is_null($limitPage);

        if ($isUnlimitPage == false) {
            $res["message"] = "Bạn đang bị số hạn số trang được xem, hãy nâng cấp tài khoản";
            $limitedImages = array_slice($originImages, 0, $limitPage);
        }

        $images = array_map(function ($item) {
            return public_path($item['path']);
        }, $limitedImages);
        $res["path"] = asset((new PdfToImageService())->imagesToPdf($images, "uploads/documents/$id/reader-$user->id", "temp.pdf"));

        (new DocumentViewLogService())->store([
            "id_user" => $user->id,
            "id_document" => $document->id,
        ]);

        return $res;
    }
}
