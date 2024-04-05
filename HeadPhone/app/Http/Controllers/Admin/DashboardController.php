<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{

    public function index() {
        return view('admin.dashboard.index');
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
