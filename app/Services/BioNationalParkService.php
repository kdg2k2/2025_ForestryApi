<?php

namespace App\Services;

use App\Repositories\BioNationalParkRepository;
use App\Services\BaseService;
use Illuminate\Support\Str;

class BioNationalParkService extends BaseService
{
    protected $BioNationalParkRepository;
    protected $fileUploadService;
    public function __construct()
    {
        $this->BioNationalParkRepository = app(BioNationalParkRepository::class);
        $this->fileUploadService = app(FileUploadService::class);
    }

    public function store(array $request)
    {
        if (isset($request['logo'])) {
            $request['logo'] = $this->fileUploadService->storeImage($request['logo']);
        }
        if (isset($request['intro_img'])) {
            $request['intro_img'] = $this->fileUploadService->storeImage($request['intro_img']);
        }
        // generate slug
        $request['slug'] = $this->generateSlug($request['name']);
        $park = $this->BioNationalParkRepository->store($request);
        return response()->json([
            'message' => 'Tạo mới thành công',
            'data' => $park,
        ], 201);
    }

    private function generateSlug(string $name)
    {
        return Str::slug($name);
    }

    public function list(array $request)
    {
        return $this->tryThrow(function () use ($request) {
            return $this->BioNationalParkRepository->list($request);
        });
    }

    public function update(array $request, int $id)
    {
        $park = $this->BioNationalParkRepository->findById($id);
            if (!$park) {
                return response()->json([
                    'message' => 'Không tìm thấy công viên sinh học',
                ], 404);
            }
        if (isset($request['logo'])) {
            $request['logo'] = $this->fileUploadService->storeImage($request['logo']);
        }
        if (isset($request['intro_img'])) {
            $request['intro_img'] = $this->fileUploadService->storeImage($request['intro_img']);
        }
        // generate slug
        if (isset($request['name'])) {
            $request['slug'] = $this->generateSlug($request['name']);
        }
        $park = $this->BioNationalParkRepository->update($request, $id);
        return response()->json([
            'message' => 'Cập nhật thành công',
            'data' => $park,
        ], 200);
    }

    public function deleteSoft(int $id)
    {
        return $this->tryThrow(function () use ($id) {
            $park = $this->BioNationalParkRepository->findById($id);
            if (!$park) {
                return response()->json([
                    'message' => 'Không tìm thấy công viên sinh học',
                ], 404);
            }
            $this->BioNationalParkRepository->deleteSoft($id);
            return response()->json([
                'message' => 'Xóa thành công',
            ], 200);
        });
    }

    public function restore(int $id)
    {
        return $this->tryThrow(function () use ($id) {
            $park = $this->BioNationalParkRepository->findById($id, true);
            if (!$park) {
                return response()->json([
                    'message' => 'Không tìm thấy công viên sinh học',
                ], 404);
            }
            $this->BioNationalParkRepository->restore($id);
            return response()->json([
                'message' => 'Khôi phục thành công',
            ], 200);
        });
    }
}
