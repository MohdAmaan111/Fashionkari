<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Frontend\FrontendController;

use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\AuthManager;
use App\Http\Controllers\Backend\CustomerController;


// Route::get('/', function () {
//     return view('index');
// });

//Frontend Routes
Route::get('/', [FrontendController::class, 'index']);
Route::get('/admin/profile', function () {
    return view('backend.profile');
})->name('admin.profile');

//Backend Routes
Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

Route::match(['get', 'post'], '/admin/login', [AuthManager::class, 'login'])->name('admin.login');
Route::match(['get', 'post'], '/admin/register', [AuthManager::class, 'register'])->name('admin.register');

Route::get('/admin/logout', [AuthManager::class, 'logout'])->name('logout');

Route::get('/admin/user', [AuthManager::class, 'index'])->name('admin.user');

Route::get('/admin/customer', [CustomerController::class, 'index'])->name('admin.customer');
Route::post('/customer/register', [CustomerController::class, 'register'])->name('customer.register');

Route::get('/admin/product', [ProductController::class, 'index'])->name('admin.product');
Route::post('/products/store', [ProductController::class, 'store'])->name('admin.products.store');

Route::get('/admin/category', [CategoryController::class, 'index'])->name('admin.category');
Route::post('/admin/category/store', [CategoryController::class, 'store'])->name('admin.category.store');
