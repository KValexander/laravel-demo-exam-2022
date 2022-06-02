<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ProductModel;

class AdminController extends Controller
{
    // Страница администратора
    public function admin_page() {
        return view("admin");
    }

    // Страница обновления продукта
    public function product_update_page($id) {
        $product = ProductModel::find($id);
        return view("product_update", ["product" => $product]);
    }
}
