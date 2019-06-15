<?php

namespace App\Http\Controllers\Admin;

use App\Model\Admin\Admin;
use App\Model\User\Category;
use App\Model\User\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function index()
    {
        //
        $products = Product::with('category')->get();

        $categories = Category::all();

        $admins = Admin::all();

        return view('admin.product.index', compact('products', 'categories', 'admins'));

    }

    public function store(Request $request)
    {
        //
        $this->validate(request(), [

            'name' => 'required|unique:products|max:191',
            'price' => 'required',
            'quantity' => 'required',
            'category_id' => 'required',
            'admin_id' => 'required',
//            'image' => 'required',
            'description' => 'required',

        ]);
        if ($file = $request->file('image')){

            $name = time() . $file->getClientOriginalName();

            $file->move('productCoverImages', $name);
            $request['image'] = $name;


        }
        $request['slug'] = str_slug($request->name);

        return Product::create($request->all());
    }


    public function show(Product $product)
    {

        return view('admin.merchant.plans', compact('product'));
    }


    public function update(Product $product, Request $request)
    {
        //

        $this->validate(request(), [

            'name' => 'required|unique:products|max:191',
            'price' => 'required',
            'quantity' => 'required',
            'category_id' => 'required',
            'admin_id' => 'required',
//            'image' => 'required',
            'description' => 'required',

        ]);

        $request['slug'] = str_slug($request->name);

        $product->update($request->all());

        return $product->fresh();
    }

    public function destroy(Product $product)
    {
        //
        $product->delete();

        return response()->json('ok');
    }
}
