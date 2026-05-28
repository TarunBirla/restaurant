<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function showLogin(Request $request)
    {
       
        // return view('auth.login');
        return view('auth.login', [
            'previous' => url()->previous()
        ]);
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

            $previous = $request->previous_url;

            // avoid redirecting back to login page
            if (
                $previous &&
                !str_contains($previous, '/login')
            ) {
                return redirect($previous)
                    ->with('success', 'Login Successfully!');
            }

            return redirect('/')
                ->with('success', 'Login Successfully!');
        }

        return back()->with('error', 'Invalid Login');
    }
}