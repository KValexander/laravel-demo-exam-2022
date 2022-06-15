<?php

namespace App\Http\Controllers;

use DB;
use Validator;
use Illuminate\Http\Request;

use App\Models\CategoryModel;
use App\Models\ProductModel;
use App\Models\OrderModel;

class AdminController extends Controller
{
    // Страница администратора
    public function admin_page() {
        $orders = DB::table("orders")->join("users", "orders.user_id", "=", "users.id")->where("orders.product_id", 0)->get();
        $categories = CategoryModel::all();
        return view("admin", ["orders" => $orders, "categories" => $categories]);
    }

    // Страница обновления товара
    public function product_update_page($id) {
        return view("product_update", [
            "product" => ProductModel::find($id),
            "categories" => CategoryModel::all()
        ]);
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

    // Добавление товара
    public function product_add(Request $request) {
        $validator = Validator::make($request->all(), [
            "image" => "required|image|max:2048"
        ]);
        if($validator->fails())
            return redirect()->route("admin_page")->withErrors("Файл должен быть изображением и не должен весить более 2мб", "message");

        $product = new ProductModel;
        $product->name = $request->input("name");
        $product->price = $request->input("price");
        $product->country = $request->input("country");
        $product->year = $request->input("year");
        $product->model = $request->input("model");
        $product->category = $request->input("category");
        $product->count = $request->input("count");

        $image_name = time() ."_". rand() .".". $request->file("image")->extension();
        $request->file("image")->move(public_path("images/upload/"), $image_name);
        $product->path = "images/upload/". $image_name;

        $product->save();

        return redirect()->route("admin_page")->withErrors("Товар добавлен", "message");
    }

    // Удаление товара
    public function product_delete($id) {
        $product = ProductModel::find($id);
        unlink(public_path($product->path));
        $product->delete();
        return redirect()->route("admin_page")->withErrors("Товар удалён", "message");
    }

    // Обновление товара
    public function product_update(Request $request) {
        $id = $request->route("id");

        $product = ProductModel::find($id);
        $product->name = $request->input("name");
        $product->price = $request->input("price");
        $product->country = $request->input("country");
        $product->year = $request->input("year");
        $product->model = $request->input("model");
        $product->category = $request->input("category");
        $product->count = $request->input("count");

        if($request->has("image")) {
            unlink(public_path($product->path));
            $image_name = time() ."_". rand() .".". $request->file("image")->extension();
            $request->file("image")->move(public_path("images/upload/"), $image_name);
            $product->path = "images/upload/". $image_name;
        }

        $product->save();

        return redirect()->route("product_page", ["id" => $id])->withErrors("Товар обновлён", "message");
    }

}
