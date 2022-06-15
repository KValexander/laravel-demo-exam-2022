<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Admin page
    public function admin_page() {
        $categories = DB::table("categories")->get();
        $orders = DB::table("orders")->join("users", "users.id", "=", "orders.user_id")->where("orders.product_id", 0)->orderby("orders.created_at", "DESC")->get();
        return view("admin", [
            "categories" => $categories,
            "orders" => $orders
        ]);
    }

    // Product delete
    public function product_delete($id) {
        DB::table("orders")->where("product_id", $id)->delete();
        DB::table("products")->where("product_id", $id)->delete();
        return redirect()->route("admin_page")->withErrors("Товар удалён", "message");
    }

    // Product update page
    public function product_update_page($id) {

    }

    // Category add
    public function category_add(Request $request) {
        DB::table("categories")->insert([
            "category" => $request->input("category")
        ]);
        return redirect()->route("admin_page")->withErrors("Категория добавлена", "message");
    }

    // Category delete
    public function category_delete(Request $request) {
        DB::table("categories")->where("category_id", $request->input("category_id"))->delete();
        return redirect()->route("admin_page")->withErrors("Категория удалена", "message");
    }

    // Order confirm
    public function order_confirm($id) {
        DB::table("orders")->where("order_id", $id)->update([
            "status" => "Подтверждённый"
        ]);
        return redirect()->route("admin_page")->withErrors("Заказ подтверждён", "message");
    }

    // Order reject
    public function order_reject(Request $request) {
        DB::table("orders")->where("order_id", $request->route("id"))->update([
            "status" => "Отменённый",
            "reason" => $request->input("reason")
        ]);
        return redirect()->route("admin_page")->withErrors("Заказ отменён", "message");
    }

}
