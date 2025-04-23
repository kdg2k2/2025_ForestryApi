<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Services\AuthService;

class AuthController extends Controller
{
    public function login()
    {
        return view("admin.auth.login");
    }

    public function authGoogleRedirect()
    {
        return $this->catchAPI(function () {
            return $this->catchAPI(function () {
                $data = (new AuthService())->authGoogleCallback(); 
                $access = $data['access_token'];
                $refresh = $data['refresh_token'];
                $minutes = $data['refresh_token_expires_in'] / 60;
        
                return response()
                    ->view('admin.auth.google_callback', compact('access','refresh'))
                    ->cookie('refresh_token', $refresh, $minutes, '/', null, true, true);
            });
        });
    }

    public function register()
    {
        return view("admin.auth.register");
    }

    public function verify()
    {
        return view("admin.auth.verify");
    }

    public function forgetPassword()
    {
        return view("admin.auth.forget-password");
    }
}
