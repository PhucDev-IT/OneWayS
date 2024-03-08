<?php

namespace App\Services;

use App\Models\User;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Carbon\Carbon;
use GuzzleHttp\Promise\Create;

class VoucherService
{


    public function store($request)
    {
        try {
            $dataRequest = $request->all();

            $result = Voucher::create($dataRequest);
            return true;
        } catch (\Exception $e) {
            // Xử lý nếu có lỗi
            $errorMessage = $e->getMessage();
            var_dump($errorMessage);
            die;
            session()->flash('message-error', $errorMessage);
            return false;
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
        $voucher = Voucher::findOrFail($id);
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
        //
    }
}
