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
            
                <div class="d-flex justify-content-between">
                    <h3 class="title-3 m-b-30">
                        <i class="zmdi zmdi-account-calendar"></i>Product</h3>
                    <div>
                        @if(session('success'))
                            <span class="text-success">{{session('success')}}</span>
                        @endif
                    </div>
                </div>

                <div class="form-group pl-5">
                    <label for="category-id" class="pr-2">Category</label>
                    <div class="rs-select2--dark rs-select2--sm rs-select2--border w-25">
                        <select id="category-id" class="js-select2 au-select-dark form-control @error('category-id') is-invalid @enderror" name="category-id" onchange="window.location.href = '/products/'+this.value">
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->product_type}}</option>
                            @endforeach
                        </select>
                        <div class="dropDownSelect2"></div>
                    </div>
                </div>

                <div class="table-responsive table-data">
                    <table class="table">
                        <thead>
                            <tr>
                                <td></td>
                                <td>Product Name</td>
                                <td>Category</td>
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
                                    <span>{{$product->category->product_type}}</span>
                                </td>
                                <td>
                                    <span>{{$product->product_price}}</span>
                                </td>
                                <td>
                                    <span><img src="/storage/{{$product->product_image}}" alt=""></span>
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

                    <div class="user-data__footer">
                        <button class="">{{$products->links()}}</button>
                    </div>
                </div>
                
            </div>
            <!-- END USER DATA-->
    </div>
</div>
@endsection