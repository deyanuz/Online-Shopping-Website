<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DetailsController;
use App\Http\Controllers\ForgotController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResetController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\UserAdminController;
use Illuminate\Support\Facades\Route;


route::get('/', [HomeController::class, 'index'])->name('frontend.home');
route::get('/shop', [ShopController::class, 'index'])->name('frontend.shop');
route::get('/cart', [CartController::class, 'index'])->name('frontend.cart');
route::get('/checkout', [CheckoutController::class, 'index'])->name('frontend.checkout');
route::get('/login', [LoginController::class, 'index'])->name('auth.login');
route::get('/register', [RegisterController::class, 'index'])->name('auth.register');
route::get('/forgot', [ForgotController::class, 'index'])->name('auth.forgot');
route::get('/reset', [ResetController::class, 'index'])->name('auth.reset');
route::get('/product/{slug}', [DetailsController::class, 'index'])->name('product.details');
Route::get('/store/{id}', [CartController::class, 'store'])->name('addToCart');
Route::get('/details/store/{id}', [DetailsController::class, 'store'])->name('fromDetails.addToCart');
Route::get('/cart/quantity/increase/{id}/{qty}', [CartController::class, 'increaseQuantity'])->name('increase.cart');
Route::get('/cart/quantity/decrease/{id}/{qty}', [CartController::class, 'decreaseQuantity'])->name('decrease.cart');
Route::get('/cart/remove/{id}', [CartController::class, 'delete'])->name('delete.cart');
Route::get('/cart/clear', [CartController::class, 'clear'])->name('clear.cart');

route::post('/register', [RegisterController::class, 'registerUser'])->name('auth.register');
route::post('/login', [LoginController::class, 'loginUser'])->name('auth.login');

route::delete('/logout', [LoginController::class, 'logoutUser'])->name('auth.logout');

route::middleware('auth')->group(function () {
    route::get('/user/dashboard', [UserAdminController::class, 'user'])->name('user.dashboard');
});
route::middleware('auth')->group(function () {
    Route::get('/admin/dashboard', [UserAdminController::class, 'admin'])->name('admin.dashboard');
});
