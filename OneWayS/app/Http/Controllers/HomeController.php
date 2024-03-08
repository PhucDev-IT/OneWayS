<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

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
        $newProducts = Product::latest('createdat')->limit(5)->get();
        return view('home',compact('newProducts'));
    }

    public function fetchNewProducts()
    {
        $newProducts = Product::latest('createdat')->limit(5)->get();
        return response()->json(["products" => $newProducts]);
    }
}
