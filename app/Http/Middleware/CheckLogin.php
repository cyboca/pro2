<?php

namespace App\Http\Middleware;

use Closure;

class CheckLogin
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
        if(!session('username')){
            if(session()->get('type')==1)
                return redirect('index');
            else
                return redirect('test');
        }
        return $next($request);
    }
}
