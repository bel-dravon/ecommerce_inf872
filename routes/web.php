<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [App\Http\Controllers\ProductController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('/products', ProductController::class);
    Route::resource('/orders', OrderController::class);
    Route::resource('/order_items', OrderItemController::class);
    Route::post('/cart/add/{product}', [CartController::class, 'addToCart'])->name('cart.add');
    Route::get('/orders/{order}/pdf', [OrderController::class, 'generatePDF'])->name('orders.generatePDF');
    Route::get('order_items/{id}/invoice', [OrderItemController::class, 'generateInvoice'])->name('order_items.invoice');
    Route::get('order_items/{id}/invoice', [OrderItemController::class, 'generateInvoice'])
        ->name('order_items.generateInvoice');
    Route::get('/my-orders', [OrderController::class, 'myOrders'])->name('orders.my');
    Route::get('/orders/{order}/checkout', [OrderController::class, 'checkout'])->name('orders.checkout');
    // web.php
    Route::get('/orders/{id}/payment', [OrderController::class, 'showPayment'])->name('orders.showPayment');
    Route::post('/orders/{id}/process-payment', [OrderController::class, 'processPayment'])->name('orders.processPayment');
    Route::post('/orders/{order}/cancel', [OrderController::class, 'cancel'])
        ->name('orders.cancel');
    Route::put('/order_items/{orderItem}/edit-client', [OrderItemController::class, 'editClient'])
        ->name('order_items.editClient');
});

require __DIR__ . '/auth.php';
