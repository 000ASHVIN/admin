@extends('layouts.admin')

@section('overview')
<div class="container-fluid">
    <div class="row">
        <!-- USER DATA-->
        <div class="user-data m-b-40 col-12">
            <h3 class="title-3 m-b-30">
                <i class="zmdi zmdi-account-calendar"></i>Add Product</h3>
            <div class="col-lg-8 pl-5">
                <form method="POST" action="/products" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group d-grid">
                        <label for="category-id">Category</label>
                        <div class="rs-select2--dark rs-select2--sm rs-select2--border d-block w-25">
                            <select id="category-id" class="js-select2 au-select-dark form-control @error('category-id') is-invalid @enderror" name="category-id">
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->product_type}}</option>
                            @endforeach
                            </select>
                            <div class="dropDownSelect2"></div>

                            @error('category-id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                    </div>

                    <div class="form-group">
                        <label for="product-name">Product Name</label>
                        <input id="product-name" class="au-input au-input--full form-control @error('product-name') is-invalid @enderror" type="text" name="product-name" value="{{ old('product-name') }}" placeholder="product-name">

                        @error('product-name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="product-discription">Product Name</label>
                        <input id="product-discription" class="au-input au-input--full form-control @error('product-discription') is-invalid @enderror" type="text" name="product-discription" value="{{ old('product-discription') }}" placeholder="product-discription">

                        @error('product-discription')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="product-price">Product Price</label>
                        <input id="product-price" class="au-input au-input--full form-control @error('product-price') is-invalid @enderror" type="number" name="product-price" value="{{ old('product-price') }}" placeholder="product-price">

                        @error('product-price')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="product-image">Product Image</label>
                        <input id="product-image" class="au-input au-input--full form-control border-0 p-0 @error('product-image') is-invalid @enderror" type="file" name="product-image" value="{{ old('product-image') }}" placeholder="product-image">

                        @error('product-image')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="product-stock">Product Stock</label>
                        <input id="product-stock" class="au-input au-input--full form-control @error('product-stock') is-invalid @enderror" type="number" name="product-stock" value="{{ old('product-stock') }}" placeholder="product-stock">

                        @error('product-stock')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group ">
                        <label for="product-live">Product Live</label>
                        <div class="rs-select2--dark rs-select2--sm rs-select2--border d-block w-25">
                            <select id="product-live" class="js-select2 au-select-dark form-control @error('product-live') is-invalid @enderror" name="product-live">
                                <option value="">Select</option>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                            <div class="dropDownSelect2"></div>
                            @error('product-live')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="product-location">Product Location</label>
                        <input id="product-location" class="au-input au-input--full form-control @error('product-location') is-invalid @enderror" type="text" name="product-location" value="{{ old('product-location') }}" placeholder="product-location">

                        @error('product-location')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">Add</button>
                    <a href="/products/index">Back</a>
                </form>
            </div>
            
        </div>
    </div>
<div>
@endsection