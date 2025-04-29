<?php

use App\Http\Controllers\Payment\VnPayController;
use App\Http\Controllers\Web\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\HomeController;

Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/terms-of-service', 'getTerms');
    Route::get('/privacy-policy', 'getPrivacy');
    Route::get('/faq', 'getFAQ');
    Route::get('/document', 'getDocument');
    Route::get('/document/index', 'getDocumentDetail');
    Route::get('/maps', 'getMaps');
    Route::get('/maps/index', 'getMapsDetail');
    Route::get('register', 'getRegister')->name("register");
    Route::get('login', 'getLogin')->name("login");
});

Route::controller(AuthController::class)->group(function () {
    # login
    Route::get("login", "login")->name("login");
    # register
    Route::get("register", "register")->name("register");
    # verify account
    Route::get("verify", "verify")->name("verify");
    # forget password
    Route::get("forget-password", "forgetPassword")->name("forget-password");
});

# vnpay
Route::prefix("vnpay")->controller(VnPayController::class)->group(function () {
    Route::get('create-payment', 'createPayment')->name('vnpay.create-payment');
    Route::get('return', 'vnpayReturn')->name('vnpay.return');
});
