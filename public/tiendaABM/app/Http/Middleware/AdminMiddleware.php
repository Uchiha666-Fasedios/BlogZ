<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            if(auth()->user()->role === "ADMIN"){
                return $next($request);
            }else{
                return redirect()->route('inicio');
            }
        }
        else{
            return redirect()->route('login');
        }
    }
}
