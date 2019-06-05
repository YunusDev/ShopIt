<?php

namespace App\Http\Controllers\Admin;

use App\Model\Admin\InvestmentBatch;
use App\Model\Admin\Merchant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MerchantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(){

        $this->middleware('auth:admin');

    }

    public function batches($named){

        $merchant = Merchant::where('name', $named)->first();

        $batches = $merchant->batches;

        return view('admin.merchant.batches', compact('batches', 'merchant'));

    }


    public function index()
    {
        //
        $merchants = Merchant::all();

        return view('admin.merchant.index', compact('merchants'));

    }

    public function store(Request $request)
    {
        //
        $this->validate(request(), [

            'name' => 'required|unique:merchants',
            'email' => 'required',
            'state' => 'required',
            'country' => 'required'

        ]);

        return Merchant::create($request->all());
    }


    public function show(Merchant $merchant)
    {

        return view('admin.merchant.plans', compact('merchant'));
    }


    public function update(Merchant $merchant, Request $request)
    {
        //

        $this->validate(request(), [

            'name' => 'required',
            'email' => 'required',
            'state' => 'required',
            'country' => 'required'

        ]);

         $merchant->update($request->all());

        return $merchant->fresh();
    }

    public function destroy(Merchant $merchant)
    {
        //
        $merchant->delete();

        return response()->json('ok');
    }
}
