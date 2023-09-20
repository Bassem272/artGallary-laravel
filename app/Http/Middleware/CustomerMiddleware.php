<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CustomerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
         $authUser = $request->user();

        if($request->user() && $request->header('role') == 'customer'){
            return $next($request) ;
        }
       else{
        return Response()->json(['message'=> 'not authorized only customer are allowed'],403);
       }
    }
}
