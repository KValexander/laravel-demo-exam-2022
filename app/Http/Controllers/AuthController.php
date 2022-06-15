<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    // Register
    public function register(Request $request) {
        DB::table("users")->insert([
            "name" => $request->input("name"),
            "surname" => $request->input("surname"),
            "patronymic" => $request->input("patronymic"),
            "login" => $request->input("login"),
            "email" => $request->input("email"),
            "password" => bcrypt($request->input("password")),
            "role" => "user"
        ]);
        return redirect()->route("main_page")->withErrors("Вы зарегистрировались", "message");
    }

    // Login
    public function login(Request $request) {
        $login = $request->input("login");
        $password = $request->input("password");

        if(Auth::attempt(["login" => $login, "password" => $password], true))
            return redirect()->route("cart_page");
        else return redirect()->route("main_page")->withErrors("Ошибка логина или пароля", "message");
    }

    // Logout
    public function logout() {
        Auth::logout();
        return redirect()->route("main_page")->withErrors("Вы вышли", "message");
    }
}
