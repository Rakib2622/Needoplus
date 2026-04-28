<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CustomerDashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\DiscountController;
use App\Http\Controllers\Auth\SocialAuthController;
use App\Http\Controllers\ReferralController;




/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES (NO LOGIN REQUIRED)
|--------------------------------------------------------------------------
*/

Route::get('/auth/google', [SocialAuthController::class, 'redirectToGoogle'])->name('google.login');
Route::get('/auth/google/callback', [SocialAuthController::class, 'handleGoogleCallback']);

// Home
Route::get('/', [HomeController::class, 'index'])->name('home');

// Products
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
// Route::get('/product/{id}', [ProductController::class, 'show'])->name('products.show');
Route::get('/product/{slug}', [ProductController::class, 'show'])
    ->name('product.show');
Route::get('/product/quick-view/{id}', [ProductController::class, 'quickView']);

// Categories
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
// Route::get('/category/{id}', [CategoryController::class, 'show'])->name('categories.show');
Route::get('/category/{slug}', [HomeController::class, 'category'])
    ->name('category.show');

// Cart (Guest allowed)
Route::prefix('cart')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('cart.index');
    Route::post('/add', [CartController::class, 'add'])->name('cart.add');
    Route::post('/update', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
});

Route::prefix('checkout')->group(function () {

    // Show checkout page
    Route::get('/', [CheckoutController::class, 'index'])->name('checkout.index');

    // Save shipping info (optional step)
    Route::post('/store', [CheckoutController::class, 'store'])->name('checkout.store');

    // Place order
    Route::post('/place-order', [CheckoutController::class, 'placeOrder'])->name('checkout.placeOrder');

    // Success page
    Route::get('/success/{order}', [CheckoutController::class, 'success'])->name('checkout.success');

    // Cancel / failed
    Route::get('/cancel', [CheckoutController::class, 'cancel'])->name('checkout.cancel');
});
// Pages
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::get('/terms', [PageController::class, 'terms'])->name('terms');

//settings
Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
Route::get('/settings/account', [SettingsController::class, 'account'])->name('settings.account');

Route::get('/settings/privacy-policy', [SettingsController::class, 'privacy'])->name('settings.privacy');
Route::get('/settings/return-policy', [SettingsController::class, 'return'])->name('settings.return');
Route::get('/settings/warranty-policy', [SettingsController::class, 'warranty'])->name('settings.warranty');
Route::get('/settings/refund-policy', [SettingsController::class, 'refund'])->name('settings.refund');


Route::get('/settings/help-support', [SettingsController::class, 'help'])->name('settings.help');
Route::get('/settings/report-problem', [SettingsController::class, 'report'])->name('settings.report');


/*
|--------------------------------------------------------------------------
| CHECKOUT + ORDER ROUTES (GUEST + AUTH USERS)
|--------------------------------------------------------------------------
*/

// Checkout (NO auth required → guest checkout allowed)
// Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
// Route::post('/checkout/place-order', [CheckoutController::class, 'placeOrder'])->name('checkout.place');

// Orders (ONLY for logged-in users)
Route::middleware('auth')->group(function () {



    // Show referral page after login
    Route::get('/referral/complete', [ReferralController::class, 'index'])
        ->name('referral.complete');

    // Save referral
    Route::post('/referral/store', [ReferralController::class, 'store'])
        ->name('referral.store');



    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/order/{id}', [OrderController::class, 'show'])->name('orders.show');

    // Customer Dashboard
    Route::get('/customer/dashboard', [CustomerDashboardController::class, 'index'])->name('customer.dashboard');

    // Profile
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/



Route::middleware(['auth', 'admin'])->group(function () {

    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::prefix('admin')->name('admin.')->group(function () {

        // Category CRUD
        Route::resource('categories', AdminCategoryController::class);

        // ✅ Product CRUD
        Route::resource('products', AdminProductController::class);

        Route::resource('discounts', DiscountController::class);
    });
});


/*
|--------------------------------------------------------------------------
| MODERATOR ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'moderator'])->group(function () {
    Route::get('/moderator/dashboard', function () {
        return view('moderator.dashboard');
    })->name('moderator.dashboard');
});


/*
|--------------------------------------------------------------------------
| AUTH ROUTES (Laravel Breeze)
|--------------------------------------------------------------------------
*/
require __DIR__ . '/auth.php';
