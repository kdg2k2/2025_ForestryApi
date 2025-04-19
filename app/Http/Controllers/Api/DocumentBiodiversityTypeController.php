<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\DocumentBiodiversityType\DeleteRequest;
use App\Http\Requests\DocumentBiodiversityType\ListRequest;
use App\Http\Requests\DocumentBiodiversityType\StoreRequest;
use App\Http\Requests\DocumentBiodiversityType\UpdateRequest;
use App\Services\DocumentBiodiversityTypeService;

class DocumentBiodiversityTypeController extends Controller
{
    protected $documentBiodiversityTypeService;
    public function __construct()
    {
        $this->documentBiodiversityTypeService = app(DocumentBiodiversityTypeService::class);
    }

    public function list(ListRequest $request)
    {
        return $this->catchAPI(function () use ($request) {
            return response()->json([
                'data' => $this->documentBiodiversityTypeService->list($request->validated()),
            ]);
        });
    }

    public function store(StoreRequest $request)
    {
        return $this->catchAPI(function () use ($request) {
            return response()->json([
                'data' => $this->documentBiodiversityTypeService->store($request->validated()),
                'message' => config('messages.success.store'),
            ]);
        });
    }

    public function update(UpdateRequest $request)
    {
        return $this->catchAPI(function () use ($request) {
            return response()->json([
                'data' => $this->documentBiodiversityTypeService->update($request->validated()),
                'message' => config('messages.success.update'),
            ]);
        });
    }

    public function delete(DeleteRequest $request)
    {
        return $this->catchAPI(function () use ($request) {
            $this->documentBiodiversityTypeService->delete($request->validated());
            return response()->json([
                'message' => config('messages.success.delete'),
            ]);
        });
    }
}
