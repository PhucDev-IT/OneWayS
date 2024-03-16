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
}