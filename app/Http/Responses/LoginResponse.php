<?php

namespace App\Http\Responses;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
use Illuminate\Support\Facades\Auth;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Illuminate\Support\Facades\App;
class LoginResponse implements LoginResponseContract
{
     /**
     * Create an HTTP response that represents the object.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     */

    public function toResponse($request)
    {
        $locale =App::getLocale();

        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('user.dashboard');

    }

    // public function toResponse($request)
    // {
    //     if ($request->user('admin')) {
    //         return redirect()->intended('/admin/dashboard');
    //     } else {
    //         return redirect()->intended('/dashboard');
    //     }
    // }
}
