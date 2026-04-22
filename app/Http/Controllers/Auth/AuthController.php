<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Actions\Auth\LogoutAccount;
use App\Http\Responses\LogoutResponse;
use Illuminate\Support\Facades\Auth;
class AuthController extends Controller
{
    public function create()
    {
        // Check if any guard is already logged in
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        }

        if (Auth::guard('web')->check()) {
            return redirect()->route('user.dashboard');
        }
        return view('dashboard.user.login');
    }
    public function register(Request $request)
    {
        // Check if any guard is already logged in
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        }

        if (Auth::guard('web')->check()) {
            return redirect()->route('user.dashboard');
        }

        if ($request->type === 'admin') {
            return view('dashboard.admin.register');
        } else {
            return view('auth.register');
        }

    }
    public function destroy(Request $request)
    {
        // dd('logout');
        app(LogoutAccount::class)->handle($request);
        return app(LogoutResponse::class)->toResponse($request);

    }
}
