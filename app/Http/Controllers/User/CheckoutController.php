<?php

namespace App\Http\Controllers\User;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CheckoutController extends Controller
{
    //

    public function index(){

        $carts = Cart::content();

        return view('user.shop.checkout', compact('carts'));

    }
}
