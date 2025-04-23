<?php

namespace App\Services;

use Carbon\Carbon;
use Exception;
use GuzzleHttp\Client;
use Str;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Token;

class AuthService extends BaseService
{
    protected $userService;
    protected $customValidateService;
    public function __construct()
    {
        $this->userService = app(UserService::class);
        $this->customValidateService = app(CustomValidateRequestService::class);
    }

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

            $token = new Token($refreshToken);
            $payload = JWTAuth::manager()->decode($token);

            if (!isset($payload['refresh']) || $payload['refresh'] !== true)
                throw new Exception('Invalid refresh token', 401);

            $userId = $payload['sub'];
            $user = $this->userService->findById($userId);

            if (!$user)
                throw new Exception('User not found', 404);

            $token = $this->createTokenWithUser($user);
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

    protected function createTokenWithUser($user)
    {
        return auth('api')->login($user);
    }

    public function authGoogleRedirect()
    {
        return $this->tryThrow(function () {
            return 'https://accounts.google.com/o/oauth2/v2/auth?' . http_build_query([
                'client_id' => env('GOOGLE_CLIENT_ID'),
                'redirect_uri' => env('GOOGLE_REDIRECT_URL'),
                'response_type' => 'code',
                'scope' => 'email profile',
                'state' => Str::random(40),
            ]);
        });
    }

    public function authGoogleCallback()
    {
        return $this->tryThrow(function () {
            $client = new Client();
            $response = $client->post('https://oauth2.googleapis.com/token', [
                'form_params' => [
                    'code' => request('code'),
                    'client_id' => env('GOOGLE_CLIENT_ID'),
                    'client_secret' => env('GOOGLE_CLIENT_SECRET'),
                    'redirect_uri' => env('GOOGLE_REDIRECT_URL'),
                    'grant_type' => 'authorization_code',
                ],
            ]);

            $data = json_decode($response->getBody()->getContents(), true);
            $googleUser = $client->get('https://www.googleapis.com/oauth2/v3/userinfo', [
                'headers' => ['Authorization' => 'Bearer ' . $data['access_token']]
            ]);
            $googleUser = json_decode($googleUser->getBody()->getContents(), true);

            $existingUser = $this->userService->findByEmail($googleUser['email']);
            if (!$existingUser) {
                $userInfo = [
                    'name' => $googleUser['name'],
                    'email' => $googleUser['email'],
                    'password' => bcrypt(time() . $googleUser['email']),
                ];
                $existingUser = $this->newUserGoogle($userInfo);
                $existingUser = $this->userService->findById($existingUser['id']);
            }

            $token = $this->createTokenWithUser($existingUser);
            return $this->createNewToken($token, $this->createRefreshToken());
        });
    }

    protected function newUserGoogle(array $userInfo)
    {
        $validated = $this->customValidateService->validate(
            $userInfo,
            new \App\Http\Requests\User\StoreRequest
        );

        return $this->userService->store($validated);
    }
}
