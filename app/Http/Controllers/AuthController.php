<?php

namespace App\Http\Controllers;

use Auth;
use Validator;
use Illuminate\Http\Request;

use App\Models\UserModel;

class AuthController extends Controller
{
    // Регистрация
    public function register(Request $request) {

        // Представьте, что здесь валидация

        // Добавление пользователя в базу
        $user = new UserModel;
        $user->name = $request->name;
        $user->surname = $request->surname;
        if($request->has("patronymic"))
            $user->patronymic = $request->patronymic;
        $user->login = $request->login;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->role = "user";
        $user->save();

        // Перенаправление на главную страницу
        return redirect()->route("main_page")->withErrors("Вы зарегистрировались", "message");

    }

    // Авторизация
    public function login(Request $request) {

        // Авторизация
        if(Auth::attempt([
            "login" => $request->login,
            "password" => $request->password
        ], true))
            return redirect()->route("cart_page");

        // В случае неудачи
        else return redirect()
                ->route("main_page")
                ->withErrors("Ошибка логина или пароля", "message");

    }

    // Выход из авторизации
    public function logout() {
        Auth::logout();
        return redirect()->route("main_page")->withErrors("Вы вышли", "message");
    }

}
