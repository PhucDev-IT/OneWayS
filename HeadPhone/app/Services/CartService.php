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

class CartService{

   public function remove($ids) {
    Cart::whereIn('id', $ids)->delete();
   }
}

?>