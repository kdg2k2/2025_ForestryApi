<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserUnit\DeleteRequest;
use App\Http\Requests\UserUnit\ListRequest;
use App\Http\Requests\UserUnit\StoreRequest;
use App\Http\Requests\UserUnit\UpdateRequest;
use App\Services\UserUnitService;

class UserUnitController extends Controller
{
    protected $userUnitService;
    public function __construct()
    {
        $this->userUnitService = app(UserUnitService::class);
    }

    public function list(ListRequest $request)
    {
        return $this->catchAPI(function () use ($request) {
            return response()->json([
                'data' => $this->userUnitService->list($request->validated()),
            ], 200);
        });
    }

    public function store(StoreRequest $request)
    {
        return $this->catchAPI(function () use ($request) {
            return response()->json([
                'data' => $this->userUnitService->store($request->validated()),
                'message' => config('messages.success.store'),
            ], 200);
        });
    }

    public function update(UpdateRequest $request)
    {
        return $this->catchAPI(function () use ($request) {
            return response()->json([
                'data' => $this->userUnitService->update($request->validated()),
                'message' => config('messages.success.update'),
            ], 200);
        });
    }

    public function delete(DeleteRequest $request)
    {
        return $this->catchAPI(function () use ($request) {
            $this->userUnitService->delete($request->validated());
            return response()->json([
                'message' => config('messages.success.delete'),
            ], 200);
        });
    }
}
