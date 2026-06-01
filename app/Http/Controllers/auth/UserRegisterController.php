<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserRegisterController extends Controller
{
    public function showRegister()
    {
        return view('auth.user-register');
    }

    public function register(Request $request)
    {
        // $request->validate([

        //     'name' => 'required',

        //     'email' => 'required|email|unique:users',

        //     'password' => 'required|min:6'

        // ]);

        $validator = Validator::make($request->all(), [
            'name'     => 'required',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6'
        ]);

        if ($validator->fails()) {

            return redirect(
                '/register?message=' .
                urlencode($validator->errors()->first()) .
                '&type=error'
            );
        }

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'user'
        ]);

        Auth::login($user);

        $request->session()->flush();
       

        return redirect(
            '/?message=' .
            urlencode('Registration Successful!') .
            '&type=success'
        );
    }
}