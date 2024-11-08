<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.dashboard-login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'user' => 'required|string',
            'password' => 'required|string',
        ]);

        if ($request->user === env('ADMIN_USERNAME') && $request->password === env('ADMIN_PASSWORD')) {
            session(['is_logged_in' => true]);
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['Invalid credentials.']);
    }

    public function dashboard()
    {
        if (session('is_logged_in')) {
            return view('components.admin');
        }
        return redirect()->route('login.form');
    }

    public function logout(Request $request)
    {
        $request->session()->forget('is_logged_in');
        return redirect()->route('login.form');
    }
}
