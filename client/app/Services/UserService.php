<?php

namespace App\Services;

use App\Repositories\UserRepository;
use App\Services\BaseService;

class UserService extends BaseService
{
    protected $userRepository;
    protected $cartService;
    public function __construct()
    {
        $this->userRepository = app(UserRepository::class);
        $this->cartService = app(CartService::class);
    }

    public function list(array $request)
    {
        return $this->tryThrow(function () use ($request) {
            $records = $this->userRepository->list($request);
            $records = $this->transformRecords($records);
            if ($request["paginate"] == 1)
                $records = $this->paginate($records, $request["per_page"], $request["page"]);
            return $records;
        });
    }

    public function store(array $request)
    {
        return $this->tryThrow(function () use ($request) {
            $request["password"] = bcrypt($request["password"]);
            if (!empty($request["path"]))
                $request["path"] = $this->imageUpload($request["path"]);
            $record = $this->userRepository->store($request);
            $this->cartService->store(["id_user" => $record["id"]]);
            $record = $this->transformRecord($record);
            return $record;
        });
    }

    public function update(array $request)
    {
        return $this->tryThrow(function () use ($request) {
            if (!empty($request["password"]))
                $request["password"] = bcrypt($request["password"]);

            $removeOldPath = false;
            if (!empty($request["path"])) {
                $removeOldPath = true;
                $request["path"] = $this->imageUpload($request["path"]);
            }
            $record = $this->userRepository->update($request, $removeOldPath);
            $record = $this->transformRecord($record);
            return $record;
        });
    }

    public function delete(array $request)
    {
        return $this->tryThrow(function () use ($request) {
            return $this->userRepository->delete($request);
        });
    }

    protected function imageUpload($path)
    {
        return (new FileUploadService())->storeImage($path);
    }

    protected function transformRecords($records)
    {
        return array_map([$this, 'transformRecord'], $records);
    }

    protected function transformRecord($record)
    {
        $record['path'] = $this->getAssetImage($record['path']);
        return $record;
    }

    public function findById(int $id)
    {
        return $this->tryThrow(function () use ($id) {
            return $this->userRepository->findById($id);
        });
    }

    public function findByEmail(string $email)
    {
        return $this->tryThrow(function () use ($email) {
            return $this->userRepository->findByEmail($email);
        });
    }
}
