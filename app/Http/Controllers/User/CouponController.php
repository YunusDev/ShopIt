<?php

namespace App\Http\Controllers\User;

use App\Model\User\Coupon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;


class CouponController extends Controller
{
    //

    public function check(){

        $coupon = Coupon::find(1);

        dd($coupon->users->contains(2));
    }

    public function applyCoupon(Request $request){

        $coupon_code = $request->coupon_code;
//        $coupon_code = 'hsJYH8';

        $status = Coupon::where('code', $coupon_code)->exists();

        if(!$status){

            return \GuzzleHttp\json_encode(['valid' => 'No', 'message' => 'Invalid Coupon code!..']);

        }

        $coupon = Coupon::where('code', $coupon_code)->first();

        return strval($coupon->isValid(null, $userId = auth()->id()));

    }

    public function time(){

        $coupon = Coupon::find(2);

//        dd( $coupon->expires_in->isPast());

        dd($coupon->isValid(5, 1));
//        dd($coupon->isValid(4, 2));


    }

    public function store(){

        $coupon = new Coupon;

        $coupon->name = 'Head';

        do{

            $code = str_random(6);

        }while(Coupon::where('code', $code)->first());

        $coupon->code = $code;

        $coupon->description = 'Description...';

        $coupon->expires_in = '2019-09-14 08:10:02';

        $coupon->save();

        $coupon->users()->sync(auth()->id());


    }

}
