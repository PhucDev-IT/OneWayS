<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatisticalController extends Controller
{
    public function statisticalProducts()
    {
        $categories = Category::all();
        $products = DB::table('products')
            ->select('products.id','products.name','products.img_preview', DB::raw('SUM(order_details.quantity * order_details.price) as total_sales'))
            ->leftJoin('order_details', 'products.id', '=', 'order_details.product_id')
            ->leftJoin('orders','orders.order_id', '=' ,'order_details.order_id')
            ->where('orders.current_status','=','shipped')
            ->groupBy('products.id','products.name','products.img_preview')
            ->get();
       
        return view('admin.statistical.products',compact('products','categories'));
    }

    public function pieChart(Request $request){
        $id = $request->query('id');

        $statistical = DB::table('order_details')
            ->select('order_details.color', DB::raw('SUM(order_details.quantity * order_details.price) as total_sales'))
            ->where('order_details.product_id','=',$id)
            ->leftJoin('orders','orders.order_id', '=' ,'order_details.order_id')
            ->where('orders.current_status','=','shipped')
            ->groupBy('order_details.color')
            ->get();

            return response()->json($statistical);
    }
}
