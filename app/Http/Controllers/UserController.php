<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Cart page
    public function cart_page() {
        $products = DB::table("orders")->join("products", "orders.product_id", "=", "products.product_id")->orderby("orders.created_at", "DESC")->get();
        $orders = DB::table("orders")->where([
            ["user_id", Auth::id()],
            ["product_id", "=", 0]
        ])->orderby("created_at", "DESC")->get();
        return view("cart", ["products" => $products, "orders" => $orders]);
    }

    // Add product to cart
    public function cart_add($id) {
        $product = DB::table("products")->where("product_id", $id)->first();
        if($product->count <= 0)
            return redirect()->route("cart_page")->withErrors("Товар отсутствует", "message");

        if($prod = DB::table("orders")->where([["product_id", $id], ["user_id", Auth::id()]])->first()) {
            DB::table("orders")->where("order_id", $prod->order_id)->update([
                "amount" => ++$prod->amount
            ]);
        } else {
            DB::table("orders")->insert([
                "product_id" => $id,
                "user_id" => Auth::id(),
                "amount" => 1
            ]);
        }

        DB::table("products")->where("product_id", $id)->update(["count" => --$product->count]);
        return redirect()->route("cart_page")->withErrors("Товар добавлен", "message");
    }

    // Remove product from cart
    public function cart_remove($id) {
        $product = DB::table("products")->where("product_id", $id)->first();
        $prod = DB::table("orders")->where([["product_id", $id], ["user_id", Auth::id()]])->first();
        
        DB::table("orders")->where("order_id", $prod->order_id)->update([
            "amount" => --$prod->amount
        ]);

        DB::table("products")->where("product_id", $id)->update(["count" => ++$product->count]);
        return redirect()->route("cart_page")->withErrors("Товар убран", "message");

    }

    // Checkout
    public function checkout(Request $request) {
        $user = Auth::user();
        if(!Hash::check($request->password, $user->password))
            return redirect()->route("cart_page")->withErrors("Пароли не совпадают", "message");

        $products = DB::table("orders")->where([
            ["user_id", $user->id],
            ["product_id", "!=", 0]
        ])->get();

        $amount = 0;
        foreach($products as $val)
            $amount += $val->amount;

        DB::table("orders")->insert([
            "status" => "Новый",
            "product_id" => 0,
            "user_id" => $user->id,
            "amount" => $amount
        ]);

        DB::table("orders")->where([
            ["user_id", $user->id],
            ["product_id", "!=", 0]
        ])->delete();

        return redirect()->route("cart_page")->withErrors("Заказ оформлен", "message");
    }

    // Order delete
    public function order_delete($id) {
        $order = DB::table("orders")->where([["order_id", $id], ["user_id", Auth::id()]])->first();
        if($order->status == "Новый") {
            DB::table("orders")->where("order_id", $id)->delete();
            return redirect()->route("cart_page")->withErrors("Заказ удалён", "message");
        }
        return redirect()->route("cart_page")->withErrors("Заказ не является новым", "message");



    }
}
