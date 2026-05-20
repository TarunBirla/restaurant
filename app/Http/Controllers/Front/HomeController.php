<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Restaurant;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\Offer;

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
        $reviews = \App\Models\Review::with('user')

    ->where(

        'restaurant_id',
        $product->restaurant_id

    )

    ->where(

        'status',
        'approved'

    )

    ->latest()

    ->take(10)

    ->get();

        return view(
            'front.product-details',
            compact('product','reviews')
        );
    }
    public function restaurants(Request $request)
    {
        $ip = $request->ip();

        Log::info('User IP: ' . $ip);

        $response = Http::get("http://ip-api.com/json/" . $ip);

        $data = $response->json();

        Log::info('IP API Response', $data);

        $latitude = $data['lat'] ?? null;
        $longitude = $data['lon'] ?? null;

        Log::info('User Latitude: ' . $latitude);
        Log::info('User Longitude: ' . $longitude);

        /*
        |--------------------------------------------------------------------------
        | IF LOCATION NOT FOUND
        |--------------------------------------------------------------------------
        */

        if (!$latitude || !$longitude) {

            $restaurants = Restaurant::latest()->get();

            return view(
                'front.restaurants',
                compact('restaurants')
            );
        }

        /*
        |--------------------------------------------------------------------------
        | ALL RESTAURANTS WITH DISTANCE
        |--------------------------------------------------------------------------
        */

        // $restaurants = Restaurant::select(
        // $restaurants = Restaurant::with('featuredOffer')
        $restaurants = Restaurant::with([

            'featuredOffer',
            'reviews'

        ])
            ->select(
                '*',
                DB::raw("
            (
                6371 * acos(
                    cos(radians($latitude))
                    * cos(radians(latitude))
                    * cos(radians(longitude) - radians($longitude))
                    + sin(radians($latitude))
                    * sin(radians(latitude))
                )
            ) AS distance
        ")
            )
            ->orderByRaw("
        CASE
            WHEN distance <= 5 THEN 0
            ELSE 1
        END
    ")
            ->orderBy('distance')
            ->get();

        Log::info('Restaurants Count: ' . $restaurants->count());

        foreach ($restaurants as $restaurant) {

            Log::info('Restaurant Found', [
                'name' => $restaurant->name,
                'distance' => $restaurant->distance
            ]);
        }


        return view(
            'front.restaurants',
            compact(
                'restaurants',
                'latitude',
                'longitude'

            )
        );
    }
    public function restaurantProducts($slug)
    {
        $restaurant = Restaurant::with('reviews')

            ->where(
                'slug',
                $slug
            )

            ->firstOrFail();

        /*
        |--------------------------------------------------------------------------
        | ONLY THIS RESTAURANT CATEGORIES
        |--------------------------------------------------------------------------
        */

        $categories = Category::where(
            'restaurant_id',
            $restaurant->id
        )
            ->whereNull('parent_id')
            ->latest()
            ->get();

        /*
        |--------------------------------------------------------------------------
        | ONLY THIS RESTAURANT PRODUCTS
        |--------------------------------------------------------------------------
        */

        $products = Product::where(
            'restaurant_id',
            $restaurant->id
        )
            ->latest()
            ->get();

        $offers = Offer::where(
            'restaurant_id',
            $restaurant->id
        )
            ->where('is_active', 1)
            // ->where('type', 'offer')
            ->latest()
            ->get();

        return view(
            'front.restaurant-products',
            compact(
                'restaurant',
                'products',
                'categories',
                'offers'

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

        /*
        |--------------------------------------------------------------------------
        | CATEGORY MUST BELONG TO SAME RESTAURANT
        |--------------------------------------------------------------------------
        */

        $category = Category::where(
            'slug',
            $categorySlug
        )
            ->where(
                'restaurant_id',
                $restaurant->id
            )
            ->firstOrFail();

        /*
        |--------------------------------------------------------------------------
        | ALL CATEGORIES OF THIS RESTAURANT
        |--------------------------------------------------------------------------
        */

        $categories = Category::where(
            'restaurant_id',
            $restaurant->id
        )
            ->whereNull('parent_id')
            ->latest()
            ->get();

        /*
        |--------------------------------------------------------------------------
        | ONLY PRODUCTS OF THIS RESTAURANT + CATEGORY
        |--------------------------------------------------------------------------
        */

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
                'category',

            )
        );
    }
}