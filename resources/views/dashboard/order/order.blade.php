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

                <div class="d-flex justify-content-end">

                    <button type="button" class="btn btn-info" data-toggle="modal" data-target=".bd-example">Filter</button>

                </div>

                    <div class="modal fade bd-example" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <form action="/order/sortbydate" class="d-flex" method="post">
                                    @csrf
                                        <div class='col-md-4'>
                                            <input type="date" name="start-date" class="form-control">
                                        </div>
                                        <div class='col-md-4'>
                                            <input type="date" name="end-date" class="form-control">
                                        </div>
                                        <div class='col-md-4 d-flex justify-content-end'>
                                            <button type="submit" class="btn btn-info">Filter</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                <div class="d-flex justify-content-between">
                    <h3 class="title-3 m-b-30">
                        <i class="zmdi zmdi-account-calendar"></i>Order</h3>
                    <div>
                        @if(session('email_success'))
                            <p class="text-success">{{session('email_success')}}</p>
                        @endif
                    </div>
                    
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

                <div class="table-responsive table-data h-100">
                    <table class="table">
                         <thead>
                            <tr>
                                <td></td>
                                <td>Order</td>
                                <td>User Id</td>
                                <td>User</td>
                                <td>Date</td>
                                <td>Status</td>
                                <td>Approve/Discard</td>
                                <td>Billing</td>
                                <td></td>
                            </tr>
                        </thead>
                        @foreach($orders as $order)
                        <tbody>
                            <tr>
                                <td>
                                    <label class="au-checkbox">
                                        <input type="checkbox">
                                        <span class="au-checkmark"></span>
                                    </label>
                                </td>
                                <td>
                                    <span>#{{$order->id}}</span>
                                </td>
                                <td>{{$order->user->id}}</td>
                                <td>{{$order->user->username}}</td>
                                <td>
                                    <span>{{$order->created_at}}</span>
                                </td>
                                <td>
                                    @if($order->status == 'approved')
                                        <span class="text-success">approved</span>
                                    @elseif($order->status == 'pending')
                                        <span class="text-danger">pending</span>
                                    @endif
                                </td>
                                <td>
                                    @if($order->status == 'approved')
                                    <a href="/order/discard/{{$order->id}}" class='btn btn-danger'>Discard</a>
                                    @elseif($order->status == 'pending')
                                    <a href="/order/approveMail/{{$order->id}}" class='btn btn-primary'>Approve</a>
                                    @endif
                                </td>
                                <td>
                                    <span>paypal</span>
                                </td>
                                <td><a href="/order/{{$order->id}}" class='btn btn-primary'>Details</a></td>
                            </tr>
                        </tbody>
                        @endforeach
                    </table>
                    <div class="user-data__footer">
                        <button class="">{{$orderPaginate->links()}}</button>
                    </div>
                </div>
                
            </div>
            <!-- END USER DATA-->
    </div>
</div>
@endsection