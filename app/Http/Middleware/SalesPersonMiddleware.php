<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SalesPersonMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user()->tokenCan('role:salesperson')) {
            return $next($request);
        }
        responseData('message','Sales person token is needed',401);
    }
}
