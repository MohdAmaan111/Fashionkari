<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\AccountController;
use App\Http\Controllers\Frontend\CartController;
// use App\Http\Controllers\Frontend\CustomerController as FrontCustomerController;

use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\VariantController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\AuthManager;
// use App\Http\Controllers\Backend\CustomerController as BackCustomerController;
use App\Http\Controllers\Backend\CustomerController;


Route::get('/welcome', function () {
    // return view('welcome');
});

Route::post('/test-ajax', function () {
    dd('AJAX working!');
});

//Frontend Routes
Route::get('/', [FrontendController::class, 'index'])->name('index');
Route::get('/product/{id}', [FrontendController::class, 'singleProduct'])->name('product.show');

Route::get('/customer/account', [AccountController::class, 'index'])->name('customer.account');
Route::get('/customer/profile', [AccountController::class, 'profile'])->name('customer.profile');

Route::get('/profile/orders', [AccountController::class, 'orders'])->name('customer.orders');
Route::get('/profile/wishlist', [AccountController::class, 'wishlist'])->name('customer.wishlist');
Route::get('/profile/payment', [AccountController::class, 'payment'])->name('customer.payment');
Route::get('/profile/address', [AccountController::class, 'address'])->name('customer.address');
Route::get('/profile/setting', [AccountController::class, 'setting'])->name('customer.setting');

Route::post('/customer/login', [CustomerController::class, 'login'])->name('customer.login');
Route::post('/customer/register', [CustomerController::class, 'register'])->name('customer.register');
Route::get('/customer/logout', [AccountController::class, 'logout'])->name('customer.logout');

Route::get('/customer/cart/', [CartController::class, 'index'])->name('cart');
Route::post('/customer/cart/add', [CartController::class, 'addcart'])->name('cart.add');
Route::post('/customer/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::delete('/customer/cart/remove/{cartId}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');



//Backend Routes

// Public Routes (login/register)
Route::match(['get', 'post'], '/admin/login', [AuthManager::class, 'login'])->name('admin.login');
Route::match(['get', 'post'], '/admin/register', [AuthManager::class, 'register'])->name('admin.register');

// Routes protected by auth middleware
Route::middleware('auth')->prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    Route::get('/profile', [DashboardController::class, 'profile'])->name('admin.profile');

    Route::get('/logout', [AuthManager::class, 'logout'])->name('admin.logout');

    Route::get('/user', [AuthManager::class, 'index'])->name('admin.user');

    Route::get('/customer', [CustomerController::class, 'index'])->name('admin.customer');
    Route::post('/customer/register', [CustomerController::class, 'register'])->name('admin.customer.register');
    Route::delete('/customer/{id}', [CustomerController::class, 'destroy'])->name('admin.customer.destroy');


    // products routes
    Route::get('/product', [ProductController::class, 'index'])->name('admin.product');
    Route::post('/product/store', [ProductController::class, 'store'])->name('admin.product.store');
    Route::delete('/product/{id}', [ProductController::class, 'destroy'])->name('admin.products.destroy');

    Route::get('/variant', [VariantController::class, 'index'])->name('admin.variant');
    Route::post('/variant/get', [VariantController::class, 'getVariants'])->name('admin.variant.get');
    Route::post('/variant/store', [VariantController::class, 'store'])->name('admin.variant.store');

    Route::get('/brand', [BrandController::class, 'index'])->name('admin.brand');
    Route::post('/brand/store', [BrandController::class, 'store'])->name('admin.brand.store');

    Route::get('/category', [CategoryController::class, 'index'])->name('admin.category');
    Route::post('/category/store', [CategoryController::class, 'store'])->name('admin.category.store');
});
