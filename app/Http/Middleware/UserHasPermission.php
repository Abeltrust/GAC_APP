<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserHasPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {   
        if(auth()->user()->role){
            if(auth()->user()->role=='admin' ){
                return $next($request);
            }else if(auth()->user()->role=='user'){
                return $next($request);
            }else{
                return redirect()->route('dashboard');
            }
        }else if(auth()->user()->role==''){
            return $next($request);
        }else{
            return redirect()->route('profile');
        }
    }
}
