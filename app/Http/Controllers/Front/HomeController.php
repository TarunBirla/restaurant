<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;

class HomeController extends Controller
{
    public function home()
    {
        $products = Product::latest()->get();

        $categories = Category::whereNull('parent_id')->get();

        return view('front.home', compact(
            'products',
            'categories'
        ));
    }

    public function categoryProducts($id)
    {
        $category = Category::findOrFail($id);

        $products = Product::where(
            'category_id',
            $id
        )->latest()->get();

        return view('front.category-products',
            compact('products','category'));
    }

    public function productDetails($id)
    {
        $product = Product::findOrFail($id);

        return view('front.product-details',
            compact('product'));
    }
}