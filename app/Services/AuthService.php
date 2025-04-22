<?php

namespace App\Services;

use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthService extends BaseService
{
    public function login(array $request)
    {
        return $this->tryThrow(function () use ($request) {
            if (!$token = auth('api')->attempt($request))
                throw new Exception('Unauthorized', 401);

            return $this->createNewToken($token, $this->createRefreshToken());
        });
    }

    public function refresh(array $request)
    {
        return $this->tryThrow(function () use ($request) {
            $refreshToken = $request['refresh_token'];
            if (!$refreshToken)
                throw new Exception('Missing refresh token', 401);

            $token = new \Tymon\JWTAuth\Token($refreshToken);
            $payload = JWTAuth::manager()->decode($token);

            if (!isset($payload['refresh']) || $payload['refresh'] !== true)
                throw new Exception('Invalid refresh token', 401);

            $userId = $payload['sub'];
            $user = User::find($userId);

            if (!$user)
                throw new Exception('User not found', 404);

            $token = auth('api')->login($user);
            return $this->createNewToken($token, $this->createRefreshToken());
        });
    }

    public function logout()
    {
        return $this->tryThrow(function () {
            auth('api')->logout();
        });
    }

    protected function createRefreshToken()
    {
        $customClaims = [
            'refresh' => true,
            'exp' => Carbon::now()->addWeeks(2)->timestamp,
        ];

        $refreshToken = JWTAuth::customClaims($customClaims)->fromUser(auth('api')->user());
        return $refreshToken;
    }

    protected function createNewToken($token, $refreshToken)
    {
        $user = auth('api')->user();
        $user['path'] = $this->getAssetImage($user['path']);

        $refreshPayload = JWTAuth::setToken($refreshToken)->getPayload();

        return [
            'token_type' => 'bearer',
            'access_token' => $token,
            'access_token_expires_in' => 3600,
            'refresh_token' => $refreshToken,
            'refresh_token_expires_in' => max($refreshPayload['exp'] - Carbon::now()->timestamp, 0),
            'user' => $user,
        ];
    }
}
