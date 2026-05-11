<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Restaurant;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class HomeController extends Controller
{
    public function home()
    {
        $products = Product::latest()->get();

        $categories = Category::whereNull('parent_id')->get();
        $qrCode = QrCode::size(220)
    ->generate(url('/restaurants'));

        return view('front.home', compact(
            'products',
            'categories',
            'qrCode'
        ));
    }

    public function categoryProducts($id)
    {
        $category = Category::findOrFail($id);

        $products = Product::where(
            'category_id',
            $id
        )->latest()->get();

        return view(
            'front.category-products',
            compact('products', 'category')
        );
    }

    public function productDetails($id)
    {
        $product = Product::findOrFail($id);

        return view(
            'front.product-details',
            compact('product')
        );
    }
    public function restaurants()
    {
        $restaurants = Restaurant::latest()->get();

        return view(
            'front.restaurants',
            compact('restaurants')
        );
    }
    public function restaurantProducts($slug)
    {
        $restaurant = Restaurant::where(
            'slug',
            $slug
        )->firstOrFail();

        $categories = Category::whereHas('products', function ($query) use ($restaurant) {

            $query->where(
                'restaurant_id',
                $restaurant->id
            );

        })->get();

        $products = Product::where(
            'restaurant_id',
            $restaurant->id
        )->latest()->get();

        return view(
            'front.restaurant-products',
            compact(
                'restaurant',
                'products',
                'categories'
            )
        );
    }
    public function restaurantCategoryProducts(
        $slug,
        $categorySlug
    ) {

        $restaurant = Restaurant::where(
            'slug',
            $slug
        )->firstOrFail();

        $category = Category::where(
            'slug',
            $categorySlug
        )->firstOrFail();

        $categories = Category::whereHas('products', function ($query) use ($restaurant) {

            $query->where(
                'restaurant_id',
                $restaurant->id
            );

        })->get();

        $products = Product::where(
            'restaurant_id',
            $restaurant->id
        )
            ->where(
                'category_id',
                $category->id
            )
            ->latest()
            ->get();

        return view(
            'front.restaurant-products',
            compact(
                'restaurant',
                'products',
                'categories',
                'category'
            )
        );
    }
}