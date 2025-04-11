<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Route;

Route::prefix("auth")->controller(AuthController::class)->group(function () {
    # login
    Route::post("login", "login");
    # refresh access token
    Route::post("refresh", "refresh")->middleware("throttle:5,1");
    # logout
    Route::post("logout", "logout")->middleware("api");
});
