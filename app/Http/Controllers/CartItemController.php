<?php

namespace App\Http\Controllers;

use App\CartItem;
use App\Products;
use Illuminate\Http\Request;

class CartItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd(auth()->user()->carts->cartitem()->sum('price')); 
        $cartitems = auth()->user()->carts->cartitem()->get();
        // dd($cartitems);

        return view('ecommerce.cart', compact('cartitems'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Products $products)
    {
        // dd(auth()->user()->carts->id);
        // dd($request->get('product-quantity'));

        $cartItem = new CartItem();

        $cartItem->products_id = $products->id;
        $cartItem->carts_id = auth()->user()->carts->id;
        $cartItem->price = $products->product_price;
        $cartItem->discount = 0;
        $cartItem->quantity = $request->get('product-quantity');
        $cartItem->active = 1;

        $cartItem->save();

        return redirect('/cartitem')->with('success', 'data added to cart');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CartItem  $cartItem
     * @return \Illuminate\Http\Response
     */
    public function show(CartItem $cartItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CartItem  $cartItem
     * @return \Illuminate\Http\Response
     */
    public function edit(CartItem $cartItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CartItem  $cartItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CartItem $cartitem)
    {
        // dd($request->get('product-quantity'));
        $cartItem = CartItem::find($cartitem->id);

        $cartitem->quantity = $request->get('product-quantity');
        $cartitem->save();

        return redirect('/cartitem')->with('success', 'data updated to cart');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CartItem  $cartItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(CartItem $cartitem)
    {
        $cartitem->delete();
        return redirect('/cartitem')->with('deleted', 'data deleted from cart');
    }
}
