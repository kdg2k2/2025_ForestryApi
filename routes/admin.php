<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix("admin")->group(function () {
    Route::get("dashboard", [DashboardController::class, 'index'])->name('dashboard');
});

Route::prefix("users")->group(function () {
    Route::get("/", [UserController::class, 'index'])->name("admin.users.index");
    Route::get("/add", [UserController::class, 'add'])->name("admin.users.add");
    Route::get("/{id}", [UserController::class, 'edit'])->name("admin.users.edit");
});
