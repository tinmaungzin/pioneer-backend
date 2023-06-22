<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CheckHeaderMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $headers =  $request->header();
        if(!isset($headers['accept'])){
            responseStatus('Accept Header is needed',422);
        }

        if($headers['accept'][0] != 'application'.'/'.'json'){
            responseStatus('Accept Header must be application/json',422);
        }

        if(isset($headers['authorization'])) {
            if ( ! Str::startsWith($headers['authorization'][0], 'Bearer ')) {
                responseStatus('Authorization Header value must be included Bearer',422);
            }
        }

        return $next($request);
    }
}
