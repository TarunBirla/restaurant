<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        return view('front.profile');
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $user->update([

            'name' => $request->name,

            'email' => $request->email,
        ]);

        return back()->with(
            'success',
            'Profile Updated Successfully'
        );
    }
}