<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Product;
use App\Repositories\ProductRepository;
use App\Traits\HandleImagesTrait;
use Hamcrest\Type\IsBoolean;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use phpDocumentor\Reflection\Types\This;

class OrderSevice{

    private CartService $cartService;
    public function __construct($cartService)
    {
        $this->cartService = $cartService;
    }

    public function addOrder($order, $orderDetails,$cart_ids) {
        try {
            DB::beginTransaction();
    
            $orderNew = Order::create($order);
    
            $orderDetails['order_id'] = $orderNew->id;
            $orderNew->details()->insert($orderDetails);
            DB::commit();
    
            $this->cartService->remove($cart_ids);
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            return false;
        }
    }

    //Thông báo cho admin
    function notificationForAdmin() {
        
    }

}

?>