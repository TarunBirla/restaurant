<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    public function showLogin()
    {
        return view('auth.admin-login');
    }

    public function login(Request $request)
    {
        $request->validate([

            'email' => 'required|email',

            'password' => 'required'

        ]);

        if(Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ])){

            if(auth()->user()->role == 'super_admin'){

                return redirect('/admin/dashboard');
            }

            if(auth()->user()->role == 'restaurant_admin'){

                return redirect('/restaurant/dashboard');
            }

            return redirect('/');
        }

        return back()->with('error','Invalid Login');
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/admin/login');
    }
}