<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RefreshRequest;
use App\Services\AuthService;
use Illuminate\Http\Request;

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
        $url = (new AuthService())->authGoogleRedirect();
        return redirect()->away($url);
    }

    public function authGoogleCallback(Request $request)
    {
        try {
            $data = (new AuthService())->authGoogleCallback();

            // nếu client gửi Accept: application/json
            if ($request->expectsJson())
                return response()->json($data, 200);

            return response()->view('admin.auth.google_callback', [
                'access' => $data['access_token'],
                'refresh' => $data['refresh_token'],
            ]);
        } catch (\Exception $e) {
            return redirect()->route('login')->withErrors($e->getMessage());
        }
    }
}
