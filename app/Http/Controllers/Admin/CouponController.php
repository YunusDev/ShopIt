<?php

namespace App\Http\Controllers\Admin;

use App\Model\User\Coupon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CouponController extends Controller
{
    //

    public function index(){

        $coupons = Coupon::latest()->get();

        return view('admin.coupon.index', compact('coupons'));

    }

    public function store(Request $request)
    {
        //
//        dd($request);

        $this->validate(request(), [

            'name' => 'required|max:191',
            'description' => 'required',
            'type' => 'required',
            'discount' => 'required',

        ]);

        $coupon = new Coupon;

        $coupon->name = $request->name;

        do{

            $code = str_random(6);

        }while(Coupon::where('code', $code)->first());

        $coupon->code = strtolower($code);

        $coupon->description = $request->description;
        $coupon->type = $request->type;
        $coupon->discount = $request->discount;
        $coupon->max_usage = $request->max_usage;
        $coupon->remaining = $request->max_usage;

        $date = date_create($request->expires_in);
        $coupon->expires_in = date_format($date, 'Y-m-d H:i:s');
        $coupon->will_expire = $request->will_expire;
        $coupon->status = $request->status;

        $coupon->save();

//        $coupon->users()->sync(auth()->id());

        return $coupon;

//        return response()->json('ok');

    }

    public function update(Coupon $coupon, Request $request)
    {
        //

        $this->validate(request(), [

            'name' => 'required|max:191',
            'description' => 'required',
            'type' => 'required',
            'discount' => 'required',

        ]);


        $coupon->name = 'Head';

        $coupon->description = 'Description...';

        $coupon->expires_in = '2019-09-14 08:10:02';

        $coupon->save();

        return $coupon->fresh();
    }


    public function destroy(Coupon $coupon)
    {
        //
        $coupon->delete();

        return response()->json('ok');
    }
}
