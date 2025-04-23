<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RefreshRequest;
use App\Services\AuthService;

class AuthController extends Controller
{
    protected $authService;
    public function __construct()
    {
        $this->authService = app(AuthService::class);
    }

    public function login(LoginRequest $request)
    {
        return $this->catchAPI(function () use ($request) {
            return response()->json($this->authService->login($request->validated()), 200);
        });
    }

    public function refresh(RefreshRequest $request)
    {
        return $this->catchAPI(function () use ($request) {
            return response()->json($this->authService->refresh($request->validated()), 200);
        });
    }

    public function logout()
    {
        return $this->catchAPI(function () {
            $this->authService->logout();
            return response()->json([
                'message' => 'User successfully signed out'
            ], 200);
        });
    }

    public function authGoogleRedirect()
    {
        return $this->catchAPI(function () {
            return redirect($this->authService->authGoogleRedirect());
        });
    }

    public function authGoogleCallback()
    {
        return $this->catchAPI(function () {
            return response()->json($this->authService->authGoogleCallback(), 200);
        });
    }
}
