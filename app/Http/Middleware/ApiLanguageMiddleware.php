<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class ApiLanguageMiddleware
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
         // Check for 'Accept-Language' header or 'lang' query parameter
         $locale = $request->header('Accept-Language', $request->query('lang', config('app.locale')));

         // Validate if the locale is supported
         if (in_array($locale, ['en', 'hi'])) { 
             App::setLocale($locale);
         } else {
             App::setLocale(config('app.locale'));
         }
 
        return $next($request);
    }
}
