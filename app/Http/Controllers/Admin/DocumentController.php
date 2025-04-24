<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function index()
    {
        return view("admin.pages.document.index");
    }

    public function create() {}

    public function edit() {}
}
