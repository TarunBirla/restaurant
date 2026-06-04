<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function login(Request $request)
    {
        try {

            $request->validate([
                'email'    => 'required|email',
                'password' => 'required'
            ]);

            $credentials = [
                'email'    => $request->email,
                'password' => $request->password,
            ];

            if (!Auth::attempt($credentials)) {

                return response()->json([
                    'status'  => false,
                    'message' => 'Invalid Login Credentials'
                ], 401);
            }

            $user = Auth::user();

            $token = $user->createToken('mobile-app')->plainTextToken;

            return response()->json([
                'status'  => true,
                'message' => 'Login Successfully!',
                'token'   => $token,
                'user'    => $user
            ]);

        } catch (\Exception $e) {

            return response()->json([
                'status'  => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function logout(Request $request)
    {
        try {

            $request->user()->currentAccessToken()->delete();

            return response()->json([
                'status'  => true,
                'message' => 'Logged Out Successfully'
            ]);

        } catch (\Exception $e) {

            return response()->json([
                'status'  => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function forgotPassword(Request $request)
    {
        try {

            $request->validate([
                'email'    => 'required|email',
                'password' => 'required|min:6'
            ]);

            $user = User::where(
                'email',
                $request->email
            )->first();

            if (!$user) {

                return response()->json([
                    'status'  => false,
                    'message' => 'Email not found'
                ], 404);
            }

            $user->update([
                'password' => Hash::make(
                    $request->password
                )
            ]);

            return response()->json([
                'status'  => true,
                'message' => 'Password Updated Successfully'
            ]);

        } catch (\Exception $e) {

            return response()->json([
                'status'  => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}