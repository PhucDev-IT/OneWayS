<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class BannerModel extends Model
{
    use HasFactory;
    protected $table = 'banners';
    public function banner_store($request)
    {
    try {

      $id = $request->input('id');
        //dd($id);
      if ($id) {
        $banner = BannerModel::find($id);
        $banner->updated_at = date('Y-m-d H:i:s');
      } else {
        $banner = new BannerModel();
      }
      $banner->name = $request->input('name');
      $banner->parent_id = $request->input('parent_id');
      if(@$request->file('img_preview')){
        $banner->image = $request->file('img_preview')->store('public/images/banner');
      }
      //$banner->image = $request->input('image');
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
  public function banner_cate():HasOne
  {
    return $this->hasOne(BannerCategoryModel::class, 'id', 'parent_id');
  }
    
}   