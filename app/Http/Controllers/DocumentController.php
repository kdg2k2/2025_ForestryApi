<?php

namespace App\Http\Controllers;

use App\Http\Requests\Document\DeleteRequest;
use App\Http\Requests\Document\ListRequest;
use App\Http\Requests\Document\ShowRequest;
use App\Http\Requests\Document\StoreRequest;
use App\Http\Requests\Document\UpdateRequest;
use App\Services\DocumentService;

class DocumentController extends Controller
{
    protected $documentService;
    public function __construct()
    {
        $this->documentService = app(DocumentService::class);
    }

    public function list(ListRequest $request)
    {
        return $this->catchAPI(function () use ($request) {
            return response()->json([
                'data' => $this->documentService->list($request->validated()),
            ]);
        });
    }

    public function store(StoreRequest $request)
    {
        return $this->catchAPI(function () use ($request) {
            return response()->json([
                'data' => $this->documentService->store($request->validated()),
                'message' => 'Thêm mới thành công',
            ]);
        });
    }

    public function update(UpdateRequest $request)
    {
        return $this->catchAPI(function () use ($request) {
            return response()->json([
                'data' => $this->documentService->update($request->validated()),
                'message' => 'Cập nhật thành công',
            ]);
        });
    }

    public function delete(DeleteRequest $request)
    {
        return $this->catchAPI(function () use ($request) {
            $this->documentService->delete($request->validated());
            return response()->json([
                'message' => 'Xóa thành công',
            ]);
        });
    }

    public function show(ShowRequest $request)
    {
        return $this->catchAPI(function () use ($request) {
            return response()->json([
                'data' => $this->documentService->show($request->validated()),
            ]);
        });
    }
}
