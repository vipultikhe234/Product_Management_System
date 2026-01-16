<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CartController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
*/

// Auth
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);

    // Cart
    Route::get('cart', [CartController::class, 'index']);
    Route::post('cart/items', [CartController::class, 'store']);
    Route::patch('cart/items/{product_id}', [CartController::class, 'update']);
    Route::delete('cart/items/{product_id}', [CartController::class, 'destroy']);
    
    // Checkout
    Route::post('cart/checkout', [CartController::class, 'checkout']);
    
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});
