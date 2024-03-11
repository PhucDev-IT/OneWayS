<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Cart;
use App\Models\CartDetails;
use App\Models\Voucher;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ShoppingCartController extends Controller
{
    private string $token = "52a73b2a-d2d4-11ee-893f-b6ed573185af";

    public function index()
    {
        $id = Auth::id();
        $cart = Cart::find($id);

        if ($cart) {
            $carts = $cart->load('cartDetails');
        }

        return view('shopping_cart', compact('carts'));
    }

    public function addToCart(Request $request)
    {

        try {

            $idProduct = $request['idProduct'];
            $quantity = $request['quantity'] ?? 1;
            $color = $request['color'];

            $idUser = Auth::id();

            $cart = Cart::where('user_id', $idUser)->first();

            if ($cart == null) {
                // Nếu Cart chưa tồn tại, tạo mới
                $cart = Cart::create(['user_id' => $idUser]);
            }

            // Kiểm tra xem sản phẩm có sẵn trong giỏ hàng không
            $cartDetail = CartDetails::where('cart_id', $cart->id)
                ->where('color', $color)
                ->where('product_id', $idProduct)
                ->first();

            if ($cartDetail != null) {
                // Nếu sản phẩm đã có trong giỏ hàng, cập nhật số lượng
                $cartDetail->quantity += $quantity;
                $cartDetail->save();
            } else {
                // Nếu sản phẩm chưa có trong giỏ hàng, tạo mới CartDetails
                CartDetails::create([
                    'cart_id' => $cart->id,
                    'color' => $color,
                    'quantity' => $quantity,
                    'product_id' => $idProduct
                ]);
            }
            $request->session()->put('cart-count', $request->session()->get('cart-count', 0) + 1);
            return response()->json(['success' => "Thêm thành công"], 200);
        } catch (QueryException $e) {
            Log::error($e->getMessage()); // Ghi thông điệp lỗi vào tệp nhật ký
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    //Cập nhật số lượng sản phẩm khi thay đổi
    public function updateQuantity(Request $request)
    {
        $cartId = $request['idCart'];
        $newQuantity = $request['quantity'] ?? 1;

        try {
            $cart = CartDetails::findOrFail($cartId);
            $cart->quantity = $newQuantity;
            $cart->save();

            return response()->json(['cart_count' => $newQuantity]);
        } catch (\Exception $e) {
            Log::error($e->getMessage()); // Ghi thông điệp lỗi vào tệp nhật ký
            return response()->json(['error' => 'Cập nhật số lượng sản phẩm thất bại.'], 500);
        }
    }

   
    ///Lấy tất cả voucher người dùng chưa sử dụng
    function getVouchers() {
        $now = now();
        $userId = 1;
    
        $vouchers = DB::table('vouchers')
            // ->where('start_time', '>', $now)
            // ->where('end_time', '<', $now)
            ->where('quantity', '>', 0)
            ->where(function ($query) use ($userId) {
                $query->whereNull('vouchers.user_id')
                      ->orWhere('vouchers.user_id', $userId);
            })
            ->leftJoin('orders', function ($join) use ($userId) {
                $join->on('vouchers.voucher_id', '=', 'orders.voucher_id')
                     ->where('orders.user_id', $userId);
            })
            ->whereNull('orders.voucher_id')
            ->select('vouchers.*')
            ->get();
 
        return response()->json($vouchers);
    }
    
    public function getTransportUnits(Request $request)
    {
        $headers = [
            'Token' => $this->token
        ];

        $data = [
            'shop_id' => 4914423,
            "from_district" => 1616,
            'to_district' => $request['to_district']
        ];
        $response = Http::retry(3, 100)->withHeaders($headers)->get('https://online-gateway.ghn.vn/shiip/public-api/v2/shipping-order/available-services', $data);

        $statusCode = $response->status();
        if ($statusCode == 200) {
            $responseBody = json_decode($response->getBody(), true);
            $data = $responseBody;
            return response()->json($data);
        }
    }

    public function calculateFee(Request $request)
    {

        $headers = [
            'Token' => $this->token,
            'ShopId' => 4914423,
            'Content-Type' => 'application/json',
        ];

        $data = [
            "from_district_id" => 1454,
            "from_ward_code" => "21211",
            "service_id" => 53320,
            "service_type_id" => null,
            "to_district_id" => 1452,
            "to_ward_code" => "21012",
            "height" => 50,
            "length" => 20,
            "weight" => 200,
            "width" => 20,
            "insurance_value" => 10000,
            "cod_failed_amount" => 2000,
            "coupon" => null
        ];

        $response = Http::retry(3, 100)->withHeaders($headers)->post('https://online-gateway.ghn.vn/shiip/public-api/v2/shipping-order/fee', $data);

        $statusCode = $response->status();
        if ($statusCode == 200) {
            $responseBody = json_decode($response->getBody(), true);
            $data = $responseBody;
            return response()->json($data);
        }
    }






   
}
