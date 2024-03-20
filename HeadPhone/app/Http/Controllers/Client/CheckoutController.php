<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Cart;
use App\Models\CartDetails;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\TrackingOrder;
use App\Services\OrderService;
use App\Services\OrderSevice;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CheckoutController extends Controller
{

  //  private OrderSevice $orderService;

    

    public function index()
    {
        $idU = Auth::id();

        $cart_ids = Session::get('cartIds');

        $cartDetails = CartDetails::whereIn('id', $cart_ids)->get();
        Session::put('carts', $cartDetails);

        $addresses  = Address::where('user_id', '=', $idU)->get();

        return view('checkout', compact('cartDetails', 'addresses'));
        return view('checkout');
    }
    public function requestCheckout(Request $request)
    {

        $carts = $request['carts'];
        if ($carts != null) {

            Session::put('cartIds', $carts);
            return response()->json('/checkout');
        }
    }


    public function payment(Request $request)
    {
        $order = $request->input('order') ?? null;

        if ($order != null) {
            Session::put('order', $order);
            $method_payment = trim($order['method_payment']);

            switch ($method_payment) {
                case 'MOMO':
                    return $this->paymentWithMomo();
                    break;
                case 'VNPAY':
                    return response()->json(["payUrl" => "http://127.0.0.1:8000/completed"]);
                    break;
                case 'CASH':
                    return response()->json(['payUrl' => '/completed']);
                    break;
                default:
                    return response()->json(['payUrl' => '/completed']);
                    break;
            }
        }
    }

    function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data)
            )
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        //execute post
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);
        return $result;
    }

    public function paymentWithMomo()
    {

        $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";

        $partnerCode = 'MOMOBKUN20180529';
        $accessKey = 'klm05TvNBzhg7h7j';
        $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
        $orderInfo = "Thanh toán qua MoMo";
        $amount = 10000;

        $orderId = time() . "";
        $redirectUrl = "http://127.0.0.1:8000/completed";
        $ipnUrl = "https://webhook.site/b3088a6a-2d17-4f8d-a383-71389a6c600b";
        $extraData = "";

        $partnerCode = $partnerCode;
        $accessKey = $accessKey;
        $serectkey = $secretKey;
        $orderId = $orderId; // Mã đơn hàng
        $orderInfo = $orderInfo;
        $amount = $amount;
        $ipnUrl = $ipnUrl;
        $redirectUrl = $redirectUrl;
        $extraData = $extraData;

        $requestId = time() . "";
        $requestType = "payWithATM";
        // $extraData = ($_POST["extraData"] ? $_POST["extraData"] : "");
        //before sign HMAC SHA256 signature
        $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
        $signature = hash_hmac("sha256", $rawHash, $serectkey);
        $data = array(
            'partnerCode' => $partnerCode,
            'partnerName' => "Test",
            "storeId" => "MomoTestStore",
            'requestId' => $requestId,
            'amount' => $amount,
            'orderId' => $orderId,
            'orderInfo' => $orderInfo,
            'redirectUrl' => $redirectUrl,
            'ipnUrl' => $ipnUrl,
            'lang' => 'vi',
            'extraData' => $extraData,
            'requestType' => $requestType,
            'signature' => $signature
        );
        $result = $this->execPostRequest($endpoint, json_encode($data));
        $jsonResult = json_decode($result, true);  // decode json

        return response()->json($jsonResult);
    }




    public function paymentCompleted()
    {
        $idUser = Auth::id();
        $order = Session::get('order');
        $carts = Session::get('carts');
        $cart_ids = Session::get('cartIds');
        $order['user_id'] = $idUser;

        $orderDetails = [];
        $trackingOrders = [];
        
        foreach ($carts as $item) {
            $o = new OrderDetails();
            $o->color = $item->color;
            $o->quantity = $item->quantity;
            $o->price = $item->product->price - ($item->product->price * $item->product->sale) / 100;
            $o->product_id = $item->product->id;
         
            $orderDetails[] = $o;
        
            // Kiểm tra xem key $o->product_id đã tồn tại trong $trackingOrders hay chưa
            if (!array_key_exists($o->product_id, $trackingOrders)) {
                // Nếu chưa tồn tại, thêm một mảng mới vào $trackingOrders với key là $o->product_id
                $trackingOrders[$o->product_id] = [
                    'product_id' => $o->product_id,
                    'name' => 'PENDING',
                    'time' => now(),
                    'note' => 'Đơn hàng đã được xác nhận',
                ];
            }
        }
        

      //  return response()->json($order);
    
        if($this->addOrder($order,$orderDetails,$cart_ids,$trackingOrders)==true){
            return view('payment_success');
        }else{
            return view('shopping_cart');
        }

       
         
    }

    public function addOrder($order, $orderDetails,$cart_ids,$trackingOrders) {
        try {
            DB::beginTransaction();
    
            $orderNew = Order::create($order);
            
            $orderDs = [];
            foreach($orderDetails as $detail){
                $orderDs[] = [
                    'order_id' => $orderNew->order_id,
                    'color' => $detail->color,
                    'quantity' => $detail->quantity,
                    'price' => $detail->price,
                    'product_id' => $detail->product_id
                ];
            }
            $orderNew->details()->insert($orderDs);
            $this->addTrackingOrder($orderNew->order_id,$trackingOrders);

            DB::commit();

            Cart::whereIn('id', $cart_ids)->delete();

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

    private function addTrackingOrder($idOrder, &$trackingOrders){
        foreach($trackingOrders as &$tracking){
            $tracking['order_id'] = $idOrder;
            TrackingOrder::create($tracking);
        }
    }
    
}
