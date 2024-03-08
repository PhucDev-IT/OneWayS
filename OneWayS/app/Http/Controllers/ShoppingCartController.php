<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShoppingCartController extends Controller
{
    //
   

    public function addToCart(Request $request){
        $idProduct = $request['idProduct'];
        $quantity = $request['quantity']??1;
        $color = $request['color'];
        dd('hello');
    }
}
