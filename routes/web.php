<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MainController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;

Route::group(["middleware" => "session"], function() {

    Route::get("/", [MainController::class, "main_page"])->name("main_page");
    Route::get("/where", [MainController::class, "where_page"])->name("where_page");
    Route::get("/catalog", [MainController::class, "catalog_page"])->name("catalog_page");
    Route::get("/product/{id}", [MainController::class, "product_page"])->name("product_page");

    Route::post("/login", [AuthController::class, "login"])->name("login");
    Route::post("/register", [AuthController::class, "register"])->name("register");

    Route::group(["middleware" => "auth"], function() {

        Route::get("/cart", [UserController::class, "cart_page"])->name("cart_page");
        Route::get("/cart/add/{id}", [UserController::class, "cart_add"])->name("cart_add");
        Route::get("/cart/remove/{id}", [UserController::class, "cart_remove"])->name("cart_remove");

        Route::post("/cart/checkout", [UserController::class, "checkout"])->name("checkout");
        Route::get("/order/{id}/delete", [UserController::class, "order_delete"])->name("order_delete");

        Route::get("/logout", [AuthController::class, "logout"])->name("logout");

        Route::group(["middleware" => "admin"], function() {

            Route::get("/admin", [AdminController::class, "admin_page"])->name("admin_page");
            Route::post("/category_add", [AdminController::class, "category_add"])->name("category_add");
            Route::post("/category_delete", [AdminController::class, "category_delete"])->name("category_delete");

            Route::post("/product_add", [AdminController::class, "product_add"])->name("product_add");
            Route::get("/product/{id}/delete", [AdminController::class, "product_delete"])->name("product_delete");
            
            Route::get("/product/{id}/update", [AdminController::class, "product_update_page"])->name("product_update_page");
            Route::post("/product/{id}/update", [AdminController::class, "product_update"])->name("product_update");

            Route::post("/order/{id}/confirm", [AdminController::class, "order_confirm"])->name("order_confirm");
            Route::post("/order/{id}/reject", [AdminController::class, "order_reject"])->name("order_reject");


        });


    });


});
