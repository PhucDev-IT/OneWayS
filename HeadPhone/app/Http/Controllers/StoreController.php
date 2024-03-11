<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;

class StoreController extends Controller
{


    public function index()
    {

        $categories = Category::withCount('products')->get();
        $suppliers = Supplier::withCount('products')->get();
        $products = Product::paginate(12);
        return view('store', compact('categories', 'suppliers', 'products'));
    }

    public function filler(Request $request)
    {

        $category_ids = $request['category_ids'] ?? [];
        $supplier_ids = $request['supplier_ids'] ?? [];

        $products = [];

        $products = Product::when(count($category_ids) > 0, function ($query) use ($category_ids) {
            $query->whereHas('categories', function ($q) use ($category_ids) {
                $q->whereIn('category_id', $category_ids);
            });
        })
            ->when(count($supplier_ids) > 0, function ($query) use ($supplier_ids) {
                $query->whereIn('supplier_id', $supplier_ids);
            })
             // ->when($min_price !== null && $max_price !== null, function ($query) use ($min_price, $max_price) {
            //     $query->whereBetween('price', [$min_price, $max_price]);
            // })
            ->get();
           
        return response()->json($products);
    }
}
