<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\DeleteRequest;
use App\Http\Requests\User\ListRequest;
use App\Http\Requests\User\StoreRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Services\UserService;

class UserController extends Controller
{
    protected $userService;
    public function __construct()
    {
        $this->userService = app(UserService::class);
    }

    public function list(ListRequest $request)
    {
        return $this->catchAPI(function () use ($request) {
            return response()->json([
                'data' => $this->userService->list($request->validated()),
            ], 200);
        });
    }

    public function store(StoreRequest $request)
    {
        return $this->catchAPI(function () use ($request) {
            return response()->json([
                'data' => $this->userService->store($request->validated()),
                'message' => 'Thêm mới thành công',
            ], 200);
        });
    }

    public function update(UpdateRequest $request)
    {
        return $this->catchAPI(function () use ($request) {
            return response()->json([
                'data' => $this->userService->update($request->validated()),
                'message' => 'Cập nhật thành công',
            ], 200);
        });
    }

    public function delete(DeleteRequest $request)
    {
        return $this->catchAPI(function () use ($request) {
            $this->userService->delete($request->validated());
            return response()->json([
                'message' => 'Xóa thành công',
            ], 200);
        });
    }
}
