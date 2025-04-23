<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function login()
    {
        if (auth('api')->user()) {
            dd(auth('api')->user());
            return redirect(route('admin.dashboard.index'));
        }
        return view("admin.auth.login");
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
