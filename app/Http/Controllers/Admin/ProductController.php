<?php

namespace App\Http\Controllers\Admin;

use App\Model\Admin\Admin;
use App\Model\User\Category;
use App\Model\User\Product;
use App\Model\User\ProductPhoto;
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

    public function create(){

        $categories = Category::all();

        $admins = Admin::all();

        return view('admin.product.create', compact( 'categories', 'admins'));

    }

    public function store(Request $request)
    {
        //
//        return $request;

        $this->validate(request(), [

            'name' => 'required|unique:products|max:191',
            'filename' => 'required',
            'filename.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'price' => 'required',
            'quantity' => 'required',
            'category_id' => 'required',
            'admin_id' => 'required',
            'image' => 'required',
            'description' => 'required',

        ]);
        if ($file = $request->file('image')){

            $name = time() . $file->getClientOriginalName();

            $file->move('productCoverImages', $name);

        }

        $product = new Product;

        $product->name = $request->name;
        $product->slug = str_slug($request->name);
        $product->image = $name;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->category_id = $request->category_id;
        $product->admin_id = $request->admin_id;
        $product->brief = $request->brief;
        $product->specs = $request->specs;
        $product->description = $request->description;

        $product->save();

        if($request->hasfile('filename'))
        {
            foreach($request->file('filename') as $image)
            {
                $name=time() . $image->getClientOriginalName();
                $image->move(public_path().'/productPhotos/', $name);
                $data[] = $name;
            }

            foreach ($data as $photo){

                $photos = new ProductPhoto();

                $photos->path = $photo;

                $photos->save();

                $product->productPhotos()->attach($photos->id);

            }
        }


        return back();
    }


    public function show(Product $product)
    {

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
