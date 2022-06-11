<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Hash;
use Illuminate\Http\Request;

use App\Models\ProductModel;
use App\Models\OrderModel;

class UserController extends Controller
{
    // Страница корзины
    public function cart_page() {
        $model = new OrderModel;
        $products = DB::table("orders")
                ->join("products", "products.product_id", "=", "orders.product_id")
                ->where("user_id", Auth::id())
                ->get();
        $orders = $model->where([
            ["product_id", "=", 0],
            ["user_id", "=", Auth::id()]
        ])->orderby("created_at", "DESC")->get();
        return view("cart", [
            "products" => $products,
            "orders" => $orders
        ]);
    }

    // Оформление заказа
    public function checkout(Request $request) {
        $user = Auth::user();
        if(!Hash::check($request->input("password"), $user->password))
            return redirect()->route("cart_page")->withErrors("Пароль введён некорректно", "message");

        $products = OrderModel::where([
            ["product_id", "!=", 0],
            ["user_id", $user->id]]
        )->get();

        $amount = 0;
        foreach($products as $val) {
            $amount += $val->amount;
            OrderModel::destroy($val->order_id);
        }

        $order = new OrderModel;
        $order->product_id = 0;
        $order->user_id = $user->id;
        $order->status = "Новый";
        $order->amount = $amount;
        $order->save();

        return redirect()->route("cart_page")->withErrors("Заказ оформлен", "message");

    }

    // Удаление нового заказа
    public function order_delete($id) {
        $order = OrderModel::find($id);
        if($order->status != "Новый")
            return redirect()->route("cart_page")->withErrors("Заказ должен иметь статус: \"Новый\"", "message");
        $order->delete();
        return redirect()->route("cart_page")->withErrors("Заказ удалён", "message");
    }

    // Добавление товара
    public function cart_add($id) {
        $product = ProductModel::find($id);
        if($product->count <= 0)
            return redirect()->route("cart_page")->withErrors("Товар отсутствует", "message");

        if($cart_product = OrderModel::where([
            ["product_id", $id],
            ["user_id", Auth::id()]
        ])->first()) {
            $cart_product->amount += 1;

        } else {
            $cart_product = new OrderModel();
            $cart_product->product_id = $id;
            $cart_product->user_id = Auth::id();
            $cart_product->amount = 1;
        } $cart_product->save();

        $product->count -= 1;
        $product->save();

        return redirect()->route("cart_page")->withErrors("Товар добавлен", "message");
    }

    // Удаление товара
    public function cart_delete($id) {
        $product = ProductModel::find($id);
        $cart_product = OrderModel::where([
            ["product_id", $id],
            ["user_id", Auth::id()]
        ])->first();

        if($cart_product->amount <= 1) {
            $cart_product->delete();
        } else {
            $cart_product->amount -= 1;
            $cart_product->save();
        }

        $product->count += 1;
        $product->save();

        return redirect()->route("cart_page")->withErrors("Товар убран", "message");

    }
}
