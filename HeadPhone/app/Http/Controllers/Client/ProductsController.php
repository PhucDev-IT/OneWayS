<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    private $productService;


    public function __construct(ProductService $proService)
    {
        $this->productService = $proService;
    }

    public function show(string $id) {
    
        $product =  $this->productService->findOrFail($id)->load(['details', 'categories', 'images']);
        
        return view('product_details',compact('product'));
    }
}
