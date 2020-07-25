<?php

namespace App\Http\Middleware;

use Closure;

class NotJamaah
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
        if (auth()->user()->role == 'Jamaah') {
            return redirect()->back();
        }
        return $next($request);
    }
}
