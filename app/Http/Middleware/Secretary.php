<?php

namespace App\Http\Middleware;

use Closure;

class Secretary
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
        if(auth()->user()->role==='secretary'){
            return $next($request);
          }
            return redirect('reservation');
    }
}
