<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SalePersonMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user()->tokenCan('role:saleperson')) {
            return $next($request);
        }
        responseData('message','Sale person token is needed',401);
    }
}
