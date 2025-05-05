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
        return $this->BioNationalParkRepository->store($request);
    }

    private function generateSlug(string $name)
    {
        return Str::slug($name);
    }

    public function list(array $request)
    {
        return $this->tryThrow(function () use ($request) {
            $records = $this->BioNationalParkRepository->list($request);
            if (isset($request["paginate"]) && $request["paginate"] == 1)
                $records = $this->paginate($records, $request["per_page"], $request["page"]);
            return $records;
        });
    }

    public function update(array $request)
    {
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
        return $this->BioNationalParkRepository->update($request, $request['id']);
    }

    public function deleteSoft(int $id)
    {
        return $this->tryThrow(function () use ($id) {
            $park = $this->BioNationalParkRepository->findById($id);
            if (!$park) {
                throw new \Exception('Không tìm thấy vườn quốc gia', 404);
            }
            return $this->BioNationalParkRepository->deleteSoft($id);
        });
    }

    public function restore(int $id)
    {
        return $this->tryThrow(function () use ($id) {
            $park = $this->BioNationalParkRepository->findById($id, true);
            if (!$park) {
                throw new \Exception('Không tìm thấy vườn quốc gia', 404);
            }
            return $this->BioNationalParkRepository->restore($id);
        });
    }
}
