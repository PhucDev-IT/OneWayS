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
use App\Http\Controllers\Admin\StatisticalController;
use App\Http\Controllers\Client\PurchaseHistory;
use App\Http\Controllers\Client\PurchaseHistoryController;
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

Route::get('/', [HomeController::class, 'index'])->name('trang_chu');

Route::get('/welcom', function () {
    return view('welcome');
});

Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

    //Trang chủ
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/dashboard/statisticalByYear', [DashboardController::class, 'statisticalByYear'])->name('dashboard.statisticalByYear');

    //Nhập hàng
    Route::get('admin/nhap-hang', [ImportGoodsController::class, 'index'])->name('imports.index');
    Route::get('admin/them-phieu-nhap', [ImportGoodsController::class, 'create'])->name('imports.create');
    Route::post('admin/nhap-hang/store', [ImportGoodsController::class, 'store'])->name('imports.store');
    Route::get('admin/nhap-hang/san-pham',[ImportGoodsController::class,'showProducts'])->name('admin.nhap-hang.san-pham');
    Route::post('admin/sync-product',[ImportGoodsController::class,'addQuantityToProduct'])->name('admin.sync-product');

    //admin - orders
    Route::get('admin/orders', [OrderController::class, 'index'])->name('orders.index');

    Route::post('admin/order/cancel',[OrderController::class,'cancelOrder'])->name('admin.orders.cancel');
    Route::get('admin/order/id={id}', [OrderController::class, 'orderDetail'])->name('orders.orderDetail');
    Route::get("admin/confirm-order/{idOrder}", [OrderController::class, 'confirmOrder'])->name("orders.confirm_order");
    Route::get('admin/transport-order/{idOrder}', [OrderController::class, 'transportOrder'])->name("orders.delivering");
    Route::get('admin/shipped-order/{idOrder}', [OrderController::class, 'shipped'])->name("orders.shipped");



    Route::get('admin/filler-products', [ProductController::class, 'fillerByName'])->name('admin.products.filler');
    Route::get('admin/products/search', [ProductController::class, 'search'])->name('products.search');

  //Thống kê
  Route::get('admin/statistical-products',[StatisticalController::class,'statisticalProducts'])->name('admin.statistical.products');
  Route::get('admin/product/pie-chart',[StatisticalController::class,'pieChart'])->name('admin.statistical.piechart');






    //User
    Route::get('search-users', [UserController::class, 'searchUsers'])->name('voucher.search_user');
    Route::resource('admin/users', UserController::class);
    Route::post('admin/user/store', [UserController::class, 'store'])->name('admin.users.store');
    Route::resource('admin/roles', RoleController::class);


    Route::resource('admin/users', UserController::class);
    Route::resource('admin/categories', CategoryController::class);
    Route::resource('admin/products', ProductController::class);
    Route::resource('admin/vouchers', CouponController::class);
    Route::get('search-users', [UserController::class, 'searchUsers'])->name('voucher.search_user');
    //BANNER CATEGORIES
    Route::prefix('/banner-categories')->group(function () {
        Route::get('/', [BannerCategoryController::class, 'index'])->name('banner-categories');

        Route::get('/edit-banner-categories/{id}', [BannerCategoryController::class, 'edit'])
          ->where('id', '[0-9]+')
          ->name('banner-categories-edit');

        Route::get('/add', [BannerCategoryController::class, 'add'])->name('banner-categories-add');
        
        Route::get('/delete-banner-categories/{id}', [BannerCategoryController::class, 'delete'])->name('delete-banner-categories');

      });
    Route::post('/banner-categories-store', [BannerCategoryController::class, 'banner_store_category'])->name('banner-categories-store');
      
    //BANNER
    Route::prefix('/banner')->group(function () {
    Route::get('/', [BannerController::class, 'index'])->name('banner');
    Route::post('/', [BannerController::class, 'index'])->name('banner_filter');

    Route::get('/edit-banner/{id}', [BannerController::class, 'edit'])
      ->where('id', '[0-9]+')
      ->name('banner-edit');
      
    Route::get('/add', [BannerController::class, 'add'])->name('banner-add');
    
    Route::get('/delete-banner/{id}', [BannerController::class, 'delete'])->name('delete-banner');

  });
  Route::post('/banner-store', [BannerController::class, 'banner_store'])->name('banner-store');
  



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


    //Xem đơn hàng
    Route::get('/orders',[PurchaseHistoryController::class,'index']);
    Route::get('/order/tracking/{id}',[PurchaseHistoryController::class,'OrderDetails']);
    Route::post('order/cancel',[PurchaseHistoryController::class,'cancelOrder']);
    Route::post('order/review',[PurchaseHistoryController::class,'review']);

});


Route::middleware(['auth'])->group(function () {
    Route::get('profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('profile/address', [ProfileController::class, 'fetchAddress'])->name('profile.fetchAddress');
    Route::get('profile/address/create', [ProfileController::class, 'createAddress'])->name('profile.newAddress');
    Route::post('profile/address/store', [ProfileController::class, 'storeAddress'])->name('profile.addAddress');
});



Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/show/product', [ProductsController::class, 'show'])->name('products.show_details');
Route::get('fetchNewProducts', [HomeController::class, 'fetchNewProducts']);