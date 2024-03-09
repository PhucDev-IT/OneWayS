<?php

namespace App\Http\Controllers;

use App\Models\CartDetails;
use App\Models\Product;
use Illuminate\Http\Request;
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

        $newProducts = Product::latest('createdat')->limit(5)->get();
        return view('home',compact('newProducts'));
    }

    public function fetchNewProducts()
    {
        $newProducts = Product::latest('createdat')->limit(5)->get();
        return response()->json(["products" => $newProducts]);
    }
}
