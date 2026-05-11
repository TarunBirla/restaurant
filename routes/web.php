<?php

use App\Http\Controllers\Auth\UsersController;
use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\Front\OrderController;
use App\Http\Controllers\Front\ProfileController as FrontProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Auth\UserRegisterController;
use App\Http\Controllers\Admin\VendorController;

use App\Http\Controllers\RestaurantAdmin\OrderController as RestaurantOrderController;

use App\Http\Controllers\RestaurantAdmin\ProfileController;
use App\Http\Controllers\Front\UserDashboardController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\RestaurantController;
use App\Http\Controllers\Admin\OrdersController;
use App\Http\Controllers\RestaurantAdmin\ProductController as RestaurantProductController;
use App\Http\Controllers\Admin\UserController;


Route::get(
    '/',
    [HomeController::class, 'home']
);

Route::get(
    '/category/{id}',
    [HomeController::class, 'categoryProducts']
);

Route::get(
    '/product/{id}',
    [HomeController::class, 'productDetails']
);
Route::get(
    '/restaurants',
    [HomeController::class, 'restaurants']
);

Route::get('/login', [UsersController::class, 'showLogin'])
    ->name('login');

// Route::post('/login-user', [UsersController::class, 'login']);
Route::post('/login', [UsersController::class, 'login'])
    ->name('login.submit');
Route::get(
    '/restaurant/{slug}',
    [HomeController::class, 'restaurantProducts']
);
Route::get(
    '/restaurant/{slug}/{category}',
    [HomeController::class, 'restaurantCategoryProducts']
);
Route::middleware(['auth'])->group(function () {
    Route::get(
        '/dashboard',
        [UserDashboardController::class, 'index']
    );

    Route::get(
        '/cart',
        [CartController::class, 'index']
    );

    Route::post(
        '/cart/add',
        [CartController::class, 'add']
    );

    Route::get(
        '/cart/remove/{id}',
        [CartController::class, 'remove']
    );

    Route::get(
        '/checkout',
        [OrderController::class, 'checkout']
    );

    Route::post(
        '/place-order',
        [OrderController::class, 'placeOrder']
    );

    Route::get(
        '/my-orders',
        [OrderController::class, 'myOrders']
    );
    Route::get(
        '/profile',
        [FrontProfileController::class, 'index']
    );

    Route::post(
        '/profile/update',
        [FrontProfileController::class, 'update']
    );

});

Route::middleware(['auth'])
    ->prefix('vendor')
    ->name('vendor.')
    ->group(function () {

        Route::get('/dashboard', function () {

            return view('vendor.dashboard');

        });

        Route::resource(
            'products',
            \App\Http\Controllers\Vendor\ProductController::class
        );

    });

Route::middleware(['auth', 'super_admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index']);

        Route::resource('restaurants', RestaurantController::class);

        Route::resource('categories', CategoryController::class);

        Route::resource('products', ProductController::class);
        Route::resource('orders', OrdersController::class);
        Route::resource('vendor', VendorController::class);
        Route::get(
            '/users',
            [UserController::class, 'index']
        );
        Route::delete(
            '/users/{id}',
            [UserController::class, 'destroy']
        )
            ->name('users.destroy');
        Route::post(
            '/orders/status/{id}',
            [OrdersController::class, 'updateStatus']
        )->name('orders.status');

    });

Route::middleware(['auth', 'restaurant_admin'])
    ->prefix('restaurant')
    ->name('restaurant.')
    ->group(function () {

        Route::get('/dashboard', function () {
            return view('restaurant.dashboard');
        });

        Route::resource('products', RestaurantProductController::class);
        Route::get(
            '/orders',
            [RestaurantOrderController::class, 'index']
        );

        Route::get(
            '/profile',
            [ProfileController::class, 'index']
        );

        Route::post(
            '/profile/update',
            [ProfileController::class, 'update']
        );

    });

Route::get(
    '/admin/login',
    [AdminLoginController::class, 'showLogin']
);

Route::post(
    '/admin/login',
    [AdminLoginController::class, 'login']
)
    ->name('admin.login');

Route::get(
    '/register',
    [UserRegisterController::class, 'showRegister']
);

Route::post(
    '/register-user',
    [UserRegisterController::class, 'register']
);


// Route::get('/login', [UsersController::class, 'showLogin']);    




Route::post('/logout', function () {

    auth()->logout();

    return redirect('/');

})->name('logout');