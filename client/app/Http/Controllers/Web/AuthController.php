<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function login()
    {
        if (auth('api')->user())
            return redirect(route('dashboard'));
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
