<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
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
        // Получаем данные пользователя
        $user = Auth::user();

        // Администратор проходит, остальные идут мимо
        if($user->role == "admin")
            return $next($request);

        else return redirect()
                ->route("cart_page")
                ->withErrors("Недостаточно прав доступа", "message");
    }
}
