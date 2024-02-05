<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Categories\CreateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $category;

    public function __construct(Category $cate)
    {
        $this->category = $cate;
    }

    public function index()
    {
       $categories = $this->category->withCount('products')->paginate(10);
        return view('admin.categories.index',compact('categories'));
    }

    public function create()
    {
      
        return view('admin.categories.create');
    }

    public function store(CreateCategoryRequest $request)
    {
        try {
            $createData = $request->all();
           $this->category->create($createData);
            // Chuyển hướng về trang tạo mới vai trò với thông báo thành công
            return redirect()->route('categories.index')->with(['message-success' => 'Thêm thành công']);
        } catch (\Exception $e) {
            // Xử lý nếu có lỗi
            $errorMessage = $e->getMessage();
    
            // Chuyển hướng về trang tạo mới vai trò với thông báo lỗi
            return redirect()->route('categories.index')->with(['message-error' => $errorMessage]);
        }
    }
}
