<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class SetFilamentLocale
{
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();
        if ($user && $user->branch?->locale) {
            app()->setLocale($user->branch->locale);
        }

        return $next($request);
    }
}
