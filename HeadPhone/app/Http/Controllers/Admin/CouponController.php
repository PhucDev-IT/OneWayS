<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Vouchers\VoucherCreateRequest;
use App\Models\User;
use App\Models\Voucher;
use App\Services\VoucherService;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;

class CouponController extends Controller
{

    protected $voucherService;

    public function __construct(VoucherService $service)
    {
        $this->voucherService = $service;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        // $now = Carbon::now();

        // $vouchers = Voucher::where('status', true)
        //     ->where('start_time', '<=', $now)
        //     ->get();
        // $vouchers = Voucher::paginate(5);
        // return response()->json(['vouchers' => $vouchers]);
 
        return view('admin.coupons.index');
    }

    public function fetchCoupon(Request $request) {
        $page = $request['page']?:1;

        $vouchers = Voucher::paginate(5, ['*'], 'page', $page);
        return response()->json(['vouchers' => $vouchers]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.coupons.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(VoucherCreateRequest $request)
    {
    
        if($this->voucherService->store($request)){
            return redirect()->route('vouchers.index')->with(['message-success' => 'Thêm dữ liệu thành công']);
        } else {
            return back()->withInput();
        }

    }
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $voucher = Voucher::where('voucher_id', $id)->first();

        if (!$voucher) {
            // Xử lý trường hợp không tìm thấy voucher
            return redirect()->route('admin.coupons.index');
        }
    
        return view('admin.coupons.edit', compact('voucher'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $voucher = Voucher::find($id);

        if ($voucher != null) {
            $voucher->update(['is_use' => false]);

            return response()->json(["success"=>"Cập nhật thành công"],200);
        }
    }
}
