<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\DocumentScientificPublicationType\DeleteRequest;
use App\Http\Requests\DocumentScientificPublicationType\ListRequest;
use App\Http\Requests\DocumentScientificPublicationType\StoreRequest;
use App\Http\Requests\DocumentScientificPublicationType\UpdateRequest;
use App\Services\DocumentScientificPublicationTypeService;

class DocumentScientificPublicationTypeController extends Controller
{
    protected $documentScientificPublicationTypeService;
    public function __construct()
    {
        $this->documentScientificPublicationTypeService = app(DocumentScientificPublicationTypeService::class);
    }

    public function list(ListRequest $request)
    {
        return $this->catchAPI(function () use ($request) {
            return response()->json([
                'data' => $this->documentScientificPublicationTypeService->list($request->validated()),
            ]);
        });
    }

    public function store(StoreRequest $request)
    {
        return $this->catchAPI(function () use ($request) {
            return response()->json([
                'data' => $this->documentScientificPublicationTypeService->store($request->validated()),
                'message' => config('messages.success.store'),
            ]);
        });
    }

    public function update(UpdateRequest $request)
    {
        return $this->catchAPI(function () use ($request) {
            return response()->json([
                'data' => $this->documentScientificPublicationTypeService->update($request->validated()),
                'message' => config('messages.success.update'),
            ]);
        });
    }

    public function delete(DeleteRequest $request)
    {
        return $this->catchAPI(function () use ($request) {
            $this->documentScientificPublicationTypeService->delete($request->validated());
            return response()->json([
                'message' => config('messages.success.delete'),
            ]);
        });
    }
}
