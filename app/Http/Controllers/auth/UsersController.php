<?php

// namespace App\Http\Controllers\Auth;

// use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;

// class UsersController extends Controller
// {
//     public function showLogin(Request $request)
//     {
       
       
//         return view('auth.login',[
//             'redirect' => $request->redirect
//         ]);
//     }

//     public function login(Request $request)
//     {
//         if (Auth::attempt([
//             'email' => $request->email,
//             'password' => $request->password
//         ])) {

//             // return redirect('/');
//             // return redirect()->intended('/');
//             // $request->session()->regenerate();

            
//             $redirect = urldecode($request->redirect ?? '/');

//             // Prevent external redirects
//             if (
//                 !str_starts_with($redirect, url('/'))
//             ) {
//                 $redirect = '/';
//             }

//             return redirect($redirect)
//                 ->with('success', 'Login Successfully!');
//         }

//         return back()->with('error', 'Invalid Login');
//     }
// }


namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function showLogin(Request $request)
    {
        return view('auth.login', [
            'redirect' => $request->redirect
        ]);
    }

    public function login(Request $request)
    {
        $credentials = [
            'email'    => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)) {

            $redirect = urldecode($request->redirect ?? '/');

            // Prevent external redirects
            if (
                empty($redirect) ||
                !str_starts_with($redirect, url('/'))
            ) {
                $redirect = url('/');
            }

            $separator = str_contains($redirect, '?') ? '&' : '?';

            return redirect(
                $redirect .
                $separator .
                'message=' . urlencode('Login Successfully!') .
                '&type=success'
            );
        }

        return redirect(
            route('login', [
                'redirect' => $request->redirect,
                'message'  => 'Invalid Login Credentials',
                'type'     => 'error',
            ])
        );
    }

    public function logout(Request $request)
    {
        Auth::logout();

        return redirect('/?message=' . urlencode('Logged Out Successfully') . '&type=success');
    }
}