<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Reviews;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    private $productService;


    public function __construct(ProductService $proService)
    {
        $this->productService = $proService;
    }

    public function show(Request $request) {
        $id = $request->query('id');
        $product =  $this->productService->findOrFail($id)->load(['details', 'categories', 'images']);
        
        return view('product_details',compact('product'));
    }

    public function getReviews(Request $request){
        $id = $request->query('id');
        $reviews = Reviews::where('product_id','=',$id)->with('user')->get();
        return response()->json($reviews);
    }
}
