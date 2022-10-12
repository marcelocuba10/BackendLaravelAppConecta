<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Cors
{
    public function handle(Request $request, Closure $next)
    {
        // header("Access-Control-Allow-Origin: *");
        // //ALLOW OPTIONS METHOD
        // $headers = [
        //     'Access-Control-Allow-Methods' => 'POST,GET,OPTIONS,PUT,DELETE',
        //     'Access-Control-Allow-Headers' => 'Content-Type, X-Auth-Token, Origin, Authorization, X-XSRF-TOKEN',
        // ];

        // if ($request->getMethod() == "OPTIONS"){
        //     //The client-side application can set only headers allowed in Access-Control-Allow-Headers
        //     return response()->json('OK',200,$headers);
        // }

        // $response = $next($request);

        // foreach ($headers as $key => $value) {
        //     $response->header($key, $value);
        // }

        // return $response;

        // $origin = $request->getHttpHost() == 'localhost' ?
        //             'http://localhost:8100' : 'https://conectaclock.badrobotspy.com';

        // return $next($request)
        //     ->header('Access-Control-Allow-Origin', '*')
        //     ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
        //     ->header('Access-Control-Allow-Credentials', 'true')
        //     ->header('Access-Control-Allow-Headers', 'Authorization,Accept,Origin,DNT,X-CustomHeader,Keep-Alive,User-Agent,X-Requested-With,If-Modified-Since,Cache-Control,Content-Type,Content-Range,Range');

        $headers = [
            'Access-Control-Allow-Origin'      => '*',
            'Access-Control-Allow-Methods'     => 'POST, GET, OPTIONS',
            'Access-Control-Allow-Credentials' => 'true',
            'Access-Control-Max-Age'           => '86400',
            'Access-Control-Allow-Headers'     => 'Content-Type, Authorization, X-Requested-With'
        ];

        if ($request->isMethod('OPTIONS')) {
            return response()->json('{"method":"OPTIONS"}', 200, $headers);
        }

        $response = $next($request);
        foreach ($headers as $key => $value) {
            $response->headers->set($key, $value);
        }

        return $response;
    }
}
