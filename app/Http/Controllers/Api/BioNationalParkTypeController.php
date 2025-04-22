<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BioNationalParkType\CreateRequest;
use App\Http\Requests\BioNationalParkType\ListRequest;
use App\Http\Requests\BioNationalParkType\UpdateRequest;
use App\Services\BioNationalParkTypeService;

class BioNationalParkTypeController extends Controller
{
    protected BioNationalParkTypeService $bioNationalParkTypeService;

    function __construct()
    {
        $this->bioNationalParkTypeService = app(BioNationalParkTypeService::class);
    }

    public function store(CreateRequest $request)
    {
        return $this->catchAPI(function() use ($request) {
            $record = $this->bioNationalParkTypeService->store($request->validated());
            return response()->json([
                'message' => 'Thêm mới thành công',
                'data' => $record,
            ], 201);
        });
    }

    public function update(UpdateRequest $request)
    {
        return $this->catchAPI(function() use ($request) {
            $data = $this->bioNationalParkTypeService->update($request->validated());
            return response()->json([
                'message' => 'Cập nhật thành công',
                'data' => $data,
            ], 200);
        });
    }

    public function deleteSoft(int $id)
    {
        return $this->catchAPI(function() use ($id) {
            $this->bioNationalParkTypeService->deleteSoft($id);
            return response()->json([
                'message' => 'Xóa thành công',
            ], 200);
        });
    }

    public function restore(int $id)
    {
        return $this->catchAPI(function() use ($id) {
            $this->bioNationalParkTypeService->restore($id);
            return response()->json([
                'message' => 'Khôi phục thành công',
            ], 200);
        });
    }

    public function list(ListRequest $request)
    {
        return $this->catchAPI(function() use ($request) {
            $data = $this->bioNationalParkTypeService->list($request->all());
            return response()->json([
                'data' => $data,
                'message' => 'Danh sách loại vườn quốc gia'
            ], 200);
        });
    }
}
