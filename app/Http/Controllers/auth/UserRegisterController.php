<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRegisterController extends Controller
{
    public function showRegister()
    {
        return view('auth.user-register');
    }

    public function register(Request $request)
    {
        $request->validate([

            'name' => 'required',

            'email' => 'required|email|unique:users',

            'password' => 'required|min:6'

        ]);

        User::create([

            'name' => $request->name,

            'email' => $request->email,

            'password' => Hash::make($request->password),

            'role' => 'user'
        ]);

        // return redirect('/login');
        return redirect('/login')
            ->with('success', 'Registration Successful!');
    }
}