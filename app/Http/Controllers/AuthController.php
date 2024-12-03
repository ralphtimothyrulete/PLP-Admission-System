<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Events\Registered;

class AuthController extends Controller
{
    public function register()
    {
        return view('auth/register');    
    }  

    public function registerSave(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed',
            'role' => 'required|in:user,admin',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role,
            ]);

            Auth::login($user);

            event(new Registered($user));

            return redirect()->route('verification.notice');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'The email address is already registered.')->withInput();
        }
    }

        //Email Verification Notice
        public function verifyNotice (){
            return view('auth.verify-email');
        }

        //Email Verification Handler
        public function verifyEmail(EmailVerificationRequest $request) {
            $request->fulfill();
         
            return redirect()->route('login');
        }

        //Resending the Verification Email Handler
        public function verifyHandler(Request $request) {
            $request->user()->sendEmailVerificationNotification();
        
            return back()->with('message', 'Verification link sent!');
        }

    public function login()
    {
        return view('auth/login');
    }
    
    public function loginAction(Request $request)
    {
        Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ])->validate();
 
        if (!Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            throw ValidationException::withMessages([
                'email' => trans('auth.failed')
            ]);
        }
 
        $request->session()->regenerate();

        session()->flash('status', 'Welcome! You are now logged in.');
        

        if (Auth::user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }
 
        return redirect()->route('home');
    }
  
    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
 
        $request->session()->invalidate();
 
        return redirect('/login');
    }

    public function profile()
    {
        return view('profile');
    }
}

