<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ProductModel;
use App\Models\CategoryModel;

class MainController extends Controller
{
    // Главная страница
    public function main_page() {
        $model = new ProductModel;
        $products = $model->where("count", ">", 0)->orderby("updated_at", "DESC")->take(5)->get();
        return view("index", ["products" => $products]);
    }

    // Страница Где нас найти
    public function where_page() {
        return view("where");
    }

    // Страница Каталог
    public function catalog_page() {
        $products = ProductModel::where("count", ">", 0)->get();
        $categories = CategoryModel::all();
        return view("catalog", ["products" => $products, "categories" => $categories]);
    }

    // Страница товара
    public function product_page($id) {
        $product = ProductModel::find($id);
        return view("product", ["product" => $product]);
    }
}
