<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\APIController;
use App\Http\Controllers\OrderController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/register', [AuthController::class, 'register']);

Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

// Product routes
Route::get('/products', [APIController::class, 'index']); 
Route::get('/products/{id}', [APIController::class, 'show']); 

// Cart routes
Route::post('/cart/add', [APIController::class, 'addToCart'])->middleware('auth:sanctum');
Route::get('/cart', [APIController::class, 'getCart'])->middleware('auth:sanctum');
Route::delete('/cart/delete/{id}', [APIController::class, 'removeFromCart'])->middleware('auth:sanctum');

// Checkout route
Route::post('/checkout', [APIController::class, 'checkout'])->middleware('auth:sanctum');

//VIew your profile
Route::get('/user/profile', [APIController::class, 'viewProfile'])->middleware('auth:sanctum');

