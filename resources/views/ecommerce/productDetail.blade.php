@extends('layouts.ecommerce')

@section('content')
    <!-- slider Area Start-->
    <div class="slider-area ">
        <!-- Mobile Menu -->
        <div class="d-flex align-items-center">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="hero-cap text-center">
                            <h2>Product Details</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- slider Area End-->

  <!--================Single Product Area =================-->
  <div class="product_image_area">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-12">
          <div class="product_img_slide owl-carousel">
            <div class="single_product_img">
              <img src="/storage/{{$product->product_image}}" alt="" class="img-fluid">
            </div>
          </div>
        </div>
        <div class="col-lg-8">
          <div class="single_product_text text-center">
            <h3>Product Name : {{$product->product_name}}</h3>
            <p>
            Product Description : {{$product->product_description}}
            </p>
            <div class="card_area">
                    <form action="/cartitem/store/{{$product->id}}" method="post">
                    @csrf
                        <div class="product_count_area">
                            <p>Quantity</p>

                            <div class="product_count d-inline-block">
                                <span id="product-decrement" class="product_count_item inumber-decrement"> <i class="ti-minus"></i></span>
                                <input id='total-product' class="product_count_item input-number" type="text" name="product-quantity" value="1" min="0" max="10">
                                <span id="product-increment" class="product_count_item"> <i class="ti-plus"></i></span>
                            </div>

                            <input type="hidden" id="initial-price" value="{{$product->product_price}}">
                            <p>Rs.<span id="show-product-price">{{$product->product_price}}</span></p>   
                        </div>
                        <div class="add_to_cart">
                            <button class="btn_3" type="submit">add to cart</button>
                        </div>
                    </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--================End Single Product Area =================-->
   <!-- subscribe part here -->
   <section class="subscribe_part section_padding">
      <div class="container">
          <div class="row justify-content-center">
              <div class="col-lg-8">
                  <div class="subscribe_part_content">
                      <h2>Get promotions & updates!</h2>
                      <p>Seamlessly empower fully researched growth strategies and interoperable internal or “organic” sources credibly innovate granular internal .</p>
                      <div class="subscribe_form">
                          <input type="email" placeholder="Enter your mail">
                          <a href="#" class="btn_1">Subscribe</a>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </section>
  <!-- subscribe part end -->
@endsection