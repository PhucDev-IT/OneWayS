<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Client\CheckoutController;
use App\Http\Controllers\Client\ProductsController;
use App\Http\Controllers\Client\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Client\ShoppingCartController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\BannerCategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ImportGoodsController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\StoreController;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpKernel\Profiler\Profile;

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

Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

Route::middleware(['middleware' => 'auth'],)->group(function () {

    //Trang chủ
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/dashboard/statisticalByYear', [DashboardController::class, 'statisticalByYear'])->name('dashboard.statisticalByYear');

    //Nhập hàng
    Route::get('admin/nhap-hang', [ImportGoodsController::class, 'index'])->name('imports.index');
    Route::get('admin/them-phieu-nhap', [ImportGoodsController::class, 'create'])->name('imports.create');
    Route::post('admin/nhap-hang/store', [ImportGoodsController::class, 'store'])->name('imports.store');

    //admin - orders
    Route::get('orders/pendding', [OrderController::class, 'WaitingConfirm'])->name('orders.waiting_confirm');
    Route::get('fetch/orders-pendding', [OrderController::class, 'callOrderConfirm'])->name('orders.fetch_order_pending');
    Route::get('order/id={id}', [OrderController::class, 'orderDetail'])->name('orders.orderDetail');
    Route::get("confirm-order/{idOrder}", [OrderController::class, 'confirmOrder'])->name("orders.confirm_order");
    Route::get('transport-order/{idOrder}', [OrderController::class, 'transportOrder'])->name("orders.delivering");
    Route::get('shipped-order/{idOrder}', [OrderController::class, 'shipped'])->name("orders.shipped");

    Route::get('admin/filler-products', [ProductController::class, 'fillerByName'])->name('admin.products.filler');
    Route::get('admin/products/search', [ProductController::class, 'search'])->name('products.search');

    //User
    Route::get('search-users', [UserController::class, 'searchUsers'])->name('voucher.search_user');
    Route::resource('admin/users', UserController::class);
    Route::post('admin/user/store', [UserController::class, 'store'])->name('admin.users.store');

    Route::resource('admin/roles', RoleController::class);
    Route::resource('admin/categories', CategoryController::class);
    Route::resource('admin/products', ProductController::class);
    Route::resource('admin/vouchers', CouponController::class);
});







Route::resource('admin/banner', BannerController::class);
Route::resource('admin/banner_category', BannerCategoryController::class);




Auth::routes();

Route::middleware(['auth'])->group(function () {

    Route::post('cart/addToCart', [ShoppingCartController::class, 'addToCart'])->name('cart.addToCart');
    Route::post('/cart/updateQuantity', [ShoppingCartController::class, 'updateQuantity'])->name('cart.update_quantity');
    Route::resource('shopping-cart', ShoppingCartController::class);
    Route::get('store', [StoreController::class, 'index'])->name('store.index');

    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/request', [CheckoutController::class, 'requestCheckout'])->name('checkout.request');
    Route::get('completed', [CheckoutController::class, 'paymentCompleted'])->name('checkout.complete');
    Route::post('payment', [CheckoutController::class, 'payment'])->name('checkout.payment');
});


Route::middleware(['auth'])->group(function () {
    Route::get('profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('profile/address', [ProfileController::class, 'fetchAddress'])->name('profile.fetchAddress');
    Route::get('profile/address/create', [ProfileController::class, 'createAddress'])->name('profile.newAddress');
    Route::post('profile/address/store', [ProfileController::class, 'storeAddress'])->name('profile.addAddress');
});


Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/show/product{id}', [ProductsController::class, 'show'])->name('products.details');
Route::get('fetchNewProducts', [HomeController::class, 'fetchNewProducts']);
