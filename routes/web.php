<?php
use App\Http\Controllers\Auth\UsersController;
use App\Http\Controllers\FCMController;
use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\Front\OrderController;
use App\Http\Controllers\Front\PaymentController;
use App\Http\Controllers\Front\ProfileController as FrontProfileController;
// use App\Http\Controllers\PaymentController;

use App\Http\Controllers\RestaurantAdmin\ItemController;
use App\Http\Controllers\RestaurantAdmin\OfferController;
use App\Http\Controllers\RestaurantAdmin\RestaurantPaymentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Auth\UserRegisterController;
use App\Http\Controllers\Admin\VendorController;
use App\Http\Controllers\RestaurantAdmin\DashboardController as RestaurantDashboardController;
use App\Http\Controllers\RestaurantAdmin\OrderController as RestaurantOrderController;

use App\Http\Controllers\RestaurantAdmin\ProfileController;
use App\Http\Controllers\Front\UserDashboardController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\RestaurantAdmin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\RestaurantController;
use App\Http\Controllers\Admin\OrdersController;
use App\Http\Controllers\RestaurantAdmin\ProductController as RestaurantProductController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Artisan;

Route::post(
    '/driverwebhook',
    [RestaurantOrderController::class, 'driverwebhook']
);

Route::post(

    '/submit-review/{id}',
    [OrderController::class, 'submitReview']

)->middleware('auth');
// Route::get('/payment', [PaymentController::class, 'index'])->name('payment.form');
// Route::post('/payment/pay', [PaymentController::class, 'pay'])->name('payment.pay');
// Route::post('/payment/notify', [PaymentController::class, 'notify'])->name('payment.notify');
// Route::post('/payment/success', [PaymentController::class, 'success'])->name('payment.success');
// Route::post('/payment/failure', [PaymentController::class, 'failure'])->name('payment.failure');
// Route::get('/payment/successpage', [PaymentController::class, 'successPage'])->name('payment.successpage');
Route::get(
    '/payment',
    [PaymentController::class, 'index']
)->name('payment.form');

Route::post(
    '/payment/pay',
    [PaymentController::class, 'pay']
)->name('payment.pay');




Route::match(
    ['get', 'post'],
    '/payment/notify',
    [PaymentController::class, 'notify']
)->name('payment.notify');

Route::match(
    ['get', 'post'],
    '/payment/success',
    [PaymentController::class, 'success']
)->name('payment.success');

Route::match(
    ['get', 'post'],
    '/payment/failure',
    [PaymentController::class, 'failure']
)->name('payment.failure');

Route::get(
    '/payment/successpage',
    [PaymentController::class, 'successPage']
)->name('payment.successpage');




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

Route::post(

    '/save-fcm-token',
    [FCMController::class, 'saveToken']

)->middleware('auth');

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
        '/cart/increase/{id}',
        [CartController::class, 'increase']
    );

    Route::get(
        '/cart/decrease/{id}',
        [CartController::class, 'decrease']
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
        '/my-orders/{id}',
        [OrderController::class, 'orderDetails']
    );


    Route::post(

        '/order/cancel/{id}',

        [OrderController::class, 'cancelOrder']

    )->middleware('auth');

    Route::get(
        '/profile',
        [FrontProfileController::class, 'index']
    );
    

    Route::post(
        '/profile/update',
        [FrontProfileController::class, 'update']
    );
    Route::get(
        '/transactions',
        [OrderController::class, 'transactions']
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

    Route::post(
        '/restaurant/orders/{id}/message',
        [RestaurantOrderController::class, 'sendMessage']
    )->name('restaurant.orders.message');

Route::middleware(['auth', 'restaurant_admin'])
    ->prefix('restaurant')
    ->name('restaurant.')
    ->group(function () {

        Route::get(
            '/dashboard',
            [RestaurantDashboardController::class, 'index']
        );
        Route::resource('items', ItemController::class);
        Route::resource('categories', CategoryController::class);
        Route::resource('payments', RestaurantPaymentController::class);
        Route::resource('products', RestaurantProductController::class);
        Route::resource('offers', OfferController::class);
        Route::get(

            '/reviews',

            [RestaurantOrderController::class, 'reviews']

        )->name('reviews');


        Route::post(

            '/reviews/{id}/approve',

            [RestaurantOrderController::class, 'approveReview']

        )->name('reviews.approve');


        Route::post(

            '/reviews/{id}/reject',

            [RestaurantOrderController::class, 'rejectReview']

        )->name('reviews.reject');
        Route::post(
            '/offers/{id}/featured',
            [OfferController::class, 'featured']
        )->name('offers.featured');
        Route::get(
            '/orders',
            [RestaurantOrderController::class, 'index']
        );
        Route::get(
            '/all-orders',
            [RestaurantOrderController::class, 'allOrders']
        );
        Route::get(
            '/orders/{id}',
            [RestaurantOrderController::class, 'show']
        )->name('orders.show');

        Route::post(
            '/orders/{id}/status',
            [RestaurantOrderController::class, 'updateStatus']
        )->name('orders.status');

        Route::get(
            '/profile',
            [ProfileController::class, 'index']
        );

        Route::post(
            '/profile/update',
            [ProfileController::class, 'update']
        );
        // ✅ ADD THIS
        Route::post(
            '/orders/payment-status/{id}',
            [RestaurantOrderController::class, 'updatePaymentStatus']
        )->name('orders.payment.status');

        Route::post(
            '/orders/{id}/refund',
            [RestaurantOrderController::class, 'refundPayment']
        )->name('orders.refund');

        Route::post(
            '/payment-settings',
            [RestaurantController::class, 'updatePaymentSettings']
        )->name('payment.settings.update');

        Route::get(
            '/all-payments',
            [RestaurantPaymentController::class, 'allPayments']
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

Route::get('/login', [UsersController::class, 'showLogin'])
    ->name('login');

// Route::post('/login-user', [UsersController::class, 'login']);
Route::post('/login', [UsersController::class, 'login'])
    ->name('login.submit');

Route::get('/forgot-password', [UsersController::class, 'showForgotPassword']);
Route::post('/forgot-password', [UsersController::class, 'forgotPassword']);    
// Route::get(
//     '/restaurant/{slug}',
//     [HomeController::class, 'restaurantProducts']
// );
Route::get(
    '/restaurant/{slug}',
    [HomeController::class, 'restaurantProducts']
)->name('restaurant.products');
Route::get(
    '/restaurant/{slug}/{category}',
    [HomeController::class, 'restaurantCategoryProducts']
);

Route::get('/storage-link', function () {

    Artisan::call('storage:link');

    return 'Storage Link Created Successfully';

});

Route::post('/logout', function () {

    auth()->logout();

    return redirect('/');

})->name('logout');