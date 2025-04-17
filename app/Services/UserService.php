<?php

namespace App\Services;

use App\Repositories\UserRepository;
use App\Services\BaseService;

class UserService extends BaseService
{
    protected $userRepository;
    public function __construct()
    {
        $this->userRepository = app(UserRepository::class);
    }

    public function list(array $request)
    {
        return $this->tryThrow(function () use ($request) {
            return $this->userRepository->list($request);
        });
    }

    public function store(array $request)
    {
        return $this->tryThrow(function () use ($request) {
            $request["password"] = bcrypt($request["password"]);
            $request["path"] = $this->imageUpload($request["path"]);
            return $this->userRepository->store($request);
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
            return $this->userRepository->update($request, $removeOldPath);
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
}
