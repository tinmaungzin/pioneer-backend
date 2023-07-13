<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class OriginMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        header('Access-Control-Allow-Origin:  *');
        // header('Access-Control-Allow-Origin:  http://localhost:3000');
        header('Access-Control-Allow-Headers:  Content-Type, X-Auth-Token, Authorization, Authentication, Origin, X-Csrf-Token');
        header('Access-Control-Allow-Methods:  POST, PUT, DELETE');
        $response = $next($request);
        return $response;
    }
}
