<?php

use App\Http\Controllers\Admin\CartController;
use App\Http\Controllers\Admin\CheckoutController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DocumentController;
use App\Http\Controllers\Admin\UserRoleController;
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
    Route::get("{id}/view", "view")->name("admin.document.view");
});

Route::prefix('checkout')->controller(CheckoutController::class)->group(function () {
    Route::get('result', 'result')->name('admin.checkout.result');
});

Route::get("/cart", [CartController::class, 'index'])->name("admin.cart.index");

Route::prefix('role')->controller(UserRoleController::class)->group(function () {
    Route::get('upgrade', 'upgrade')->name('admin.role.upgrade');
    Route::get('payment', 'payment')->name('admin.role.payment');
    Route::get("vnpay-return", "vnpayReturn")->name("admin.role.vnpay-return");
});
