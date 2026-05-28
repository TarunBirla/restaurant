<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function showLogin(Request $request)
    {
        session(['url.intended' => url()->previous()]);
        return view('auth.login');
    }

    public function login(Request $request)
    {
        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ])) {

            // return redirect('/');
            // return redirect()->intended('/');
            $request->session()->regenerate();
            return redirect()->intended('/')
                ->with('success', 'Login Successfully!');
        }

        return back()->with('error', 'Invalid Login');
    }
}