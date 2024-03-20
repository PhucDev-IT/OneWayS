<?php

namespace App\Http\Controllers;

use App\Models\CartDetails;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Category;

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
        $idUser = Auth::id();
        $count = $count = CartDetails::join('carts', 'cart_details.cart_id', '=', 'carts.id')
        ->where('carts.user_id', $idUser)
        ->count();

        session(['cart-count' => $count]);
        session()->save();
        //$newProducts = ProductDetails::latest('createdat')->limit(5)->get();
        $cate_p_data = Category::where('published', 1)
        ->orderBy('created_at')
        ->take(20)  // có thể lấy take bao nhiêu tuỳ ý 
        ->get();

        $p_data = Product::where('published',1)
        ->orderBy('created_at')
        ->take(10)
        ->get();
        return view('home',compact('cate_p_data','p_data'));

    }

    public function fetchNewProducts()
    {
        $newProducts = Product::latest('createdat')->limit(5)->get();
        return response()->json(["products" => $newProducts]);
    }
}