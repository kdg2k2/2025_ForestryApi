<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function result(Request $request)
    {
        return view('admin.pages.checkout.result');
    }
}
