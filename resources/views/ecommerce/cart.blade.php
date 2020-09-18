@extends('layouts.ecommerce')

@section('content')
  <!-- slider Area Start-->
  <div class="slider-area ">
    <!-- Mobile Menu -->
    <div class="single-slider slider-height2 d-flex align-items-center" data-background="assets/img/hero/category.jpg">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="hero-cap text-center">
                        <h2>Card List</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
  <!-- slider Area End-->
  
  <!--================Cart Area =================-->
  <section class="cart_area section_padding">
    <div class="container">
      <div class="cart_inner">
        <div class="table-responsive">
                
          @if(session('success')) 
            <div class="alert alert-success justify-content-center">
              <span class="text-success">{{session('success')}}</span>
            </div>
          @endif

          @if(session('error')) 
            <div class="alert alert-danger">
              <span class="text-danger">{{session('error')}}</span>
            </div>
          @endif

          @if(session('deleted')) 
            <div class="alert alert-danger">
              <span class="text-danger">{{session('deleted')}}</span>
            </div>
          @endif

          <table class="table" id="app">
            <thead>
              <tr>
                <th scope="col">Product</th>
                <th scope="col">Price</th>
                <th scope="col">Quantity</th>
                <th scope="col">Total</th>
                <th scope="col">Update</th>
                <th scope="col">Remove</th>
              </tr>
            </thead>
            <tbody>
            <input type="hidden" id="total-cartitems" value="{{$cartitems->count()}}">
            @foreach($cartitems as $key => $cartitem)
              <tr>
                <td>
                    <div class="media">
                    <div class="d-flex">
                        <img src="/storage/{{$cartitem->products->product_image}}" alt="" />
                    </div>
                    <div class="media-body">
                        <p>{{$cartitem->products->product_name}}</p>
                    </div>
                    </div>
                </td>
                <td>
                    <h5>{{$cartitem->products->product_price}}</h5>
                </td>
                <td>
                    
                      <div class="product_count">
                        
                        
                        <form action="/cartitem/update/{{$cartitem->id}}" id="update-cart-{{$cartitem->id}}" method="post">
                        @csrf
                        @method('PATCH')
                          <span id="product-decrement-{{$key+1}}" class="product_count_item inumber-decrement"> <i class="ti-minus"></i></span> 
                          <input id='total-product-{{$key+1}}' class="product_count_item input-number" type="text" name="product-quantity" value="{{$cartitem->quantity}}" min="1" max="10">
                          <span id="product-increment-{{$key+1}}" class="product_count_item"> <i class="ti-plus"></i></span>
                        </form>

                        
                      </div>
                    
                </td>
                <td>
                    <input type="hidden" id="initial-price-{{$key+1}}" value="{{$cartitem->products->product_price}}">
                    <h5 id="show-product-price-{{$key+1}}">{{$cartitem->products->product_price * $cartitem->quantity}}</h5>
                </td>
                <td>
                  <div class="btn btn-primary" onclick="document.getElementById('update-cart-{{$cartitem->id}}').submit();">Update</div>
                </td>
                <td>
                  <form action="/cartitem/destroy/{{$cartitem->id}}" method="post">
                    @csrf
                    @method('DELETE')

                    <button class="btn btn-danger" type="submit">Remove</button>
                  </form>
                </td>
              </tr>
               @endforeach 
              <tr class="bottom_button">
                <td>
                  <a class="btn_1" href="#">Update Cart</a>
                </td>
                <td></td>
                <td></td>
                <td>
                  <div class="cupon_text float-right">
                    <a class="btn_1" href="#">Close Coupon</a>
                  </div>
                </td>
              </tr>
              <tr>
                <td></td>
                <td></td>
                <td>
                  <h5>Subtotal</h5>
                </td>
                <td>
                  <h5>$2160.00</h5>
                </td>
              </tr>
              <tr class="shipping_area">
                <td></td>
                <td></td>
                <td>
                  <h5>Shipping</h5>
                </td>
                <td>
                  <div class="shipping_box">
                    <ul class="list">
                      <li>
                        Flat Rate: $5.00
                        <input type="radio" aria-label="Radio button for following text input">
                      </li>
                      <li>
                        Free Shipping
                        <input type="radio" aria-label="Radio button for following text input">
                      </li>
                      <li>
                        Flat Rate: $10.00
                        <input type="radio" aria-label="Radio button for following text input">
                      </li>
                      <li class="active">
                        Local Delivery: $2.00
                        <input type="radio" aria-label="Radio button for following text input">
                      </li>
                    </ul>
                    <h6>
                      Calculate Shipping
                      <i class="fa fa-caret-down" aria-hidden="true"></i>
                    </h6>
                    <select class="shipping_select">
                      <option value="1">Bangladesh</option>
                      <option value="2">India</option>
                      <option value="4">Pakistan</option>
                    </select>
                    <select class="shipping_select section_bg">
                      <option value="1">Select a State</option>
                      <option value="2">Select a State</option>
                      <option value="4">Select a State</option>
                    </select>
                    <input class="post_code" type="text" placeholder="Postcode/Zipcode" />
                    <a class="btn_1" href="#">Update Details</a>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
          <div class="checkout_btn_inner float-right">
            <a class="btn_1" href="#">Continue Shopping</a>
            <a  class="btn_1 checkout_btn_1" href="{{ route('checkout') }}">Proceed to checkout</a>
          </div>
        </div>
      </div>
  </section>

  <script>
      
  </script>
  <!--================End Cart Area =================-->
@endsection