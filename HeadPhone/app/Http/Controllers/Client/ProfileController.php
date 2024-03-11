<?php

namespace App\Http\Controllers\Client;
use GuzzleHttp\Client;
use App\Http\Controllers\Controller;
use App\Http\Requests\Profiles\CreateAddressRequest;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
{
    private string $token = "52a73b2a-d2d4-11ee-893f-b6ed573185af";
    private string $base_url = "https://online-gateway.ghn.vn/shiip/public-api/master-data/";

    public function index() {
        $user = Auth::user();
        return view('client.information_user',compact('user'));
    }

    public function fetchAddress(){
        $idU = Auth::id();
        $addresses  = Address::where('user_id','=' ,$idU)->get();
        return view('client.show_address',compact('addresses'));
    }

    public function createAddress(){
        return view('client.create_address');
    }

    public function callProvinces(){
        $headers = [
            'Token' => $this->token
        ];
        $response = Http::retry(3, 100)->withHeaders($headers)->get('https://online-gateway.ghn.vn/shiip/public-api/master-data/province');
        
        $statusCode = $response->status(); 
        if ($statusCode == 200) {
            $responseBody = json_decode($response->getBody(), true);
            $data = $responseBody;
            return response()->json([
                'provinces' => $data
            ]); 
        }
   
    }

    public function callDistricts($province_id)
    {
        $headers = [
            'Token' => $this->token
        ];

        $data = [
            'province_id' => $province_id,
        ];
        $response = Http::retry(3, 100)->withHeaders($headers)->get('https://online-gateway.ghn.vn/shiip/public-api/master-data/district',$data);
        
        $statusCode = $response->status(); 
        if ($statusCode == 200) {
            $responseBody = json_decode($response->getBody(), true);
            $data = $responseBody;
            return response()->json([
                'districts' => $data
            ]); 
        }
    }

    public function callWards($district_id) {
        $headers = [
            'Token' => $this->token
        ];

        $data = [
            'district_id' => $district_id,
        ];
        $response = Http::retry(3, 100)->withHeaders($headers)->get('https://online-gateway.ghn.vn/shiip/public-api/master-data/ward?district_id',$data);
        
        $statusCode = $response->status(); 
        if ($statusCode == 200) {
            $responseBody = json_decode($response->getBody(), true);
            $data = $responseBody;
            return response()->json([
                'wards' => $data
            ]); 
        }
    }


    public function storeAddress(CreateAddressRequest $request){
        $data = $request->all();
        try{
            $idUser = Auth::id();
            $data['user_id'] = $idUser;
        
            $address = Address::create($data);
            $this->fetchAddress();
        } catch (\Exception $e) {
            // Xử lý nếu có lỗi
            $errorMessage = $e->getMessage();
            Log::error($e->getMessage());
            // Có thể log lỗi hoặc trả về thông báo lỗi cho người dùng
            return back()->withInput();
        }
        
    }
}
