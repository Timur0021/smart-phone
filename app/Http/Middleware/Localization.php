<?php

namespace App\Http\Middleware;

use App;
use Closure;
use Illuminate\Http\Request;

class Localization
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse) $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->hasCookie("NEXT_LOCALE")) {
            $lang = $request->cookie("NEXT_LOCALE");
            if ($lang) {
                app()->setLocale($lang);
            }
        }
        if ($request->hasHeader("Next-Locale")) {
            $lang = $request->header("Next-Locale");
            if ($lang) {
                app()->setLocale($lang);
            }
        }
        return $next($request);
    }
}
