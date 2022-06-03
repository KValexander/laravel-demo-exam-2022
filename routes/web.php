<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MainController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;

// Маршруты
Route::group(["middleware" => "session"], function() {

    // Главная страница - о нас
    Route::get("/", [MainController::class, "main_page"])->name("main_page");
    // Страница Где нас найти
    Route::get("/where", [MainController::class, "where_page"])->name("where_page");
    // Страница Каталога товаров
    Route::get("/catalog", [MainController::class, "catalog_page"])->name("catalog_page");
    // Страница товара
    Route::get("/product/{id}", [MainController::class, "product_page"])->name("product_page");

    // Авторизация
    Route::post("/login", [AuthController::class, "login"])->name("login");
    // Регистрация
    Route::post("/register", [AuthController::class, "register"])->name("register");

    // Маршруты авторизованных пользователей
    Route::group(["middleware" => "auth"], function() {

        // Страница корзины
        Route::get("/cart", [UserController::class, "cart_page"])->name("cart_page");

        // Добавить товар в корзину
        Route::get("/cart/add/{id}", [UserController::class, "cart_add"])->name("cart_add");

        // Удалить товар из корзины
        Route::get("/cart/delete/{id}", [UserController::class, "cart_delete"])->name("cart_delete");

        // Оформить заказ
        Route::post("/user/checkout", [UserController::class, "checkout"])->name("checkout");
        
        // Удалить новый заказ
        Route::get("/user/order/{id}/delete", [UserController::class, "order_delete"])->name("order_delete");

        // Выход из авторизации
        Route::get("/logout", [AuthController::class, "logout"])->name("logout");

        // Маршруты администратора
        Route::group(["middleware" => "admin"], function() {

            // Страница администратора
            Route::get("/admin", [AdminController::class, "admin_page"])->name("admin_page");

            // Добавление категории
            Route::post("/category/add", [AdminController::class, "category_add"])->name("category_add");
            // Удаление категории
            Route::post("/category/delete", [AdminController::class, "category_delete"])->name("category_delete");

            // Добавление товара
            Route::post("/product_add", [AdminController::class, "product_add"])->name("product_add");
            // Удаление товара
            Route::get("/product/{id}/delete", [AdminController::class, "product_delete"])->name("product_delete");
            // Страница обновления товара
            Route::get("/product/{id}/update", [AdminController::class, "product_update_page"])->name("product_update_page");
            // Обновление товара
            Route::post("/product/{id}/update", [AdminController::class, "product_update"])->name("product_update");

            // Подтвердить заказа
            Route::post("/order/confirm", [AdminController::class, "order_confirm"])->name("order_confirm");
            // Отменить заказ
            Route::post("/order/reject", [AdminController::class, "order_reject"])->name("order_reject");

        });

    });

});
