<?php

namespace App\Http\Middleware;

use Closure;

class PanitiaRamadhan
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
        if (auth()->user()->role == 'PanitiaRamadhan') {
            return redirect()->back();
        }
        return $next($request);
    }
}
