<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Client\ProfileController;
use App\Http\Controllers\Client\ShoppingCartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StoreController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/products',[ProductController::class,"fetchProducts"])->name('admin.products');
Route::get('/products/search',[ProductController::class,"search"]);

Route::post('/lock-on-user', [UserController::class,'lockOnUser']);
Route::get('/fetch-user',[UserController::class,'fetchData']);

Route::get('/fetchRoles',[RoleController::class,"fetchRoles"]);
Route::get('/fetch-categories',[CategoryController::class,"fetchCategories"]);
Route::get('/fetch-coupons',[CouponController::class,"fetchCoupon"]);
Route::post('/create-category',[CategoryController::class,'store']);


//Client

Route::get('/province',[ProfileController::class,'callProvinces']);
Route::get('/districts/{province_id}',[ProfileController::class,'callDistricts']);
Route::get('/wards/{district_id}',[ProfileController::class,'callWards']);

Route::get('service',[ShoppingCartController::class,'getTransportUnits'])->name('checkout.service');
Route::get('fee',[ShoppingCartController::class,'calculateFee'])->name('checkout.fee');

Route::get('getvouchers',[ShoppingCartController::class,'getvouchers'])->name('checkout.getvouchers');

Route::post('products/filler',[StoreController::class,'filler'])->name('store.filler');