<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
class MenuController extends Controller
{
    public function index(){
        $menu = Category::orderBy('created_at')->get();
        return view('admin.menu.menu_cate_product', compact('banner'));
    }
}