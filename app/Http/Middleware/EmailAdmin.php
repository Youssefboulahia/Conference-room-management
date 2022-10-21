<?php

namespace App\Http\Middleware;

use Closure;

class EmailAdmin
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
        if(auth()->user()->role==='email_admin'){
            return $next($request);
          }
            return redirect('adt.email');
    }
}
