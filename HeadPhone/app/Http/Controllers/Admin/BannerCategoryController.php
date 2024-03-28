<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BannerCategoryModel;

class BannerCategoryController extends Controller
{
    public function index(){

        $banner = BannerCategoryModel::orderBy('created_at')->get();
        return view('admin.banner_category.banner_category', compact('banner'));
    }
    public function add(){
        return view('admin.banner_category.banner_category_edit');
    }
    public function edit($id = NULL){
        $banner = BannerCategoryModel::find($id);
                $banner_cate_list = BannerCategoryModel::orderBy('created_at')->get();

        return view('admin.banner_category.banner_category_edit', compact('banner'));
    }

    public function delete($id)
    {
    $record = BannerCategoryModel::find($id);
    if (!$record) {
      return redirect()
        ->route('banner-categories')
        ->withErrors('error', 'Bản ghi không tồn tại');
    }
    $record->delete();
    return redirect()
      ->route('banner-categories')
      ->with('success', 'Bản ghi đã được xoá thành công');
    }
    
    public function banner_store_category(Request $request)
    {
    $banner_cat = new BannerCategoryModel();
    if ($banner_cat->banner_store_category($request)) {
      return redirect()
        ->route('banner-categories')
        ->with('success', 'Them thanh cong');
    } else {
      return redirect()
        ->route('banner-categories')
        ->with('error', 'Có lỗi xảy ra vui lòng thử lại');
    }
  }
}