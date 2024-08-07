<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if ($guard === 'tenant' && Auth::guard($guard)->check()) {
            return redirect()->route('tenant-home');
        }
        if ($guard === 'landlord' && Auth::guard($guard)->check()) {
            return redirect()->route('landlord-home');
        }
        if (Auth::guard($guard)->check()) {
            
            return redirect()->route('home');
        }
        return $next($request);

    }
}
