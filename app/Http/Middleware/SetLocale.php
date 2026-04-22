<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\App;
use Mcamara\LaravelLocalization\LaravelLocalization;
class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $locale = app(LaravelLocalization::class)->getCurrentLocale();
        if ($locale != $request->segment(1)) {

            // $getURL=  app(LaravelLocalization::class)->getLocalizedURL($locale, null, [], true);
            // dd($request);
            if(session('locale')=='ar') {
                App::setLocale('ar');
                // dd('set locale1',App::getLocale());
            } else {
                App::setLocale('en');
                // dd('set locale2',App::getLocale());
            }
        }
        return $next($request);
    }
}
