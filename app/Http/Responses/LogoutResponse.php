<?php

namespace App\Http\Responses;
use Laravel\Fortify\Contracts\LogoutResponse as LogoutResponseContract;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\StatefulGuard;
class LogoutResponse implements LogoutResponseContract
{

     /**
     * Create an HTTP response that represents the object.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     */

    public function toResponse($request)
    {
        // Logout from all guards
        return redirect('/');

    }
}
