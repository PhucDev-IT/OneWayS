<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Repositories\ProductRepository;
use App\Traits\HandleImagesTrait;
use Hamcrest\Type\IsBoolean;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use phpDocumentor\Reflection\Types\This;

class OrderSevice{


    public function addOrder($order, $orderDetails,$cart_ids) {
        try {
            DB::beginTransaction();
    
            $orderNew = Order::create($order);
            
            foreach($orderDetails as $detail){
                $detail->order_id = $orderNew->id;
                $orderNew->details()->insert($orderDetails);
            }
            DB::commit();
            Cart::whereIn('id', $cart_ids)->delete();
          //  $this->cartService->remove($cart_ids);
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