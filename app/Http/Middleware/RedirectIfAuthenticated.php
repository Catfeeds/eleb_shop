<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
{
    if (Auth::guard($guard)->check()) {
        //登录成功后跳转 商家菜品分类
        return redirect()->route('menus.index');
    }

    return $next($request);
}
}
