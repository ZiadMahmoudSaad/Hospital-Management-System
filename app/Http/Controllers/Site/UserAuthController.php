<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserAuthController extends Controller
{
    public function register(Request $request)
    {
        $data = $request->validate([
            'name'     => ['required','string','max:255'],
            'email'    => ['required','email','max:255','unique:users,email'],
            'password' => ['required','confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create($data);

        auth('web')->login($user);

        return redirect('/dashboard');
    }
    public function create()
    {
        return view('dashboard.user.login');
    }



}
