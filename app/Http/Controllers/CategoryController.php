<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('dashboard.category.category', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $data = $request->validate([
            'product-type' => 'required',
            'description' => 'required',
            'is-active' => 'required',
        ]);

            // dd($data);

        $category = new Category();
        $category->product_type = $data['product-type'];
        $category->description = $data['description'];
        $category->updated_by = "" ;
        $category->is_active = intval($data['is-active']);

        $category->save();

        return redirect('/dashboard/category')->with('success','category added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('/dashboard/category/edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        // dd($category);
        $data = $request->validate([
            'product-type' => 'required',
            'description' => 'required',
            'is-active' => 'required',
        ]);

            // dd($data);

        $category->product_type = $data['product-type'];
        $category->description = $data['description'];
        $category->updated_by = "" ;
        $category->is_active = intval($data['is-active']);

        $category->save();

        return redirect('/dashboard/category')->with('success','category updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect('/dashboard/category')->with('success','category deleted');
    }
}
