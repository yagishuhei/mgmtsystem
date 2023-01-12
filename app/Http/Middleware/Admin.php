<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Admin
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
        if (empty( auth()->user() ) ) {
            return redirect()->route('login');
        }

        if (auth()->user()->role === 'admin') {
            $this->auth = true;
        }  else {
            $this->auth = false;
        }

        if ( $this->auth === true) {
            return $next($request);
        }else {
            return redirect('/');
        }
    }
}
