<?php

namespace App\Http\Controllers\Admin;

use App\MOdel\User\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index()
    {
        //
        $categories = Category::all();

        return view('admin.category.index', compact('categories'));

    }

    public function store(Request $request)
    {
        //
        $this->validate(request(), [

            'name' => 'required|unique:categories|max:191',
            'description' => 'required',

        ]);

        $request['slug'] = str_slug($request->name);

        return Category::create($request->all());
    }


    public function show(Category $category)
    {

        return view('admin.merchant.plans', compact('category'));
    }


    public function update(Category $category, Request $request)
    {
        //

        $this->validate(request(), [

            'name' => 'required|max:191',
            'description' => 'required',

        ]);

        $request['slug'] = str_slug($request->name);

        $category->update($request->all());

        return $category->fresh();
    }

    public function destroy(Category $category)
    {
        //
        $category->delete();

        return response()->json('ok');
    }
}
