<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BioNationalParkTypeController as bnptc;
use App\Http\Controllers\Api\BioNationalParkController as bnpc;
use App\Http\Controllers\Api\DocumentBiodiversityTypeController;
use App\Http\Controllers\Api\DocumentControllser;
use App\Http\Controllers\Api\DocumentLegalTypeController;
use App\Http\Controllers\Api\DocumentScientificPublicationTypeController;
use App\Http\Controllers\Api\DocumentTypeController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\UserRoleController;
use App\Http\Controllers\Api\UserUnitController;
use App\Http\Controllers\Api\CartController;
use Illuminate\Support\Facades\Route;

Route::middleware("api")->group(function () {
    Route::prefix("auth")->controller(AuthController::class)->group(function () {
        # login
        Route::post("login", "login")->middleware("throttle:5,1")->name("auth.login");
        # refresh access token
        Route::post("refresh", "refresh")->middleware("throttle:5,1")->name("auth.refresh");
        # logout
        Route::post("logout", "logout")->middleware("auth:api")->name("auth.logout");
        # google
        Route::prefix("google")->group(function () {
            # redirect to Google's OAuth page
            Route::get('redirect', 'authGoogleRedirect')->name('auth.google.redirect');
            # handle the callback from Google
            Route::get('callback', 'authGoogleCallback')->name('auth.google.callback');
        });
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

        Route::prefix("cart")->group(function () {
            Route::controller(CartController::class)->group(function () {
                Route::get("", "index");
                Route::post("", "addItem");
                Route::delete("", "deleteItem");
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
            Route::controller(DocumentControllser::class)->group(function () {
                Route::get("list", "list")->name("api.document.list");
                Route::post("store", "store")->name("api.document.store");
                Route::patch("update", "update")->name("api.document.update");
                Route::delete("delete", "delete")->name("api.document.delete");
                Route::post("show", "show")->name("api.document.show");
            });
        });

        Route::prefix("bio-national-park-type")->group(function () {
            Route::controller(bnptc::class)->group(function () {
                Route::get("", "list")->name("bio-national-park-type.list");
                Route::post("", "store")->name("bio-national-park-type.store");
                Route::patch("", "update")->name("bio-national-park-type.update");
                Route::delete("{id}", "deleteSoft")->name("bio-national-park-type.delete");
                Route::patch("restore/{id}", "restore")->name("bio-national-park-type.restore");
            });
        });

        Route::prefix("bio-national-park")->group(function () {
            Route::controller(bnpc::class)->group(function () {
                Route::post("", "store")->name("bio-national-park.store");
                Route::get("", "list")->name("bio-national-park.list");
                Route::patch("", "update")->name("bio-national-park.update");
                Route::delete("{id}", "deleteSoft")->name("bio-national-park-type.delete");
                Route::patch("restore/{id}", "restore")->name("bio-national-park-type.restore");
            });
        });
    });
});
