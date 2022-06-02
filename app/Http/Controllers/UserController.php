<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

use App\Models\ProductModel;
use App\Models\OrderModel;

class UserController extends Controller
{
    // Страница корзины
    public function cart_page() {
        $model = new OrderModel;
        $products = $model->where([
            ["product_id", "!=", 0],
            ["user_id", "=", Auth::id()]
        ])->get();
        $orders = $model->where([
            ["product_id", "=", 0],
            ["user_id", "=", Auth::id()]
        ])->get();
        return view("cart", [
            "products" => $products,
            "orders" => $orders
        ]);
    }

    // Добавление товара
    public function cart_add($id) {
        $product = ProductModel::find($id);
        if($product->count <= 0)
            return redirect()->route("cart_page")->withErrors("Товар отсутствует", "message");

        if(is_array($cart_product = OrderModel::where("product_id", $product)->get())) {
            $cart_product->count += 1;
        } else {
            $cart_product = new OrderModel();
            $cart_product->product_id = $id;
            $cart_product->user_id = Auth::id();
            $cart_product->count = 1;
        }
        $cart_product->save();

        $product->count -= 1;
        $product->save();

        return redirect()->route("cart_page")->withErrors("Товар добавлен", "message");
    }
}
