<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use App\Products;
use App\Category;

class EcommerceController extends Controller
{

    // protected $redirectTo = RouteServiceProvider::ECOMMERCE;

    public function index() {
        $products = Products::all();
        return view('/ecommerce/index', compact('products'));
    }

    public function showCategory() {
        $products = Products::all();
        $categories = Category::all();
        return view('/ecommerce/category', compact('categories', 'products'));
    }

    public function show(Products $products) {
        $product = $products;
        $categories = Category::all();
        return view('/ecommerce/productDetail', compact('categories', 'product'));
    }

    public function showCategoryProduct(Category $category) {
        $products = $category->products;
        // dd($products);
        $selectedCategory = $category;
        $categories = Category::all();
        return view('/ecommerce/category', compact('categories', 'products', 'selectedCategory'));
    }

    public function login(Request $request)
    {

        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required'],
        ]);
           
        // dd($credentials);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication passed...
            return redirect('/ecommerce');
        }
        return redirect('/ecommerce/login')->with('error', 'credentials are wrong');
    }

    public function logout(Request $request)
    {
        if(\Auth::check())
        {
            \Auth::logout();
            $request->session()->invalidate();
        }
        return  redirect('/ecommerce/login');
    }
}
