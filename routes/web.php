<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderItemController;

use App\Http\Controllers\ProductController;
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
Route::resource('products', ProductController::class);
Route::resource('orders', OrderController::class);
Route::resource('order_items', OrderItemController::class);
Route::get('/orders/{order}/pdf', [OrderController::class, 'generatePDF'])->name('orders.generatePDF');
Route::get('order_items/{id}/invoice', [OrderItemController::class, 'generateInvoice'])->name('order_items.invoice');
Route::get('order_items/{id}/invoice', [OrderItemController::class, 'generateInvoice'])
    ->name('order_items.generateInvoice');

