<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\CartDetails;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\TrackingOrder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class OrderService
{
    public function getOrders($request, $status)
    {
        $page = $request['page'] ?: 1;


        try {
            $orders = Order::where('current_status', '=' ,$status)->with(['trackingOrders.product', 'user'])->get();
          
            return response()->json([
                'orders' => $orders
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([]);
        }
    }

    public function addOrder($order, $carts, $cart_ids)
    {
        try {
            DB::beginTransaction();

            $orderNew = Order::create($order);

            $orderDetails = [];


            foreach ($carts as $item) {
                $o = [
                    'order_id' => $orderNew->order_id,
                    'color' => $item->color,
                    'quantity' => $item->quantity,
                    'price' => $item->product->price - ($item->product->price * $item->product->sale) / 100,
                    'product_id' => $item->product->id
                ];

                $orderDetails[] = $o;
            }
            $orderNew->details()->insert($orderDetails);

            $tracking = [
                'order_id' => $orderNew->order_id,
                'name' => 'pending',
                'name_vn' => 'Chờ xác nhận',
                'time' => now(),
                'description' => 'Đơn hàng đã được đặt. Chờ người bán xác nhận đơn hàng',
            ];


            TrackingOrder::create($tracking);

            DB::commit();

            CartDetails::whereIn('id', $cart_ids)->delete();

            Session::forget('order');
            Session::forget('carts');
            Session::forget('cartIds');

            return true;
        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            return false;
        }
    }

    public function addTrackingOrder($idOrder,$tracking)
    {
        try {
            
            $order = Order::where('order_id', '=', $idOrder)->first();

            if ($order) {
                $order->where('order_id', $idOrder)->update(['current_status' => $tracking['name']]);
            }


            TrackingOrder::create($tracking);
           return true;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return false;
        }
    }


}
