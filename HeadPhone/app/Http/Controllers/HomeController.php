<?php

namespace App\Http\Controllers;

use App\Models\CartDetails;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\BannerCategoryModel;
use App\Models\BannerModel;

use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $this->countCart();
        //$newProducts = ProductDetails::latest('createdat')->limit(5)->get();
        $cate_p_data = Category::where('published', 1)
            ->orderBy('created_at')
            ->take(20)  // có thể lấy take bao nhiêu tuỳ ý 
            ->get();

        $p_data = Product::where('published', 1)
            ->orderBy('created_at')
            ->take(10)
            ->get();
        // KHONG NEN DUNG CACH SELECT parent_id kiểu vậy vì khi delete banner_categories thì web lỗi
        $bannerSlider = BannerModel::where('parent_id', 2)
            ->where('published', 1)
            ->get();
        //return $bannerSlider;
        $right_banner_slider = BannerModel::where('parent_id', 4)
            ->where('published', 1)
            ->take(2)
            ->get();
        $bottom_banner_slider = BannerModel::where('parent_id', 5)
            ->where('published', 1)
            ->take(3)
            ->get();
        return view('home', compact('cate_p_data', 'p_data', 'bannerSlider', 'right_banner_slider', 'bottom_banner_slider'));
    }

    public function fetchNewProducts()
    {
        $newProducts = Product::latest('createdat')->limit(5)->get();
        return response()->json(["products" => $newProducts]);
    }


    function countCart()
    {
        $idUser = Auth::id();
        $count = $count = CartDetails::join('carts', 'cart_details.cart_id', '=', 'carts.id')
            ->where('carts.user_id', $idUser)
            ->count();

        session(['cart-count' => $count]);
        session()->save();
    }
}
