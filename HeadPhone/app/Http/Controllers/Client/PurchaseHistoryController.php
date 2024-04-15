<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Reviews;
use App\Models\TrackingOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PurchaseHistoryController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->query('status') ?? 'PENDING';

        $user_id = Auth::id();
        try {
            $orders = [];

            if ($status == "processing") {
                $orders = Order::where(function ($query) use ($user_id) {
                    $query->where('current_status', '=', 'processing')
                        ->orWhere('current_status', '=', 'delivering');
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

    public function cancelOrder(Request $request){
        $dataRequest = $request->all();
        $orderId = $dataRequest['order_id'];
        $reason = $dataRequest['reason'];
        $tracking = [
            'order_id' => $orderId,
            'name' => 'cancel',
            'name_vn' => 'Đơn hàng bị hủy',
            'time' => now(),
            'description' =>$reason,
        ];
        try {
            DB::beginTransaction();
            $order = Order::where('order_id', '=', $orderId)->first();

            if ($order) {
                $order->where('order_id', $orderId)->update(['current_status' => $tracking['name']]);
            }
            TrackingOrder::create($tracking);
            DB::commit();
            return redirect()->route('/order/tracking/'+$orderId)->with(['message-success' => 'Đơn hàng đã bị hủy']);
        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            return back()->with(['message-error' => 'Lỗi']);
        }
       
    }

    public function reviews(Request $request){
        $data = $request->all();
        $data['time'] = now();
        $data['user_id'] = Auth::id();
        try{
            $review = Reviews::create($data);
            return redirect()->route('products.show_details',['id'=>$data['product_id']]);
        }catch (\Exception $e) {
          
            Log::error($e->getMessage());
            return back()->with(['message-error' => 'Lỗi']);
        }
    }
}
