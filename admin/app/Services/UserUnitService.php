<?php

namespace App\Services;

use App\Repositories\UserUnitRepository;
use App\Services\BaseService;

class UserUnitService extends BaseService
{
    protected $userUnitRepository;
    public function __construct()
    {
        $this->userUnitRepository = app(UserUnitRepository::class);
    }

    public function list(array $request)
    {
        return $this->tryThrow(function () use ($request) {
            $records = $this->userUnitRepository->list($request);
            if ($request["paginate"] == 1)
                $records = $this->paginate($records, $request["per_page"], $request["page"]);
            return $records;
        });
    }

    public function store(array $request)
    {
        return $this->tryThrow(function () use ($request) {
            return $this->userUnitRepository->store($request);
        });
    }

    public function update(array $request)
    {
        return $this->tryThrow(function () use ($request) {
            return $this->userUnitRepository->update($request);
        });
    }

    public function delete(array $request)
    {
        return $this->tryThrow(function () use ($request) {
            return $this->userUnitRepository->delete($request);
        });
    }
}
