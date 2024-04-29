<?php

use App\Http\Controllers\AddCategoryController;
use App\Http\Controllers\AdminAddProductController;
use App\Http\Controllers\AdminAddSlideController;
use App\Http\Controllers\AdminCategoryController;
use App\Http\Controllers\AdminEditProductController;
use App\Http\Controllers\AdminEditSlideController;
use App\Http\Controllers\AdminHomeSliderController;
use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\BlogsController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DetailsController;
use App\Http\Controllers\EditCategoryController;
use App\Http\Controllers\ForgotController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductByCategory;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResetController;
use App\Http\Controllers\SearchResultController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\UserAdminController;
use App\Http\Controllers\WishlistController;
use Illuminate\Support\Facades\Route;


route::get('/', [HomeController::class, 'index'])->name('frontend.home');
route::get('/shop', [ShopController::class, 'index'])->name('frontend.shop');
route::get('/cart', [CartController::class, 'index'])->name('frontend.cart');
route::get('/checkout', [CheckoutController::class, 'index'])->name('frontend.checkout');
route::get('/login', [LoginController::class, 'index'])->name('auth.login');
route::get('/register', [RegisterController::class, 'index'])->name('auth.register');
route::get('/forgot', [ForgotController::class, 'index'])->name('auth.forgot');
route::get('/reset', [ResetController::class, 'index'])->name('auth.reset');
route::get('/wishlist', [WishlistController::class, 'index'])->name('frontend.wishlist');

route::get('/product/{slug}', [DetailsController::class, 'index'])->name('product.details');
route::get('/store/{id}', [CartController::class, 'store'])->name('addToCart');
route::get('/details/store/{id}', [DetailsController::class, 'store'])->name('fromDetails.addToCart');

route::get('/cart/quantity/increase/{id}/{qty}', [CartController::class, 'increaseQuantity'])->name('increase.cart');
route::get('/cart/quantity/decrease/{id}/{qty}', [CartController::class, 'decreaseQuantity'])->name('decrease.cart');
route::get('/cart/remove/{id}', [CartController::class, 'delete'])->name('delete.cart');
route::get('/cart/clear', [CartController::class, 'clear'])->name('clear.cart');

route::get('/shop/{size}', [ShopController::class, 'changePageSize'])->name('shop.changePageSize');
route::get('/shop/sorting/{orderBy}', [ShopController::class, 'changeOrderBy'])->name('shop.changeOrderBy');


route::get('/shop/category/{slug}', [ProductByCategory::class, 'index'])->name('shop.productByCategory');
route::get('/shop/category-pagesize/{size}', [ProductByCategory::class, 'changePageSize'])->name('shop.productByCategoryPageSize');
route::get('/shop/category-sortorder/{orderBy}', [ProductByCategory::class, 'changeOrderBy'])->name('shop.productByCategoryOrderBy');
route::get('/shop/price-range', [ProductByCategory::class, 'setPriceRange'])->name('shop.priceRange');

route::get('/wishlist/store/{id}', [ShopController::class, 'addToWishlist'])->name('addToWishlist');
route::get('/shop/wishlist/remove/{id}', [ShopController::class, 'remove'])->name('removeFromWishlist');
route::get('/wishlist/remove/{id}', [WishlistController::class, 'remove'])->name('wishlist.removeFromWishlist');

//blog related routes
route::get('/blogs/{query}', [BlogsController::class, 'index'])->name('frontend.blogs');
route::get('/blog-search', [BlogsController::class, 'searchIndex'])->name('frontend.searchBlogs');

//search related routes
route::get('/search', [SearchResultController::class, 'index'])->name('search.product');

route::post('/register', [RegisterController::class, 'registerUser'])->name('auth.register');
route::post('/login', [LoginController::class, 'loginUser'])->name('auth.login');

route::delete('/logout', [LoginController::class, 'logoutUser'])->name('auth.logout');

route::middleware('auth')->group(function () {
    route::get('/user/dashboard', [UserAdminController::class, 'user'])->name('user.dashboard');
});
route::middleware('auth')->group(function () {

    route::get('/admin/dashboard', [UserAdminController::class, 'admin'])->name('admin.dashboard');
    route::get('/admin/categories', [AdminCategoryController::class, 'index'])->name('admin.categories');
    route::get('/admin/products', [AdminProductController::class, 'index'])->name('admin.products');

    route::get('/admin/category/add', [AddCategoryController::class, 'index'])->name('admin.addCategory');
    route::post('/admin/category/store', [AddCategoryController::class, 'storeCategory'])->name('admin.storeCategory');
    route::get('/admin/category/edit/{id}', [EditCategoryController::class, 'index'])->name('admin.editCategory');
    route::post('/admin/edit-category/{id}', [EditCategoryController::class, 'editCategory'])->name('admin.updateCategory');
    route::get('/admin/delete-category/{id}', [EditCategoryController::class, 'deleteCategory'])->name('admin.deleteCategory');

    route::get('/admin/product/add', [AdminAddProductController::class, 'index'])->name('admin.addProduct');
    route::post('/admin/product/store', [AdminAddProductController::class, 'storeProduct'])->name('admin.storeProduct');
    route::get('/admin/product/edit/{id}', [AdminEditProductController::class, 'index'])->name('admin.editProduct');
    route::post('/admin/product/update/{id}', [AdminEditProductController::class, 'updateProduct'])->name('admin.updateProduct');
    route::get('/admin/delete-product/{id}', [AdminEditProductController::class, 'deleteProduct'])->name('admin.deleteProduct');

    route::get('admin/slider', [AdminHomeSliderController::class,'index'])->name('admin.homeSlider');
    route::get('admin/slider/add', [AdminAddSlideController::class,'index'])->name('admin.addSlide');
    route::get('admin/slider/edit/{id}', [AdminEditSlideController::class,'index'])->name('admin.editSlide');

    route::post('/admin/slide/store', [AdminAddSlideController::class, 'storeSlide'])->name('admin.storeSlide');
    route::post('/admin/slide/update/{id}', [AdminEditSlideController::class, 'updateSlide'])->name('admin.updateSlide');
    route::get('/admin/delete-slide/{id}', [AdminEditSlideController::class, 'deleteSlide'])->name('admin.deleteSlide');
});
