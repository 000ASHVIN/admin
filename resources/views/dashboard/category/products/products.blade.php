@extends('layouts.admin')

@section('overview')
<!-- BREADCRUMB-->
<section class="au-breadcrumb m-t-75">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="au-breadcrumb-content">
                        <div class="au-breadcrumb-left">
                            <span class="au-breadcrumb-span">You are here:</span>
                            <ul class="list-unstyled list-inline au-breadcrumb__list">
                                <li class="list-inline-item active">
                                    <a href="/dashboard/index">Home</a>
                                </li>
                                <li class="list-inline-item seprate">
                                    <span>/</span>
                                </li>
                                <li class="list-inline-item">Products</li>
                            </ul>
                        </div>
                        <button class="au-btn au-btn-icon au-btn--green" onclick="window.location.href ='/products/create' ">
                            <i class="zmdi zmdi-plus"></i>add product</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END BREADCRUMB-->

<div class="container-fluid">
    <div class="row">
            <!-- USER DATA-->
            <div class="user-data m-b-40 col-12">
                <h3 class="title-3 m-b-30">
                    <i class="zmdi zmdi-account-calendar"></i>Product</h3>
                <div class="table-responsive table-data">
                    <table class="table">
                        <thead>
                            <tr>
                                <td></td>
                                <td>Product Name</td>
                                <td>Product Price</td>
                                <td>Product Image</td>
                                <td>Product Stock</td>
                                <td>Product Live</td>
                                <td>Product Location</td>
                            </tr>
                        </thead>
                        @foreach($products as $product)
                        <tbody>
                            <tr>
                                <td>
                                    <label class="au-checkbox">
                                        <input type="checkbox">
                                        <span class="au-checkmark"></span>
                                    </label>
                                </td>
                                <td>
                                    <span>{{$product->product_name}}</span>
                                </td>
                                <td>
                                    <span>{{$product->product_price}}</span>
                                </td>
                                <td>
                                    <span>{{$product->product_image}}</span>
                                </td>
                                <td>
                                    <span>{{$product->product_stock}}</span>
                                </td>
                                <td>
                                    <span>{{$product->product_live}}</span>
                                </td>
                                <td>
                                    <span>{{$product->product_location}}</span>
                                </td>
                                <td>
                                    <a href="/products/{{$product->id}}/edit" class="btn btn-primary">Edit</a>
                                </td>
                                <td>
                                    <form action="/products/{{$product->id}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger" type="submit">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        </tbody>
                        @endforeach
                    </table>
                </div>
                <div class="user-data__footer">
                    <button class="au-btn au-btn-load">load more</button>
                </div>
            </div>
            <!-- END USER DATA-->
    </div>
</div>
@endsection