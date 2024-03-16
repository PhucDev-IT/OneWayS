<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BannerModel;
//use App\Models\BannerModel as ModelsBannerModel;

class BannerController extends Controller
{
    public function index(){
        $banner = BannerModel::orderBy('created_at')->get();
        return view('admin.banner.banners', compact('banner'));
    }
}