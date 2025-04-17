<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DocumentTypeController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\UserRoleController;
use App\Http\Controllers\Api\UserUnitController;
use App\Http\Controllers\DocumentController;
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
        Route::get("list", "list")->name("user.unit.list");
        Route::post("store", "store")->name("user.unit.store");
        Route::patch("update", "update")->name("user.unit.update");
        Route::delete("delete", "delete")->name("user.unit.delete");
    });

    # phân quyền
    Route::prefix("role")->controller(UserRoleController::class)->group(function () {
        Route::get("list", "list")->name("user.role.list");
        Route::post("store", "store")->name("user.role.store");
        Route::patch("update", "update")->name("user.role.update");
        Route::delete("delete", "delete")->name("user.role.delete");
    });

    # người dùng
    Route::controller(UserController::class)->group(function () {
        Route::get("list", "list")->name("user.list");
        Route::post("store", "store")->name("user.store");
        Route::patch("update", "update")->name("user.update");
        Route::delete("delete", "delete")->name("user.delete");
    });
});

Route::prefix("document")->group(function () {
    # loại tài liệu
    Route::prefix("type")->controller(DocumentTypeController::class)->group(function () {
        Route::get("list", "list")->name("document.type.list");
        Route::post("store", "store")->name("document.type.store");
        Route::patch("update", "update")->name("document.type.update");
        Route::delete("delete", "delete")->name("document.type.delete");
    });

    # tài liệu
    Route::controller(DocumentController::class)->group(function () {
        Route::get("list", "list")->name("document.list");
        Route::post("store", "store")->name("document.store");
        Route::patch("update", "update")->name("document.update");
        Route::delete("delete", "delete")->name("document.delete");
        Route::post("show", "show")->name("document.show");
    });
});
