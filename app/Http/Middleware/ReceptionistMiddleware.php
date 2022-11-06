<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ReceptionistMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user()->tokenCan('role:receptionist')) {
            return $next($request);
        }
        responseData('message','Receptionist token is needed',401);
    }
}
