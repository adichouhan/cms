<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class IsAdmin
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
        $isAdmin = Auth::check() && isset(Auth::user()->extra_data) ? json_decode(Auth::user()->extra_data, true)['admin'] == 1 : null;

        if($isAdmin) {
            return $next($request);
        }
        return redirect('/');
    }
}
