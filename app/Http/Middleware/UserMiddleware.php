<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user()->tokenCan('role:user')) {
            return $next($request);
        }
        responseData('message','User token is needed',401);
    }
}
