<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Client\ProductsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShoppingCartController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/welcom', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('admin.dashboard.index');
})->name('dashboard');

Route::get('admin/products/search', [ProductController::class, 'search'])->name('products.search');


Route::resource('admin/roles',RoleController::class);


Route::resource('admin/users',UserController::class);
Route::resource('admin/categories',CategoryController::class);
Route::resource('admin/products',ProductController::class);
Route::resource('admin/vouchers',CouponController::class);
Route::get('admin/search-users', [UserController::class,'searchUsers']);


Auth::routes();

// Route::middleware(['auth'])->group(function() {
    
     Route::post('cart/addToCart', [ShoppingCartController::class, 'addToCart'])->name('cart.addToCart');
// });
//Route::resource('cart', ShoppingCartController::class);
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/show/product{id}',[ProductsController::class,'show'])->name('products.details');

Route::get('fetchNewProducts', [HomeController::class,'fetchNewProducts']);


