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
                                <li class="list-inline-item">Order Details</li>
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
                        <i class="zmdi zmdi-account-calendar"></i>Order Details</h3>
                    
                </div>

                <div class="pl-4">
                    <table class="table">
                        <tr class="border-bottom-0">
                            <td class="font-weight-bold">Amount:</td>
                            <td class="">${{$invoice->price}}</td>
                        </tr>
                        <tr class="border-bottom-0">
                            <td class="font-weight-bold">Payment Id:</td>
                            <td class="">{{$invoice->payment_id}}</td>
                        </tr>
                        <tr class="border-bottom-0">
                            <td class="font-weight-bold">Customer Email:</td>
                            <td class="">{{$invoice->customer_email}}</td>
                        </tr>
                        <tr class="border-bottom-0">
                            <td class="font-weight-bold">Customer Id:</td>
                            <td class="">{{$invoice->customer_id}}</td>
                        </tr>
                        <tr class="border-bottom-0">
                            <td class="font-weight-bold">Country Code:</td>
                            <td class="">{{$invoice->country_code}}</td>
                        </tr>
                        <tr class="border-bottom-0">
                            <td class="font-weight-bold">Currency:</td>
                            <td class="">{{$invoice->currency}}</td>
                        </tr>
                        <tr class="border-bottom-0">
                            <td class="font-weight-bold">Payment Status:</td>
                            <td class="">{{$invoice->payment_status}}</td>
                        </tr>
                    </table>
                </div>

                <div class="table-responsive table--no-card m-b-30">
                    
                    <table class="table table-borderless table-striped table-earning">
                        <thead>
                            <tr>
                                <th>Order Id</th>
                                <th>Product Name</th>
                                <th>Product Price</th>
                                <th>Product Quantity</th>
                                <th>Created</th>
                            </tr>
                        </thead>
                        <tbody>
                           
                            @foreach($suborders as $suborder)
                                @foreach($products as $product)
                                    @if(intval($suborder->products_id) == intval($product->id))
                                        <tr>
                                            <td>{{$suborder->orders_id}}</td>
                                            <td>{{$product->product_name}}</td>
                                            <td>{{$suborder->price}}</td>
                                            <td>{{$suborder->quantity}}</td>
                                            <td>{{$suborder->created_at}}</td>
                                        </tr>
                                    @endif
                                @endforeach
                            @endforeach
                        
                        </tbody>
                    </table>
                </div>
                
                <div class="user-data__footer">
                    <button class="">{{$suborderPaginate->links()}}</button>
                </div>
            </div>
            <!-- END USER DATA-->
    </div>
</div>
@endsection