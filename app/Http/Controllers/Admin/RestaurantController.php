<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class RestaurantController extends Controller
{
    public function index()
    {
        $restaurants = Restaurant::latest()->get();

        return view('admin.restaurants.index',
            compact('restaurants'));
    }

    public function create()
    {
        return view('admin.restaurants.create');
    }

    public function store(Request $request)
{
    $image = null;

    if($request->hasFile('image')){

        $image = $request->file('image')
            ->store('restaurants','public');
    }

    $restaurant = Restaurant::create([

        'name' => $request->name,
         'slug' => Str::slug($request->name),

        'email' => $request->email,

        'phone' => $request->phone,

        'location' => $request->location,

        'description' => $request->description,

        'image' => $image,

        'status' => 1
    ]);





    // CREATE RESTAURANT ADMIN USER

    User::create([

        'name' => $request->name,

        'email' => $request->email,

        'password' => Hash::make($request->password),

        'role' => 'restaurant_admin',

        'restaurant_id' => $restaurant->id,

        'phone' => $request->phone
    ]);





    return redirect()
        ->route('admin.restaurants.index')
        ->with('success','Restaurant Added Successfully');
}

    public function edit(string $id)
    {
        $restaurant = Restaurant::findOrFail($id);

        return view('admin.restaurants.edit',
            compact('restaurant'));
    }

    public function update(Request $request, string $id)
    {
        $restaurant = Restaurant::findOrFail($id);

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

            'image' => $image,
            
            'status' => $request->status
        ]);

        return redirect()
            ->route('admin.restaurants.index')
            ->with('success','Restaurant Updated');
    }


    public function destroy(string $id)
    {
        Restaurant::findOrFail($id)->delete();

        return back()->with('success','Deleted');
    }


    public function updatePaymentSettings(Request $request)
    {
        $request->validate([

            'transactworld_member_id' => 'required',

            'transactworld_account_id' => 'required',

            'transactworld_terminal_id' => 'required',

            'transactworld_checksum_key' => 'required',

            'transactworld_mode' => 'required|in:test,live'

        ]);

        $restaurant = auth()->user()->restaurant;

        $restaurant->update([

            'transactworld_member_id' =>
                $request->transactworld_member_id,

            'transactworld_account_id' =>
                $request->transactworld_account_id,

            'transactworld_terminal_id' =>
                $request->transactworld_terminal_id,

            'transactworld_checksum_key' =>
                $request->transactworld_checksum_key,

            'transactworld_mode' =>
                $request->transactworld_mode

        ]);

        return back()->with(
            'success',
            'Payment Settings Updated Successfully'
        );
    }
}