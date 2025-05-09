<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Document\DeleteRequest;
use App\Http\Requests\Document\ListRequest;
use App\Http\Requests\Document\ShowRequest;
use App\Http\Requests\Document\StoreRequest;
use App\Http\Requests\Document\UpdateRequest;
use App\Services\DocumentService;

class DocumentControllser extends Controller
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
                'filter' => $this->documentService->getNeededDataFilter(),
                'data' => $this->documentService->list($request->validated()),
            ]);
        });
    }

    public function store(StoreRequest $request)
    {
        return $this->catchAPI(function () use ($request) {
            return response()->json([
                'data' => $this->documentService->store($request->validated()),
                'message' => config('messages.success.store'),
            ]);
        });
    }

    public function update(UpdateRequest $request)
    {
        return $this->catchAPI(function () use ($request) {
            return response()->json([
                'data' => $this->documentService->update($request->validated()),
                'message' => config('messages.success.update'),
            ]);
        });
    }

    public function delete(DeleteRequest $request)
    {
        return $this->catchAPI(function () use ($request) {
            $this->documentService->delete($request->validated());
            return response()->json([
                'message' => config('messages.success.delete'),
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
