<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRole\DeleteRequest;
use App\Http\Requests\UserRole\ListRequest;
use App\Http\Requests\UserRole\StoreRequest;
use App\Http\Requests\UserRole\UpdateRequest;
use App\Services\UserRoleService;

class UserRoleController extends Controller
{
    protected $userRoleService;
    public function __construct()
    {
        $this->userRoleService = app(UserRoleService::class);
    }

    public function list(ListRequest $request)
    {
        return $this->catchAPI(function () use ($request) {
            return response()->json([
                'data' => $this->userRoleService->list($request->validated()),
            ], 200);
        });
    }

    public function store(StoreRequest $request)
    {
        return $this->catchAPI(function () use ($request) {
            return response()->json([
                'data' => $this->userRoleService->store($request->validated()),
                'message' => 'Thêm mới thành công',
            ], 200);
        });
    }

    public function update(UpdateRequest $request)
    {
        return $this->catchAPI(function () use ($request) {
            return response()->json([
                'data' => $this->userRoleService->update($request->validated()),
                'message' => 'Cập nhật thành công',
            ], 200);
        });
    }

    public function delete(DeleteRequest $request)
    {
        return $this->catchAPI(function () use ($request) {
            $this->userRoleService->delete($request->validated());
            return response()->json([
                'message' => 'Xóa thành công',
            ], 200);
        });
    }
}
