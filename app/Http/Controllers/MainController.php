<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    // Главная страница
    public function main_page() {
        return view("index");
    }

    // Страница Где нас найти
    public function where_page() {
        return view("where");
    }

    // Страница Каталог
    public function catalog_page() {
        return view("catalog");
    }

    // Страница товара
    public function product_page() {
        return view("product");
    }
}
