<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::User()->type=='admin' ) {
            return $next($request);
        }else{
            abort(403, 'unauthorized access');
        }
    }
}
