<?php

namespace App\Http\Controllers\RestaurantAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::where(
            'restaurant_id',
            auth()->user()->restaurant_id
        )->latest()->get();

        return view(
            'restaurant.products.index',
            compact('products')
        );
    }

    public function create()
    {
        $categories = Category::all();

        return view(
            'restaurant.products.create',
            compact('categories')
        );
    }
    

    public function store(Request $request)
    {
        $image = null;

        if ($request->hasFile('image')) {
            $image = $request->file('image')
                ->store('products', 'public');
        }

        Product::create([

            'restaurant_id' => auth()->user()->restaurant_id,

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
            ->route('restaurant.products.index')
            ->with('success', 'Product Added');
    }
    public function edit($id)
    {
        $product = Product::findOrFail($id);

        $categories = Category::all();

        return view(
            'restaurant.products.edit',
            compact('product', 'categories')
        );
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $image = $product->image;

        if ($request->hasFile('image')) {

            $image = $request->file('image')
                ->store('products', 'public');
        }

        $product->update([

            'category_id' => $request->category_id,

            'name' => $request->name,

            'slug' => Str::slug($request->name),

            'description' => $request->description,

            'image' => $image,

            'price' => $request->price
        ]);

        return redirect('/restaurant/products')
            ->with('success', 'Updated');
    }

    public function destroy($id)
    {
        Product::findOrFail($id)->delete();

        return back()->with('success', 'Deleted');
    }
}