<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Termwind\Components\Raw;

class DashboardController extends Controller
{

    public function index() {
        $count_new_order = Order::whereDate('orderdate', '=', now()->toDateString())->count();

        $total_monthly = DB::table('orders')
        ->selectRaw('SUM(orders.totalmoney) as total_month')
        ->where('orders.current_status','=','shipped')
        ->first();    
    
        $total_waiting = DB::table('orders')
        ->selectRaw('SUM(orders.totalmoney) as total_month')
        ->where('orders.current_status','!=','shipped')
        ->first();  

    
        return view('admin.dashboard.index',compact('count_new_order','total_monthly','total_waiting'));
    }

    public function statisticalByYear()
    {
        $ordersRevenue = DB::table('orders')
            ->selectRaw('MONTH(orderdate) as month, YEAR(orderdate) as year, SUM(totalmoney) as revenue')
            ->groupBy('month', 'year');

        $importRevenue = DB::table('import_information')
            ->selectRaw('MONTH(time) as month, YEAR(time) as year, -SUM(total) as revenue')
            ->groupBy('month', 'year');

        $revenuesByYear = $ordersRevenue->unionAll($importRevenue)
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();

        return response()->json($revenuesByYear);
    }
}
