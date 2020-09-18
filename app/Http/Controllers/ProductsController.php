<?php

namespace App\Http\Controllers;

use App\Products;
use App\Category;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Products::paginate(4);
        $categories = Category::all();
        return view('/dashboard/category/products/products', compact('products', 'categories'));
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
            'product-discription' => 'required',
            'product-price' => 'required',
            'product-image' => ['required', 'image'],
            'product-stock' => 'required',
            'product-live' => 'required|not_in:0',
            'product-location' => 'required',
        ]);


        
        $image = $data['product-image']->store('Products','public');
        // dd($image);
        
        $imagePath = 'storage/'.$image;
        // dd($imagePath);

        $editImage = Image::make($imagePath)->fit(1200,1200);
        $editImage->save();
        
        $product = new Products();
        
        $product->category_id = $data['category-id'];
        $product->product_name = $data['product-name'];
        $product->product_discription = $data['product-discription'];
        $product->product_price = $data['product-price'];
        $product->product_image = $image;
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
        
        $totalProducts = count($products);
        $totalPage = intval(($totalProducts+4-1)/4); 
        $products = collect($products)->slice(0,4);
        // dd($products);
        $currentPage = 0;
       
        return view('/dashboard/category/products/show', compact('products', 'category', 'totalPage', 'currentPage'));
    }

    public function paginateProducts(Request $request, $paginate)
    {

        $category = Category::find($paginate);
        // if($request->ajax()) {
            $products = $category->products->all();

            $currentPage = LengthAwarePaginator::resolveCurrentPage();

            $perPage = 4;

            $products = collect($products)->slice(($currentPage * $perPage)-$perPage,$perPage);

        
            return view('/dashboard/category/products/paginate', compact('products', 'category', 'currentPage'))->render();
        // }
        
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
        // dd($request->file('product-image'));
        
        
        $data = $request->validate([
            'category-id' => 'required|not_in:0',
            'product-name' => 'required',
            'product-discription' => 'required',
            'product-price' => 'required',
            'product-image' => '',
            'product-stock' => 'required',
            'product-live' => 'required|not_in:0',
            'product-location' => 'required',
        ]);

        

        $products->category_id = $data['category-id'];
        $products->product_name = $data['product-name'];
        $products->product_discription = $data['product-discription'];
        $products->product_price = $data['product-price'];

        if($request->file('product-image')) {

            $image = $data['product-image']->store('Products','public');
       
            $imagePath = 'storage/'.$image;

            $editImage = Image::make($imagePath)->fit(1200,1200);
            $editImage->save();

            $products->product_image = $image;
        }

        
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
