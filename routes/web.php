<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/loading', [App\Http\Controllers\HomeController::class, 'loading'])->name('loading');
Route::get('/cart', [App\Http\Controllers\HomeController::class, 'cart'])->middleware('auth')->name('cart');
Route::get('/notification', [App\Http\Controllers\HomeController::class, 'notification'])->middleware('auth')->name('notification');
Route::post('/product/add', [App\Http\Controllers\ProductController::class, 'add_cart'])->name('product.addToCart');

