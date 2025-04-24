<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DocumentController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::get("dashboard", [DashboardController::class, 'index'])->name('dashboard');

Route::prefix("users")->group(function () {
    Route::get("/", [UserController::class, 'index'])->name("admin.users.index");
    Route::get("/add", [UserController::class, 'add'])->name("admin.users.add");
    Route::get("/{id}", [UserController::class, 'edit'])->name("admin.users.edit");
});

Route::prefix("document")->group(function () {
    Route::get("/", [DocumentController::class, 'index'])->name("admin.document.index");
    Route::get("/add", [DocumentController::class, 'add'])->name("admin.document.add");
});
