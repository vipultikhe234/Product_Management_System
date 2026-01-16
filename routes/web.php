<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\User\AuthController as UserAuthController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\CartController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
*/

// Root redirects to user login or home
Route::get('/', function () {
    return redirect()->route('user.home');
});

// --- ADMIN ROUTES ---
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('login', [AdminAuthController::class, 'showLogin'])->name('login');
    Route::post('login', [AdminAuthController::class, 'login']);
    Route::post('logout', [AdminAuthController::class, 'logout'])->name('logout');

    Route::middleware('auth:admin')->group(function () {
        Route::get('dashboard', function () {
            return redirect()->route('admin.products.index');
        })->name('dashboard');
        Route::resource('products', ProductController::class);
        Route::patch('products/{product}/toggle', [ProductController::class, 'toggleActive'])->name('products.toggle');
    });
});

// --- USER ROUTES ---
Route::name('user.')->group(function () {
    // Guest Routes
    Route::middleware('guest')->group(function() {
        Route::get('login', [UserAuthController::class, 'showLogin'])->name('login');
        Route::post('login', [UserAuthController::class, 'login']);
        Route::get('register', [UserAuthController::class, 'showRegister'])->name('register');
        Route::post('register', [UserAuthController::class, 'register']);
    });

    // Authenticated Routes
    Route::middleware('auth')->group(function () {
        // Home / Products
        Route::get('home', [HomeController::class, 'index'])->name('home');
        Route::post('logout', [UserAuthController::class, 'logout'])->name('logout');

        // Cart
        Route::get('cart', [CartController::class, 'index'])->name('cart.index');
        Route::post('cart/add', [CartController::class, 'add'])->name('cart.add');
        Route::patch('cart/{item}', [CartController::class, 'update'])->name('cart.update');
        Route::delete('cart/{item}', [CartController::class, 'remove'])->name('cart.remove');
        Route::post('cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
    });
});
