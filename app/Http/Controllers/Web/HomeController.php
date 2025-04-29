<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        return view('pages.index');
    }

    public function getTerms()
    {
        return view('pages.support.terms');
    }

    public function getPrivacy()
    {
        return view('pages.support.privacy');
    }

    public function getFAQ()
    {
        return view('pages.support.faq');
    }

    public function getDocument()
    {
        return view('pages.document.index');
    }

    public function getDocumentDetail()
    {
        return view('pages.document.detail');
    }

    public function getMaps()
    {
        return view('pages.maps.index');
    }

    public function getMapsDetail()
    {
        return view('pages.maps.detail');
    }

    public function getLogin()
    {
        return view('pages.auth.login');
    }

    public function getRegister()
    {
        return view('pages.auth.register');
    }
}
