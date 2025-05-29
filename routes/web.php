<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Frontend\FrontendController;
// use App\Http\Controllers\Frontend\CustomerController as FrontCustomerController;

use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\AuthManager;
// use App\Http\Controllers\Backend\CustomerController as BackCustomerController;
use App\Http\Controllers\Backend\CustomerController;


// Route::get('/', function () {
//     return view('index');
// });

//Frontend Routes
Route::get('/', [FrontendController::class, 'index']);
Route::post('/customer/register', [CustomerController::class, 'register'])->name('customer.register');

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

    Route::get('/product', [ProductController::class, 'index'])->name('admin.product');
    Route::post('/products/store', [ProductController::class, 'store'])->name('admin.products.store');

    Route::get('/category', [CategoryController::class, 'index'])->name('admin.category');
    Route::post('/category/store', [CategoryController::class, 'store'])->name('admin.category.store');
});
