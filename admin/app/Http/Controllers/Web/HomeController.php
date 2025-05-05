<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        return $this->getLogin();
    }

    public function getLogin()
    {
        return view('admin.auth.login');
        // return view('pages.auth.login');
    }
}
