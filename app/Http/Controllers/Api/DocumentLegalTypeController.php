<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\DocumentLegalType\DeleteRequest;
use App\Http\Requests\DocumentLegalType\ListRequest;
use App\Http\Requests\DocumentLegalType\StoreRequest;
use App\Http\Requests\DocumentLegalType\UpdateRequest;
use App\Services\DocumentLegalTypeService;

class DocumentLegalTypeController extends Controller
{
    protected $documentLegalTypeService;
    public function __construct()
    {
        $this->documentLegalTypeService = app(DocumentLegalTypeService::class);
    }

    public function list(ListRequest $request)
    {
        return $this->catchAPI(function () use ($request) {
            return response()->json([
                'data' => $this->documentLegalTypeService->list($request->validated()),
            ]);
        });
    }

    public function store(StoreRequest $request)
    {
        return $this->catchAPI(function () use ($request) {
            return response()->json([
                'data' => $this->documentLegalTypeService->store($request->validated()),
                'message' => config('messages.success.store'),
            ]);
        });
    }

    public function update(UpdateRequest $request)
    {
        return $this->catchAPI(function () use ($request) {
            return response()->json([
                'data' => $this->documentLegalTypeService->update($request->validated()),
                'message' => config('messages.success.update'),
            ]);
        });
    }

    public function delete(DeleteRequest $request)
    {
        return $this->catchAPI(function () use ($request) {
            $this->documentLegalTypeService->delete($request->validated());
            return response()->json([
                'message' => config('messages.success.delete'),
            ]);
        });
    }
}
