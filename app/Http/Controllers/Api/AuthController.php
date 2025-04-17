<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected $authService;
    public function __construct()
    {
        $this->authService = app(AuthService::class);
    }

    public function login(Request $request)
    {
        return $this->catchAPI(function () use ($request) {
            return $this->authService->login($request->all());
        });
    }

    public function refresh(Request $request)
    {
        return $this->catchAPI(function () use ($request) {
            return $this->authService->refresh($request->all());
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
}
