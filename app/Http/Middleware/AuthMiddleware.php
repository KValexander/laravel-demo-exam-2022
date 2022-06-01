<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        // Если пользователь авторизован, то идёт дальше
        if(Auth::check())
            return $next($request);

        // Если нет - то на главную страницу
        else return redirect()
                ->route("main_page")
                ->withErrors("Вы не авторизованы", "message");
    }
}
