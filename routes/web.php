<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\CheckoutController;

//Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::get('/update-admin-role', [UserController::class, 'updateAdminRole']);

// Route::middleware(['auth', 'admin'])->group(function (){
//     Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
// });

Route::middleware(AdminMiddleware::class)->group(function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    //add
    Route::get('/admin/products/create', [AdminDashboardController::class, 'createProduct'])->name('products.create');
    Route::post('/admin/products', [AdminDashboardController::class, 'addProduct'])->name('products.store');

    // Edit Product
    Route::get('/admin/products/{id}/edit', [AdminDashboardController::class, 'editProduct'])->name('products.edit');
    Route::put('/admin/products/{id}', [AdminDashboardController::class, 'updateProduct'])->name('products.update');

    //delete
    Route::delete('/admin/products/{id}', [AdminDashboardController::class, 'deleteProduct'])->name('products.delete');

    //view
    Route::get('/products/{id}', [AdminDashboardController::class, 'show'])->name('products.show');



});

Route::get('/', [HomeController::class, 'index'])->name('home');
// Product Details Route
Route::get('/product/{id}', [AdminDashboardController::class, 'show'])->name('product.details');

// Define the route for product.index
Route::get('/products', [ProductController::class, 'index'])->name('product.index');

// // Display all products
// Route::get('/products', function () {
//     return view('products.index');
// })->name('products.index');

// Display all products using ProductController
Route::get('/products', [ProductController::class, 'index'])->name('products.index');

Route::middleware(['auth'])->group(function () {
    Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
    Route::get('/cart', [CartController::class, 'viewCart'])->name('cart.view');
    Route::delete('/cart/remove/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');
});

// Route to checkout
Route::get('/checkout', [OrderController::class, 'checkoutPage'])->name('checkout');
Route::post('/checkout', [OrderController::class, 'checkout'])->name('checkout.submit');

// Route to view an order
Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');

Route::get('/order/success', function () {
    return view('orders.success');  // Corrected path to your success view
})->name('order.success');



require __DIR__ . '/auth.php';
