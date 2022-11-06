<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user()->tokenCan('role:admin')) {
            return $next($request);
        }
        responseData('message','Admin token is needed',401);
    }
}
