<?php

namespace App\Http\Controllers;

use App\Products;
use App\Category;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Products::all();
        return view('/dashboard/category/products/products', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('/dashboard/category/products/create', compact('categories'));
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
            'category-id' => 'required|not_in:0',
            'product-name' => 'required',
            'product-price' => 'required',
            'product-image' => ['required', 'image'],
            'product-stock' => 'required',
            'product-live' => 'required|not_in:0',
            'product-location' => 'required',
        ]);

        $product = new Products();
        
        $product->category_id = $data['category-id'];
        $product->product_name = $data['product-name'];
        $product->product_price = $data['product-price'];
        $product->product_image = $data['product-image'];
        $product->product_stock = $data['product-stock'];
        $product->product_live = $data['product-live'];
        $product->product_location = $data['product-location'];
        $product->save();

        return redirect('/products/index')->with('success', 'product added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        $products = $category->products->all();
        // dd($products);
        return view('/dashboard/category/products/show', compact('products'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function edit(Products $products)
    {
        // dd($products);
        $categories = Category::all();
        return view('/dashboard/category/products/edit', compact('products','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Products $products)
    {
        $data = $request->validate([
            'category-id' => 'required|not_in:0',
            'product-name' => 'required',
            'product-price' => 'required',
            'product-image' => 'required|image',
            'product-stock' => 'required',
            'product-live' => 'required|not_in:0',
            'product-location' => 'required',
        ]);

       
        $products->category_id = $data['category-id'];
        $products->product_name = $data['product-name'];
        $products->product_price = $data['product-price'];
        $products->product_image = $data['product-image'];
        $products->product_stock = $data['product-stock'];
        $products->product_live = $data['product-live'];
        $products->product_location = $data['product-location'];
        $products->save();

        return redirect('/products/index')->with('success', 'product Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function destroy(Products $products)
    {
        $products->delete();
        return redirect('/products/index')->with('success', 'Product Deleted');
    }
}
