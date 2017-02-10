<?php

namespace App\Http\Middleware;

use Closure;

class checkLogin
{
    public function handle($request, Closure $next)
    {
        define('APIKEY', 'bbFj8HGTPHm8x5uMALCP71g6MsK9pw1EzVzRTpdN90eqcv7pIE');

        $header['apikey'] = $request->header('apikey');
        $header['token']  = $request->header('token');
        
        if($header['apikey'] != APIKEY ||$header['apikey'] == '')
        {
            return response('invalid API',400);
        }

        if($header['token'] == '')
        {
            return response('invalid TOKEN',400);
        }
        $cek_user = \App\User::where('token','=',$header['token'])->first();
        if(count($cek_user) == 0)
        {
            return response('invalid TOKEN',400);
        }

        return $next($request);
    }
}
