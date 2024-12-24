<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ShippingController;
use App\Http\Controllers\ProductsZenzaraController;
use App\Http\Controllers\ZenzaraCartController;


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

/*
Route::get('/', function () {
    return view('welcome');
});
*/

Route::get('/', [ProductController::class, 'index'])->name('products.index');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/shipping/generate', [ShippingController::class, 'generateShipment'])->name('shipping.generate');
Route::post('/shipping/quote', [ShippingController::class, 'quoteShipment'])->name('shipping.quote');



Route::get('/zensara', [ProductsZenzaraController::class, 'index'])->name('zensara.index');
Route::post('/zensara/add/{id}', [ProductsZenzaraController::class, 'add'])->name('zensara.add');
Route::get('/zensara/cart', [ProductsZenzaraController::class, 'cart'])->name('zensara.cart');
Route::post('/zensara/quotation', [ZenzaraCartController::class, 'quotations'])->name('zensara.quotation.create');
Route::post('/zensara/orders', [ZenzaraCartController::class, 'create'])->name('zensara.order.create');
Route::delete('/zensara/cart/remove/{id}', [ProductsZenzaraController::class, 'remove'])->name('zensara.cart.remove');
Route::post('/rates/process', [ZenzaraCartController::class, 'processRate'])->name('zensara.rates.process');

#zensara.shipping.create




