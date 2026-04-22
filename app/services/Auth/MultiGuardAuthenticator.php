<?php

namespace App\Services\Auth;

use App\Models\User;
use App\Models\Admin;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Failed;
use Illuminate\Validation\ValidationException;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\LoginRateLimiter;
class MultiGuardAuthenticator
{
    protected $limiter;
        public function __construct(StatefulGuard $guard, LoginRateLimiter $limiter)
    {

        $this->guard = $guard;
        $this->limiter = $limiter;
    }
    public function authenticate(Request $request)
    {

        $request->validate([
        'email' => ['required','email'],
        'password' => ['required'],
        ]);
        // Check admins first
        $admin = Admin::where('email', $request->email)->first();

        if ($admin && Hash::check($request->password, $admin->password)) {
            $this->guard = Auth::guard('admin');
            Auth::guard('admin')->login($admin, $request->remember);
            $request->type = 'admin'; // Set type for response

            return $admin;
        }

        // Then users
        $user = User::where('email', $request->email)->first();



        if ($user && Hash::check($request->password, $user->password)) {
            $this->guard = Auth::guard('web');
            Auth::guard('web')->login($user, $request->remember);
            $request->type = 'user'; // Set type for response

            return $user;

        }


    }


}
