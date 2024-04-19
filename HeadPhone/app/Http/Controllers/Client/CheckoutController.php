<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\CartDetails;
use App\Services\OrderService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{

    private $orderService;

    public function __construct(OrderService $orderS)
    {
        $this->orderService = $orderS;
    }


    /*
        1. Đầu tiên người dùng ở trang shopping cart chọn các sản phẩm
        2. Sau khi chọn và nhấn 'mua ngay' thì lưu các id cart đã chọn và gửi lên server và lưu vào session
        3. Form check out sẽ từ các id cart đã chọn đó select các cart_details có id đã chọn
        4. Lưu cartZ_detail vào session để sau lưu thông tin thanh toán

    */

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
      
        $returnData = json_encode(array(
            'code' => '200', 'message' => 'success', 'payUrl' => '/completed'
        ));
        
        if ($order != null) {
            Session::put('order', $order);
            $method_payment = trim($order['method_payment']);

            switch ($method_payment) {
                case 'MOMO':
                    return $this->paymentWithMomo();
                    break;
                case 'VNPAY':
                    return $this->paymentWithVnPay($order['totalmoney']);
                    break;
                case 'CASH':
                   
                    return response()->json($returnData);
                    break;
                default:
                    return response()->json($returnData);
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
       // $jsonResult = json_decode($result, true);  // decode json

        return response()->json($result);
    }




    public function paymentCompleted()
    {
        $idUser = Auth::id();
        $order = Session::get('order');
        $carts = Session::get('carts');
        $cart_ids = Session::get('cartIds');
        $order['user_id'] = $idUser;


        if ($this->orderService->addOrder($order, $carts, $cart_ids) == true) {
            return view('payment_success');
        } else {
            return view('shopping_cart');
        }
    }


    //Thanh toán qua VNPAY
    public function paymentWithVnPay($total = 1000)
    {

        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "http://127.0.0.1:8000/completed";
        $vnp_TmnCode = "2YM2BN6W"; //Mã website tại VNPAY 
        $vnp_HashSecret = "SFWKWLBQDHGGNGCYJURLXQNQCDMKGNRB"; //Chuỗi bí mật

        $orderId = time() . "";
        $orderInfo = "Thanh toán qua VNPAY";

        $vnp_TxnRef = $orderId; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = $orderInfo;
        $vnp_OrderType = 'bill payment';
        $vnp_Amount = $total;
        $vnp_Locale = 'VN';
        $vnp_BankCode = 'NCB';
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
       

        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
        

        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
            $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        }

        //var_dump($inputData);
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }
      
        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret); //  
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array(
            'code' => '00', 'message' => 'success', 'payUrl' => $vnp_Url
        );
       
        if (isset($_POST['redirect'])) {
           
            return response()->json($vnp_Url);
            header('Location: ' . $vnp_Url);
            die();
        } else {
            echo json_encode($returnData);
        }
    }
}
