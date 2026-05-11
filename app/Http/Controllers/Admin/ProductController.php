<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with(
            'category',
            'restaurant',
            'vendor'
        )->latest()->get();

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();

        $restaurants = Restaurant::all();

        $vendors = User::where('role','vendor')->get();

        return view('admin.products.create',
            compact('categories','restaurants','vendors'));
    }

    public function store(Request $request)
    {
        $image = null;

        if($request->hasFile('image')){
            $image = $request->file('image')
                ->store('products','public');
        }

        Product::create([
            'restaurant_id' => $request->restaurant_id,
            'vendor_id' => $request->vendor_id,
            'category_id' => $request->category_id,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'image' => $image,
            'price' => $request->price,
            'currency' => 'EUR',
            'status' => 1
        ]);

        return redirect()
            ->route('admin.products.index')
            ->with('success','Product Added');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);

        $categories = Category::all();

        $restaurants = Restaurant::all();

        $vendors = User::where('role','vendor')->get();

        return view('admin.products.edit',
            compact(
                'product',
                'categories',
                'restaurants',
                'vendors'
            ));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $image = $product->image;

        if($request->hasFile('image')){
            $image = $request->file('image')
                ->store('products','public');
        }

        $product->update([
            'restaurant_id' => $request->restaurant_id,
            'vendor_id' => $request->vendor_id,
            'category_id' => $request->category_id,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'image' => $image,
            'price' => $request->price
        ]);

        return redirect()
            ->route('admin.products.index')
            ->with('success','Updated');
    }

    public function destroy($id)
    {
        Product::findOrFail($id)->delete();

        return back()->with('success','Deleted');
    }
}