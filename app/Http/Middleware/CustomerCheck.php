<?php

namespace App\Http\Middleware;

use Closure;

class CustomerCheck
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
        if (auth()->user()->position != 'customer') {
            return redirect()->route('login');
        }
        return $next($request);
    }
}
