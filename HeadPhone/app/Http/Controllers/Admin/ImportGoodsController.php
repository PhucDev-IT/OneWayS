<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ImportedProducts;
use App\Models\ImportInformation;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductDetails;
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

    public function showProducts(Request $request){
        $import_id = $request->query('id');

        $products = ImportedProducts::where('import_information_id' , '=' , $import_id)->get();

        return view('admin.import_goods.show_list',compact('products','import_id'));
    }

    //Cộng số lượng sản phẩm đã nhập vào sản phẩm đã có
    public function addQuantityToProduct(Request $request){
        $dataRequest = $request->all();
        $product_detail_id = $dataRequest['color_id'];
        $productDetails = $dataRequest['import_product_id'];
        $import_infor =  $dataRequest['import_infor_id'];

       
        try{
            DB::beginTransaction();

            $import = ImportedProducts::find($productDetails);

            $productDetails = ProductDetails::find($product_detail_id);
            $productDetails->quantity = $productDetails->quantity + $import->quantity;
            $productDetails->save();

            $import->update(['is_import' => true]);

            DB::commit();

            return $this->showProducts($import_infor);
        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            return back()->with(['message-error' => 'Thất bại']);
        }
    }
}
