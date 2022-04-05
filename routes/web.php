<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReviewController;
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

Route::get('/', [ProductController::class, 'products']);

Route::get('/register', [AuthController::class, 'register']);
Route::post('/register', [AuthController::class, 'store'])->name('register');

Route::get('/login', [AuthController::class, 'login']);
Route::post('/login', [AuthController::class, 'loginPost'])->name('login');
Route::get('/logout', [AuthController::class, 'logout']);

Route::resource('/product',ProductController::class)->parameter('product','product:name');
Route::get('/product/status/{product}',[ProductController::class,'changeProductStatus'])->name('product.status');
Route::resource('/order',OrderController::class)->except(['show','create','destroy']);

Route::get('/order/my-orders',[OrderController::class,'myOrders'])
              ->name('order.my-orders')
               ->middleware('auth');

Route::get('/order/{order}/cancel',[OrderController::class,'cancelOrder'])
              ->name('order.cancel')
    ->middleware('auth');

Route::get('/order/{order}/status/',[OrderController::class,'changeOrderStatus'])
              ->name('order.status')
              ->middleware('auth');


Route::get('/order/history',[OrderController::class,'history'])
    ->name('order.history')
    ->middleware('auth');

Route::get('/order/sale-history',[OrderController::class,'salesHistory'])
    ->name('order.sale-history')
    ->middleware('admin');


Route::resource('/review',ReviewController::class)
    ->only(['index','store']);


