<?php

namespace App\Http\Controllers\User;

use App\MOdel\User\Order;
use App\MOdel\User\OrderItem;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Null_;

class OrderController extends Controller
{
    //

    public function store(Request $request){

        $order = new Order;
//        $order->transaction_id = $charge->id;
        $order->willPaylater = $request->order['paylater'];
        $order->phone = $request->order['phone'];
        $order->name = $request->order['name'];
        $order->email = $request->order['email'];
        $order->address = $request->order['address'];
        $order->state = $request->order['state'];
        $order->local_govt = $request->order['local_govt'];
        $order->comment = $request->order['comment'];

        $order->total_price = $request->total_price;
        $order->coupon_id = $request->coupon['message']['id'];



        if (Auth::check()){

            $user = Auth::user();

            $order->user_id = auth()->id();

            if($request->order['phone']){

                $user->profile->phone = $request->order['phone'];
            }
            if($request->order['address']){

                $user->profile->address = $request->order['address'];
            }
            if($request->order['state']){

                $user->profile->state =$request->order['state'];
            }
            if($request->order['local_govt']){

                $user->profile->local_govt = $request->order['local_govt'];
            }

            $user->profile->save();

        }

        $order->save();

        foreach (Cart::content() as $item) {
            $orderItem = new OrderItem;
            $orderItem->name = $item->name;
            $orderItem->unit_price = $item->price;
            $orderItem->quantity = $item->qty;

            $order->orderItems()->save($orderItem);
        }

        Cart::destroy();

        return $order;


    }
}
