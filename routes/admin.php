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

Route::prefix("documents")->controller(DocumentController::class)->group(function () {
    Route::get("/", "index")->name("admin.document.index");
    Route::get("create", "create")->name("admin.document.create");
    Route::get("payment", "payment")->name("admin.document.payment");
    Route::get("vnpay-return", "vnpayReturn")->name("admin.document.vnpay-return");
    Route::get("{id}", "edit")->name("admin.document.edit");
});
