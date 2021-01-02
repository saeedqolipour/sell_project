<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class CheckAccess
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        return $next($request);

        /*$permissions = ['saeed.index', 'saeed.create'];

        foreach ($permissions as $permission) {
            if (Route::currentRouteName() == $permission) {
                return $next($request);
            }
        }
        return redirect(route('404'));*/
    }
}
