<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Frontend\FrontendController;
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

//Frontend Routes
Route::get('/', [FrontendController::class, 'index'])->name('index');
Route::get('/product/{id}', [FrontendController::class, 'singleProduct'])->name('product.show');
Route::post('/customer/login', [CustomerController::class, 'login'])->name('customer.login');
Route::post('/customer/register', [CustomerController::class, 'register'])->name('customer.register');

//Backend Routes

// Public Routes (login/register)
Route::match(['get', 'post'], '/admin/login', [AuthManager::class, 'login'])->name('admin.login');
Route::match(['get', 'post'], '/admin/register', [AuthManager::class, 'register'])->name('admin.register');

Route::get('/admin/logout', [AuthManager::class, 'logout'])->name('admin.logout');

// Routes protected by auth middleware
Route::middleware('auth')->prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    Route::get('/profile', [DashboardController::class, 'profile'])->name('admin.profile');

    // Route::get('/logout', [AuthManager::class, 'logout'])->name('admin.logout');

    Route::get('/user', [AuthManager::class, 'index'])->name('admin.user');

    Route::get('/customer', [CustomerController::class, 'index'])->name('admin.customer');
    Route::post('/customer/register', [CustomerController::class, 'register'])->name('admin.customer.register');

    // products routes
    Route::get('/product', [ProductController::class, 'index'])->name('admin.product');
    Route::post('/product/store', [ProductController::class, 'store'])->name('admin.product.store');
    Route::post('/product/edit', [ProductController::class, 'edit'])->name('admin.product.edit');

    Route::get('/variant', [VariantController::class, 'index'])->name('admin.variant');
    Route::post('/variant/get', [VariantController::class, 'getVariants'])->name('admin.variant.get');
    Route::post('/variant/store', [VariantController::class, 'store'])->name('admin.variant.store');

    Route::get('/brand', [BrandController::class, 'index'])->name('admin.brand');
    Route::post('/brand/store', [BrandController::class, 'store'])->name('admin.brand.store');

    Route::get('/category', [CategoryController::class, 'index'])->name('admin.category');
    Route::post('/category/store', [CategoryController::class, 'store'])->name('admin.category.store');
});
