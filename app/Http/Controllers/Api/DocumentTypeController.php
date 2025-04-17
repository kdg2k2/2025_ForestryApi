<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\DocumentType\DeleteRequest;
use App\Http\Requests\DocumentType\ListRequest;
use App\Http\Requests\DocumentType\StoreRequest;
use App\Http\Requests\DocumentType\UpdateRequest;
use App\Services\DocumentTypeService;

class DocumentTypeController extends Controller
{
    protected $documentTypeService;
    public function __construct()
    {
        $this->documentTypeService = app(DocumentTypeService::class);
    }

    public function list(ListRequest $request)
    {
        return $this->catchAPI(function () use ($request) {
            return response()->json([
                'data' => $this->documentTypeService->list($request->validated()),
            ], 200);
        });
    }

    public function store(StoreRequest $request)
    {
        return $this->catchAPI(function () use ($request) {
            return response()->json([
                'data' => $this->documentTypeService->store($request->validated()),
                'message' => 'Thêm mới thành công',
            ], 200);
        });
    }

    public function update(UpdateRequest $request)
    {
        return $this->catchAPI(function () use ($request) {
            return response()->json([
                'data' => $this->documentTypeService->update($request->validated()),
                'message' => 'Cập nhật thành công',
            ], 200);
        });
    }

    public function delete(DeleteRequest $request)
    {
        return $this->catchAPI(function () use ($request) {
            $this->documentTypeService->delete($request->validated());
            return response()->json([
                'message' => 'Xóa thành công',
            ], 200);
        });
    }
}
