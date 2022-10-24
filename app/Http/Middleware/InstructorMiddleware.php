<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class InstructorMiddleware
{
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::User()->type == 'inst' ) {
            return $next($request);
        }else{
            abort(403, 'unauthorized access');
        }
    }
}
