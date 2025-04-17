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
        return $this->catchAPI(function () use ($request) {
            return $this->userRepository->list($request);
        });
    }

    public function store(array $request)
    {
        return $this->catchAPI(function () use ($request) {
            $request["password"] = bcrypt($request["password"]);
            $request["path"] = $this->imageUpload($request["path"]);
            return $this->userRepository->store($request);
        });
    }

    public function update(array $request)
    {
        return $this->catchAPI(function () use ($request) {
            if (!empty($request["password"]))
                $request["password"] = bcrypt($request["password"]);

            if (!empty($request["path"]))
                $request["path"] = $this->imageUpload($request["path"]);
            return $this->userRepository->update($request);
        });
    }

    public function delete(array $request)
    {
        return $this->catchAPI(function () use ($request) {
            return $this->userRepository->delete($request);
        });
    }

    protected function imageUpload($path)
    {
        return (new ImageUploadService())->store($path, "images");
    }
}
