<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function show(string $id) {
    
        $product = Product::findOrFail($id)->load(['details', 'categories', 'images']);
    
        return view('product_details',compact('product'));
    }
}
