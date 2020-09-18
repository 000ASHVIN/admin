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
                                <li class="list-inline-item active">
                                    <a href="/products/index">Product</a>
                                </li>
                                <li class="list-inline-item seprate">
                                    <span>/</span>
                                </li>
                                <li class="list-inline-item">{{$category->product_type}}</li>
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
                    
                <div class="table-responsive table-data" id="products-list">
                        @include('dashboard.category.products.paginate')

                </div>

                <div class="user-data__footer">
                <button class="">
                    <nav aria-label="Page navigation example">
                        <ul class="productPagination pagination">
                            <!-- <li class="page-item prev"><a class="page-link" href="/paginate/{{$category->id}}?page=0" id="prev-product"><i class="fas fa-arrow-left"></i></a></li> -->
                            @for($i = 0; $i < $totalPage; $i++)
                                <li class="page-item @once active @endonce"><a class="page-link" href="/paginate/{{$category->id}}?page={{$i}}">{{$i+1}}</a></li>
                            @endfor
                            <!-- <li class="page-item next"><a class="page-link" href="/paginate/{{$category->id}}?page=1" id="next-product"><i class="fas fa-arrow-right"></i></a></li> -->
                        </ul>
                    </nav>
                </button>
                </div>
                
            </div>
            <!-- END USER DATA-->
    </div>
</div>
@endsection