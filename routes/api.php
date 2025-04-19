<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DocumentBiodiversityTypeController;
use App\Http\Controllers\Api\DocumentLegalTypeController;
use App\Http\Controllers\Api\DocumentScientificPublicationTypeController;
use App\Http\Controllers\Api\DocumentTypeController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\UserRoleController;
use App\Http\Controllers\Api\UserUnitController;
use App\Http\Controllers\DocumentController;
use Illuminate\Support\Facades\Route;

Route::middleware("api")->group(function () {
    Route::prefix("auth")->controller(AuthController::class)->group(function () {
        # login
        Route::post("login", "login")->middleware("throttle:5,1");
        # refresh access token
        Route::post("refresh", "refresh")->middleware("throttle:5,1");
        # logout
        Route::post("logout", "logout")->middleware("api");
    });

    Route::middleware("auth:api")->group(function () {
        Route::prefix("user")->group(function () {
            # đơn vị
            Route::prefix("unit")->controller(UserUnitController::class)->group(function () {
                Route::get("list", "list");
                Route::post("store", "store");
                Route::patch("update", "update");
                Route::delete("delete", "delete");
            });

            # phân quyền
            Route::prefix("role")->controller(UserRoleController::class)->group(function () {
                Route::get("list", "list");
                Route::post("store", "store");
                Route::patch("update", "update");
                Route::delete("delete", "delete");
            });

            # người dùng
            Route::controller(UserController::class)->group(function () {
                Route::get("list", "list");
                Route::post("store", "store");
                Route::patch("update", "update");
                Route::delete("delete", "delete");
            });
        });

        Route::prefix("document")->group(function () {
            # loại tài liệu
            Route::prefix("type")->controller(DocumentTypeController::class)->group(function () {
                Route::get("list", "list");
                Route::post("store", "store");
                Route::patch("update", "update");
                Route::delete("delete", "delete");

                # loại tài liệu của văn bản pháp luật
                Route::prefix("legal")->controller(DocumentLegalTypeController::class)->group(function () {
                    Route::get("list", "list");
                    Route::post("store", "store");
                    Route::patch("update", "update");
                    Route::delete("delete", "delete");
                });

                # loại tài liệu của ấn phẩm khoa học
                Route::prefix("scientific_publication")->controller(DocumentScientificPublicationTypeController::class)->group(function () {
                    Route::get("list", "list");
                    Route::post("store", "store");
                    Route::patch("update", "update");
                    Route::delete("delete", "delete");
                });

                # loại tài liệu của đa dạng sinh học
                Route::prefix("biodiversity")->controller(DocumentBiodiversityTypeController::class)->group(function () {
                    Route::get("list", "list");
                    Route::post("store", "store");
                    Route::patch("update", "update");
                    Route::delete("delete", "delete");
                });
            });

            # tài liệu
            Route::controller(DocumentController::class)->group(function () {
                Route::get("list", "list");
                Route::post("store", "store");
                Route::patch("update", "update");
                Route::delete("delete", "delete");
                Route::post("show", "show");
            });
        });
    });
});
