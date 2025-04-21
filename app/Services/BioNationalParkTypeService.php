<?php

namespace App\Services;

use App\Lib\Constant;
use App\Repositories\BioNationalParkTypeRepository;
use App\Services\BaseService;
use Illuminate\Database\QueryException;

class BioNationalParkTypeService extends BaseService
{
    protected $BioNationalParkTypeRepository;
    public function __construct()
    {
        $this->BioNationalParkTypeRepository = app(BioNationalParkTypeRepository::class);
    }

    public function store(array $request)
    {
        try {
            $this->BioNationalParkTypeRepository->store($request);
            return response()->json([
                'message' => 'Tạo mới thành công',
            ], 201);
        } catch (\Throwable $th) {
            if ($th instanceof QueryException && $th->getCode() == Constant::CodeSQL['DUPLICATE']) {
                $name = 'Tên loại công viên đã tồn tại';
                return response()->json([
                    'message' => $name,
                    "errors" => ["name" => [$name]],
                ], status: 422);
            }
            throw $th;
        }
    }

    public function update(array $request, int $id)
    {
        try {
            $type = $this->BioNationalParkTypeRepository->findById($id);
            if (!$type) {
                return response()->json([
                    'message' => 'Không tìm thấy loại công viên sinh học',
                ], 404);
            }
            $this->BioNationalParkTypeRepository->update($request, $id);
            return response()->json([
                'message' => 'Cập nhật thành công',
            ], 200);
        } catch (\Throwable $th) {
            if ($th instanceof QueryException && $th->getCode() == Constant::CodeSQL['DUPLICATE']) {
                $name = 'Tên loại công viên đã tồn tại';
                return response()->json([
                    'message' => $name,
                    "errors" => ["name" => [$name]],
                ], status: 422);
            }
            throw $th;
        }
    }

    public function deleteSoft(int $id)
    {
        $type = $this->BioNationalParkTypeRepository->findById($id);
        if (!$type) {
            return response()->json([
                'message' => 'Không tìm thấy loại công viên sinh học',
            ], 404);
        }
        $this->BioNationalParkTypeRepository->deleteSoft($id);
        return response()->json([
            'message' => 'Xóa thành công',
        ], 200);
    }

    public function restore(int $id)
    {
        $type = $this->BioNationalParkTypeRepository->findById($id, true);
        if (!$type) {
            return response()->json([
                'message' => 'Không tìm thấy loại công viên sinh học',
            ], 404);
        }
        $this->BioNationalParkTypeRepository->restore($id);
        return response()->json([
            'message' => 'Khôi phục thành công',
        ], 200);
    }

    public function list()
    {
        $data = $this->BioNationalParkTypeRepository->list();
        return response()->json([
            'message' => 'Lấy danh sách thành công',
            'data' => $data,
        ], 200);
    }
}
