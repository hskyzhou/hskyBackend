<?php

namespace App\Http\Middleware\Backend;

use Closure;

class MenuPermissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next){   
        /*获取路由别名*/
        $routeName = $request->route()->getName();

        dd($routeName);

        return $next($request);
    }
}
