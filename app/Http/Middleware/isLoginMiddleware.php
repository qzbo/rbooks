<?php

namespace App\Http\Middleware;

use Closure;

class isLoginMiddleware
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
        if(session('user')){
            return $next($request);
        }else{
            // return $next($request);
            $info = "非法访问";
           return view('errors.503',compact('info'));
        }

    }
}
