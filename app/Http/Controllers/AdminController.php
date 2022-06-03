<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\CategoryModel;
use App\Models\ProductModel;
use App\Models\OrderModel;

class AdminController extends Controller
{
    // Страница администратора
    public function admin_page() {
        $orders = OrderModel::where("product_id", 0)->get();
        $categories = CategoryModel::all();
        return view("admin", ["orders" => $orders, "categories" => $categories]);
    }

    // Страница обновления продукта
    public function product_update_page($id) {
        $product = ProductModel::find($id);
        return view("product_update", ["product" => $product]);
    }

    // Добавление категориия
    public function category_add(Request $request) {
        $category = new CategoryModel;
        $category->category = $request->input("category");
        $category->save();
        return redirect()->route("admin_page")->withErrors("Категория добавлена", "message");
    }

    // Удаление категории
    public function category_delete(Request $request) {
        $category = CategoryModel::find($request->input("category_id"));
        $category->delete();
        return redirect()->route("admin_page")->withErrors("Категория удалена", "message");
    }

    // Подтвердить заказа
    public function order_confirm(Request $request) {
        $order = OrderModel::find($request->input("order_id"));
        $order->status = "Подтверждённый";
        $order->save();
        return redirect()->route("admin_page")->withErrors("Заказ подтверждён", "message");
    }

    // Отменить заказ
    public function order_reject(Request $request) {
        $order = OrderModel::find($request->input("order_id"));
        $order->status = "Отменённый";
        $order->reason = $request->input("reason");
        $order->save();
        return redirect()->route("admin_page")->withErrors("Заказ отменён", "message");
    }

}
