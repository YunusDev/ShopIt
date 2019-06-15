<?php

namespace App\Http\Controllers\User;

use App\Model\User\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Psy\Util\Json;
use Symfony\Component\HttpFoundation\Tests\JsonSerializableObject;

class ProductController extends Controller
{
    //

    public function show($slug){

        $product = Product::with('category')->where('slug', $slug)->first();

        return view('user.shop.single', compact('product'));

    }

    public function cart(){

        $cartings = Cart::content();

        $carts = [];

        foreach ($cartings as $key  => $cart){

            $cart->name = str_replace(' ', '-', $cart->name);;

            array_push($carts, $cart);

        }

        $carts = json_encode($carts);

        return view('user.shop.cart', compact('product', 'carts'));

    }

    public function addToCart(Request $request)
    {
        $product = Product::find($request->product_id);

        $quantity = $request->quantity;

        if ($quantity > $product->quantity) {
            return response()->json([
                'message' => "There are only {$product->quantity} left in stock"
            ], 419);
        }

        Cart::add($product->id, $product->name, $quantity, $product->price);

        return response()->json([
            'message' => 'Item added to cart.',
            'cartTotal' => Cart::count()
        ], 200);
    }

    public function updateItemCart(Request $request){

        Cart::update($request->rowId, $request->quantity);

        return response()->json([
            'message' => 'Item Updated from cart.',
            'cartTotal' => Cart::count()
        ], 200);

    }

    public function deleteItemCart(Request $request){

        Cart::remove($request->rowId);

        return response()->json([
            'message' => 'Item Removed from cart.',
            'cartTotal' => Cart::count()
        ], 200);

    }

}
