<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ForgotController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResetController;
use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

route::get('/home',[HomeController::class,'index'])->name('frontend.home');
route::get('/shop',[ShopController::class,'index'])->name('frontend.shop');
route::get('/cart',[CartController::class,'index'])->name('frontend.cart');
route::get('/checkout',[CheckoutController::class,'index'])->name('frontend.checkout');
route::get('/login',[LoginController::class,'index'])->name('auth.login');
route::get('/register',[RegisterController::class,'index'])->name('auth.register');
route::get('/forgot',[ForgotController::class,'index'])->name('auth.forgot');
route::get('/reset',[ResetController::class,'index'])->name('auth.reset');

route::post('/register',[RegisterController::class,'registerUser'])->name('auth.register');
