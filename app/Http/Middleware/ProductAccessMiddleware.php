<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ProductAccessMiddleware
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
        $token = $request->bearerToken();

        if(!$token){
            return response()->json(["error" => "Token is missing"], 401);
        }

        if($token !== env('BEARER_TOKEN')){
            return response()->json(["error"=>"Token is invalid"], 403);
        }

        return $next($request);
    }
}
