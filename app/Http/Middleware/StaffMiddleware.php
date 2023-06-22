<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class StaffMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (
            auth()->user()->tokenCan('role:admin') ||
            auth()->user()->tokenCan('role:receptionist')
        ) {
            return $next($request);
        }
        responseData('message','Auth token is needed',401);
    }
}
