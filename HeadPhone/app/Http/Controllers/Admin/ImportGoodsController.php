<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ImportInformation;
use App\Models\Order;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ImportGoodsController extends Controller
{

   
    public function index()
    {
   
        $data = ImportInformation::paginate(5);

        return view('admin.import_goods.index', compact('data'));
    }

    public function create()
    {
        $suppliers = Supplier::all();
        return view('admin.import_goods.create', compact('suppliers'));
    }

    public function store(Request $request)
    {

        $dataCreate = $request->all();

        $dataCreate['user_id'] = Auth::id();
        try {

            $products = $request->products ? json_decode($request->products) : [];
            $importGoods = [];
            $total = 0;

            foreach ($products as $product) {
                $total += $product->price;
                $importGoods[] = ['product_id' => $product->product_id, 'quantity' => $product->quantity, 'price' => $product->price, 'name' => $product->name];
            }

            $dataCreate['total'] = $total;
            $importInfor = ImportInformation::create($dataCreate);
            $importInfor->importedProducts()->createMany($importGoods);


            return redirect()->route('imports.index')->with(['message-success' => 'Thêm dữ liệu thành công']);
        } catch (\Exception $e) {

            Log::error($e->getMessage());

            return back()->withInput()->with(['message-error' => 'Thất bại']);
        }
    }
}
