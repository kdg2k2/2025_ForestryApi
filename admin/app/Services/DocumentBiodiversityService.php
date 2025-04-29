<?php

namespace App\Services;

use App\Repositories\DocumentBiodiversityRepository;

class DocumentBiodiversityService extends BaseService
{
    protected $DocumentBiodiversityRepository;
    public function __construct()
    {
        $this->DocumentBiodiversityRepository = new DocumentBiodiversityRepository();
    }

    public function store(array $request)
    {
        return $this->tryThrow(function () use ($request) {
            return $this->DocumentBiodiversityRepository->store($request);
        });
    }

    public function update(array $request)
    {
        return $this->tryThrow(function () use ($request) {
            return $this->DocumentBiodiversityRepository->update($request);
        });
    }
}
