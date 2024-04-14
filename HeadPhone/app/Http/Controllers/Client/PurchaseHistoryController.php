<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PurchaseHistoryController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->query('status') ?? 'PENDING';

        $user_id = Auth::id();
        try {
            $orders = [];

            if ($status == "PROCESSING") {
                $orders = Order::where(function ($query) use ($user_id) {
                    $query->where('current_status', '=', 'PROCESSING')
                        ->orWhere('current_status', '=', 'DELIVERING');
                })
                    ->where('user_id', '=', $user_id)
                    ->with(['trackingOrders.product'])
                    ->get();
            } else {
                $orders = Order::where('current_status', '=', $status)
                    ->where('user_id', '=', $user_id)->with(['trackingOrders.product'])->get();
            }


            return view('client.purchase_history', compact('orders'));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            $orders = [];
            return view('client.purchase_history', compact('orders'));
        }
    }

    public function OrderDetails($id)
    {
        $user_id = Auth::id();
        try {
            $order = Order::where('order_id', '=', $id)->with(['trackingOrders.product', 'user', 'details'])->first();

            if ($order->user_id != $user_id) {
                // Người dùng không có quyền truy cập
                abort(403, 'Unauthorized');
            }

            $orderDetails = OrderDetails::where('order_id', $id)
                ->with('product')->get(); // Eager loading mối quan hệ 'details'

            return view('client.tracking_order', compact('order', 'orderDetails'));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            $order = null;
            $orderDetails = [];
            return view('client.tracking_order', compact('order', 'orderDetails'));
        }
    }
}
