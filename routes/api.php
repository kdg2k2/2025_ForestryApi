<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserUnitController;
use Illuminate\Support\Facades\Route;

Route::prefix("auth")->controller(AuthController::class)->group(function () {
    # login
    Route::post("login", "login")->middleware("throttle:5,1");
    # refresh access token
    Route::post("refresh", "refresh")->middleware("throttle:5,1");
    # logout
    Route::post("logout", "logout")->middleware("api");
});

Route::prefix("user")->group(function () {
    # đơn vị
    Route::prefix("unit")->controller(UserUnitController::class)->group(function () {
        Route::get("list", "list");
        Route::post("store", "store");
        Route::patch("update", "update");
        Route::delete("delete", "delete");
    });
});
