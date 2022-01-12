<?php

namespace App\Http\Middleware\MyAuth;

use Closure;
use Illuminate\Http\Request;
use App\Helpers\MyAuth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (MyAuth::check()) {
            return redirect()->route('dashboard');
        }

        return $next($request);
    }
}
