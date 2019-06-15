<?php

namespace App\Http\Controllers;

use App\Model\User\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

        $this->middleware('auth')->except('index', 'test');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $products = Product::latest()->get();

//        return $products;
//
        return view('welcome', compact('products'));
    }

    public function test(){

//        $carts = Cart::content();
        Cart::destroy();
//        $carts = Cart::remove('eef12573176125ce53e333e13d747a17');

//        $arr = [];
//
//        foreach ($carts as $key  => $cart){
//
//            array_push($arr, $cart);
//
//        }

//        return $carts;
    }
}
