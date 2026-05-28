<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function showLogin(Request $request)
    {
        // store previous url manually
       session(['previous_url' => $request->redirect]);
       
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
            // $request->session()->regenerate();

           

            $previous = session('previous_url');

            if (!$previous || str_contains($previous, '/login')) {
                $previous = '/';
            }

            return redirect($previous)
                ->with('success', 'Login Successfully!');
        }

        return back()->with('error', 'Invalid Login');
    }
}