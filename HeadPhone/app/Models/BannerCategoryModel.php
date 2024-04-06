<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BannerCategoryModel extends Model
{
    use HasFactory;

    protected $table = 'banners_categories';
    public function banner_store_category($request)
    {
    try {
      // $validatedData = $request->validate([
      //   'title' => 'required|max:255',
      //   'content' => 'required',
      // ]);
      $id = $request->input('id_category');
        //dd($id);
      if ($id) {
        $banner = BannerCategoryModel::find($id);
        $banner->updated_at = date('Y-m-d H:i:s');
      } else {
        $banner = new BannerCategoryModel();
      }
      $banner->name = $request->input('name');
      $banner->ordering = $request->input('ordering');
      $banner->published = $request->input('published');

      $banner->save();
      // Chuyển hướng và hiển thị thông báo thành công  
      return 1;
    } catch (\Exception $e) {
      dd($e);
      // Nếu có lỗi, chuyển hướng với thông báo lỗi
      return 0;
    }
  }
}