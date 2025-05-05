<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BioNationalPark\CreateRequest;
use App\Http\Requests\BioNationalPark\ListRequest;
use App\Http\Requests\BioNationalPark\UpdateRequest;
use App\Services\BioNationalParkService;
use Illuminate\Http\Request;

class BioNationalParkController extends Controller
{
    protected BioNationalParkService $bioNationalParkService;
    public function __construct()
    {
        $this->bioNationalParkService = app(BioNationalParkService::class);
    }
    public function store(CreateRequest $req)
    {
        return $this->catchAPI(function () use ($req) {
            $record = $this->bioNationalParkService->store($req->validated());
            return response()->json([
                'message' => 'Thêm mới thành công',
                'data' => $record,
            ], 201);
        });
    }

    public function list(ListRequest $req)
    {
        return $this->catchAPI(function () use ($req) {
            return response()->json([
                "message" => "Danh sách vườn quốc gia",
                'data' => $this->bioNationalParkService->list($req->all()),
            ]);
        });
    }

    public function update(UpdateRequest $req)
    {
        return $this->catchAPI(function () use ($req) {
            return [
                "data" => $this->bioNationalParkService->update($req->validated()),
                "message" => "Cập nhập thành công"
            ];
        });
    }

    public function deleteSoft(int $id)
    {
        return $this->catchAPI(function () use ($id) {
            $this->bioNationalParkService->deleteSoft($id);
            return response()->json([
                "message" => "Xóa thành công",
            ]);
        });
    }
    public function restore(int $id)
    {
        return $this->catchAPI(function () use ($id) {
            $this->bioNationalParkService->restore($id);
            return response()->json([
                'message' => "Khôi phục thành công",
            ]);
        });
    }
}
