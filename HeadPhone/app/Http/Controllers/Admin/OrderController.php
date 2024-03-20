<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\TrackingOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{

    public function WaitingConfirm()
    {
        $orders = Order::where('current_status', 'PENDING')->with(['user', 'tracking'])->get();
        dd($orders);
        return view('admin.orders.waitingforconfirm');
    }

    public function callOrderConfirm(Request $request)
    {
        $page = $request['page'] ?: 1;


        try {
            $orders = Order::where('current_status', 'PENDING')->with(['user', 'tracking'])->get();

            return response()->json([
                'orders' => $orders

            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([]);
        }
    }

    public function orderDetail($id)
    {
        $order = Order::where('order_id', '=', $id)->first();

        return view('admin.orders.order_details', compact('order'));
    }
}
