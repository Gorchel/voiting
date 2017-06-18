<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;

class Authenticate
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
        $user = Sentinel::check();
        if ($user === false) {
            if( $request->ajax() ) {
                return response()->json(['code' => 302, 'text' => "/login", 'data' => null]);
            } else {
                return redirect( "/login" );
            }
        }

        return $next($request);
    }
}
