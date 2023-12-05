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
        if(auth()->user()->permission){
            if(auth()->user()->permission->message==1 || auth()->user()->permission->delete==1 || auth()->user()->permission->edit==1 || auth()->user()->permission->payment==1){
                return $next($request);
            }else if(auth()->user()->role=='admin'){
                return $next($request);
            }else{
                return redirect()->route('membership');
            }
        }else if(auth()->user()->role=='admin'){
            return $next($request);
        }else{
            return redirect()->route('membership');
        }
    }
}
