<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;

class SessionMiddleware
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

        // Если пользователь авторизован
        if(Auth::check())
            $user = Auth::user();

        // Если нет
        else
            $user = (object)[
                "user_id" => 0,
                "role" => "guest"
            ];

        // Передаём данные представлению
        view()->share([
            "user_id" => $user->user_id,
            "role" => $user->role
        ]);

        // Идём дальше
        return $next($request);
    }
}
