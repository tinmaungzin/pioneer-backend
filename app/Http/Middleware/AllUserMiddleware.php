<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AllUserMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (
            auth()->user()->tokenCan('role:admin') ||
            auth()->user()->tokenCan('role:receptionist') ||
            auth()->user()->tokenCan('role:salesperson') ||
            auth()->user()->tokenCan('role:user')
        ) {
            return $next($request);
        }
        responseData('message','Auth token is needed',401);
    }
}
