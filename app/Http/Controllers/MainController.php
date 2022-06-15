<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class MainController extends Controller
{
    // Main page
    public function main_page() {
        $products = DB::table("products")->orderby("created_at", "DESC")->limit(5)->get();
        return view("index", ["products" => $products]);
    }
    // Where page
    public function where_page() {
        return view("where");
    }
    // Catalog page
    public function catalog_page() {
        $products = DB::table("products")->where("count", "!=", 0)->orderby("created_at", "DESC")->get();
        $categories = DB::table("categories")->get();
        return view("catalog", [
            "products" => $products,
            "categories" => $categories
        ]);
    }
    // Product page
    public function product_page($id) {
        $product = DB::table("products")->where("product_id", $id)->first();
        return view("product", [
            "product" => $product,
        ]);
    }
}
