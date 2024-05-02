<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\App;

class SetLocale
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->language) {
            App::setLocale(Auth::user()->language);
        }

        return $next($request);
    }
}

