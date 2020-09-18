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
                                <li class="list-inline-item">Order</li>
                            </ul>
                        </div>
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
                        <i class="zmdi zmdi-account-calendar"></i>Order</h3>
                    
                </div>

                <div class="form-group pl-5 d-flex justify-content-between">
                    <div class="col-md-6">
                        <label for="category-id" class="pr-2">Time Period</label>
                        <div class="rs-select2--dark rs-select2--sm rs-select2--border w-50">
                            <select id="category-id" class="js-select2 au-select-dark form-control @error('category-id') is-invalid @enderror" name="category-id" onchange="window.location.href = '/order/'+this.value">
                                <option value="index">Time Period</option>
                                <option value="today" @isset($today)
                                    selected='selected'
                                @endisset>Today</option>
                                <option value="week" @isset($week)
                                    selected='selected'
                                @endisset>This Week</option>
                                <option value="month" @isset($month)
                                    selected='selected'
                                @endisset>This Month</option>
                                <option value="year" @isset($year)
                                    selected='selected'
                                @endisset>This Year</option>
                            </select>
                            <div class="dropDownSelect2"></div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <form action="/order/search" class="d-flex" method="post">
                        @csrf
                            <input type="text" class="form-control mr-4" name="username" placeholder="username">
                            <button class="btn btn-danger">search</button>
                        </form>
                    </div>
                </div>

                <div class="table-responsive table-data">
                    <input type="hidden" name="" id="search-username" value="{{$username}}">
                    <div id="order-search-data">
                        @include('dashboard.order.searchPaginate')
                    </div>

                    <div class="user-data__footer">
                        <button class="">
                            <nav aria-label="Page navigation example">
                                <ul class="searchPagination pagination">
                                   
                                    @for($i = 0; $i < $totalPage; $i++)
                                        <li class="page-item @once active @endonce"><a class="page-link" href="/order/searchPaginate?page={{$i}}">{{$i+1}}</a></li>
                                    @endfor
                                   
                                </ul>
                            </nav>
                        </button>
                    </div>
                </div>
            </div>
            <!-- END USER DATA-->
    </div>
</div>
@endsection