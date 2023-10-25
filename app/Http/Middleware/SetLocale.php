<?php

namespace App\Http\Middleware;

use Closure;

class SetLocale
{
    /**
     * Handle an incoming request.
     * Localization Middleware
     * @author ZAR NI WIN
     * @create  [12.04.2021]
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if($request->language){
            app()->setLocale($request->language); // set requested language
        }
        return $next($request);
    }
}
