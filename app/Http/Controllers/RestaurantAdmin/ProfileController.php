<?php

namespace App\Http\Controllers\RestaurantAdmin;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $restaurant = Restaurant::findOrFail(
            auth()->user()->restaurant_id
        );

        return view('restaurant.profile.index',
            compact('restaurant'));
    }

    public function update(Request $request)
    {
        $restaurant = Restaurant::findOrFail(
            auth()->user()->restaurant_id
        );

        $image = $restaurant->image;

        if($request->hasFile('image')){

            $image = $request->file('image')
                ->store('restaurants','public');
        }

        $restaurant->update([

            'name' => $request->name,

            'email' => $request->email,

            'phone' => $request->phone,

            'location' => $request->location,

            'description' => $request->description,

            'image' => $image
        ]);

        return back()->with('success',
            'Profile Updated');
    }
}