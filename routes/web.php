<?php

use App\Http\Controllers\Web\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    echo ('welcome');
});

# login
Route::get("login", [AuthController::class, "login"])->name("login");
# register
Route::get("register", [AuthController::class, "register"])->name("register");
# verify account
Route::get("verify", [AuthController::class, "verify"])->name("verify");
# forget password
Route::get("forget-password", [AuthController::class, "forgetPassword"])->name("forget-password");
