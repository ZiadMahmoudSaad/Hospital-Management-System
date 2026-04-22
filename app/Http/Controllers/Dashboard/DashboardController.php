<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index');
    }

    public function index_admin()
    {
        // dd('admin dashboard');
        return view('dashboard.admin.index');
    }

    // public function create_admin()
    // {
    //     return view('dashboard.admin.login');
    // }
    // public function login(Request $request)
    // {
    //     return view('dashboard.user.login');
    //     if (Auth::guard('admin')->attempt(
    //         $request->only('email', 'password'),
    //         $request->boolean('remember')
    //     )) {
    //         return redirect()->intended('/admin/dashboard');
    //     }

    //     return back()->withErrors(['email' => 'Invalid credentials']);
    // }
}
