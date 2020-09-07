@extends('layouts.admin')

@section('overview')
<div class="container-fluid">
    <div class="row">
        <!-- USER DATA-->
        <div class="user-data m-b-40 col-12">
            <h3 class="title-3 m-b-30">
                <i class="zmdi zmdi-account-calendar"></i>Add Category</h3>
            <div class="col-lg-8 pl-5">
                <form method="POST" action="/category">
                    @csrf

                    <div class="form-group">
                        <label for="product-type">Product Type</label>
                        <input id="product-type" class="au-input au-input--full form-control @error('product-type') is-invalid @enderror" type="text" name="product-type" value="{{ old('product-type') }}" placeholder="product-type">

                        @error('product-type')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <input id="description" class="au-input au-input--full form-control @error('description') is-invalid @enderror" type="text" name="description" value="{{ old('description') }}" placeholder="description">

                        @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group ">
                        <label for="is-active">Is Active</label>
                        <div class="rs-select2--dark rs-select2--sm rs-select2--border">
                            <select id="is-active" class="js-select2 au-select-dark form-control @error('is-active') is-invalid @enderror" name="is-active">
                                <option>--</option>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                            <div class="dropDownSelect2"></div>
                        </div>

                        @error('is-active')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">Add</button>
                </form>
            </div>
            
        </div>
    </div>
<div>
@endsection