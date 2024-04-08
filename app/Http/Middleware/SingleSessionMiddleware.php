<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class SingleSessionMiddleware
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
        if (Auth::check()) {
            $currentSessionId = Auth::user()->session_id;
            // if ($currentSessionId != Session::getId()) {
            //     toastr()->error('Your account is logged in from another device.');
            //     Auth::logout();
            //     return redirect('/login')->withErrors(['Your account is logged in from another device.']);
            // }
        }

        return $next($request);
    }
}
