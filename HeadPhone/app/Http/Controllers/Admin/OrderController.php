<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\TrackingOrder;
use App\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    private $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function WaitingConfirm()
    {
      
        return view('admin.orders.waitingforconfirm');
    }



    public function callOrderConfirm(Request $request)
    {
        
        return $this->orderService->getOrders($request, "PENDING");
    }

    public function orderDetail($id)
    {
        $order = Order::where('order_id', '=', $id)->with(['trackingOrders.product', 'user', 'details'])->first();

        $orderDetails = OrderDetails::where('order_id', $id)
            ->with('product')->get(); // Eager loading mối quan hệ 'details'
    

        return view('admin.orders.order_details', compact('order','orderDetails'));
    }

    //ADMIN CONFRIM ORDER
    public function confirmOrder($idOrder)
    {
        $tracking = [
            'order_id' => $idOrder,
            'name' => 'PROCESSING',
            'name_vn' => 'Đang xử lý',
            'time' => now(),
            'description' => 'Đơn hàng đang được chuẩn bị, vui lòng chờ người bán gửi hàng!',
        ];
        
        if($this->orderService->addTrackingOrder($idOrder, $tracking)){
            return redirect()->route('orders.orderDetail', ['id' => $idOrder])->with(['message-success' => 'Đơn hàng đã được xác nhận']);
        }else{
            return back()->with(['message-error' => 'Lỗi']);
        }
       
    }

    public function transportOrder($idOrder) {
        $tracking = [
            'order_id' => $idOrder,
            'name' => 'DELIVERING',
            'name_vn' => 'Đang giao hàng',
            'time' => now(),
            'description' => 'Đơn hàng đang được vận chuyển đến bạn.',
        ];
        
        if($this->orderService->addTrackingOrder($idOrder, $tracking)){
            return redirect()->route('orders.orderDetail', ['id' => $idOrder])->with(['message-success' => 'Xác nhận giao đơn hàng']);
        }else{
            return back()->with(['message-error' => 'Lỗi']);
        }
    }

    public function shipped($idOrder) {
        $tracking = [
            'order_id' => $idOrder,
            'name' => 'SHIPPED',
            'name_vn' => 'Giao thành công',
            'time' => now(),
            'description' => 'Đơn hàng đã được giao thành công.',
        ];
        
        if($this->orderService->addTrackingOrder($idOrder, $tracking)){
            return redirect()->route('orders.orderDetail', ['id' => $idOrder])->with(['message-success' => 'Xác nhận đơn hàng đã được giao']);
        }else{
            return back()->with(['message-error' => 'Lỗi']);
        }
    }

    //HUỷ đơn hàng
    public function cancelOrder(Request $request){
        $dataRequest = $request->all();
        $orderId = $dataRequest['order_id'];
        $reason = $dataRequest['reason'];
        $tracking = [
            'order_id' => $orderId,
            'name' => 'CANCEL',
            'name_vn' => 'Đơn hàng bị hủy',
            'time' => now(),
            'description' =>$reason,
        ];
        if($this->orderService->addTrackingOrder($orderId, $tracking)){
            return redirect()->route('orders.orderDetail', ['id' => $orderId])->with(['message-success' => 'Xác nhận đơn hàng đã được giao']);
        }else{
            return back()->with(['message-error' => 'Lỗi']);
        }
    }
}
