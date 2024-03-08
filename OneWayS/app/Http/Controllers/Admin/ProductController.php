<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Products\CreateProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use App\Services\ProductService;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;

class ProductController extends Controller
{

    private $productService;


    public function __construct(ProductService $proService)
    {
        $this->productService = $proService;
    }

    public function index()
    {
        $categories = Category::all();
        return view('admin.products.index',compact('categories'));
    }

    public function fetchProducts(Request $request)  {
        $page = $request['page']?:1;
    
        // Xử lý logic lấy danh sách sản phẩm ở trang $page từ database hoặc bất kỳ nguồn dữ liệu nào khác
        $products = Product::paginate(5, ['*'], 'page', $page);
    
        return response()->json([
            'products' => $products
        
        ]);
      
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $suppliers = Supplier::all();
        return view('admin.products.create', compact('categories','suppliers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->productService->store($request);
        return redirect()->route('products.index')->with(['message-success' => 'create product success']);
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

        $product =  $this->productService->findOrFail($id)->load(['details', 'categories', 'images']);
        $categories = Category::get(['id', 'name']);

        return view('admin.products.edit', compact('categories', 'product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if ($this->productService->update($request, $id)) {
            return redirect()->route('products.index')->with(['message-success' => 'Update product success']);
        } else {
            return back()->withInput()->with(['message-error' => 'Update product error']);
        }
    }

    #1.Nếu người dùng không nhập input, chỉ chọn danh mục
     #2.Nhập dữ liệu và danh mục == '0'
     #3.Nhập dữ liệu và danh mục !== '0'
    public function search(Request $request)
    {
        // Nhận dữ liệu từ form tìm kiếm
        $searchQuery = $request->input('name')??'';
        $categoryId = $request->input('category')??0;

        $products = [];



        if($categoryId !== '0'){
            $products = Product::where('name', 'LIKE', '%' . $searchQuery . '%')->where('isSelling','1')->whereHas('categories', function ($query) use ($categoryId) {
                $query->where('id', $categoryId);
            })->paginate(8);

        }else{
  
            $products = Product::where('name', 'LIKE', '%' . $searchQuery . '%')->paginate(8);
        }
        
        $categories = Category::all();
        return response()->json([
            'products' => $products
        
        ]);
       // return view('admin.products.index', compact('products', 'categories'));
    }


    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
