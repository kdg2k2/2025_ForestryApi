<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RefreshRequest;
use App\Services\AuthService;
use App\Traits\CheckLocalTraits;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    use CheckLocalTraits;
    protected $authService;
    public function __construct()
    {
        $this->authService = app(AuthService::class);
    }

    public function login(LoginRequest $request)
    {
        return $this->catchAPI(function () use ($request) {
            return $this->setCookie($this->authService->login($request->validated()));
        });
    }

    public function refresh(RefreshRequest $request)
    {
        return $this->catchAPI(function () use ($request) {
            return $this->setCookie($this->authService->refresh($request->validated()));
        });
    }

    protected function setCookie($data)
    {
        $isLocal = $this->isLocal();
        return response()->json($data, 200)
            ->cookie('access_token', $data['access_token'], $data['access_token_expires_in'], '/', null, !$isLocal, true, false, 'Strict')
            ->cookie('refresh_token', $data['refresh_token'], $data['refresh_token_expires_in'], '/', null, !$isLocal, true, false, 'Strict');
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

            $isLocal = $this->isLocal();
            return response()->view('admin.auth.google_callback', [
                'access' => $data['access_token'],
            ])->cookie('access_token', $data['access_token'], $data['access_token_expires_in'], '/', null, !$isLocal, true, false, 'Strict')
                ->cookie('refresh_token', $data['refresh_token'], $data['refresh_token_expires_in'], '/', null, !$isLocal, true, false, 'Strict');
        } catch (\Exception $e) {
            return redirect()->route('login')->withErrors($e->getMessage());
        }
    }
}
