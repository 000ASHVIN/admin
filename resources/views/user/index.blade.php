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
                                <li class="list-inline-item">Users</li>
                            </ul>
                        </div>
                        <button class="au-btn au-btn-icon au-btn--green" onclick="window.location.href ='/user/create'">
                            <i class="zmdi zmdi-plus"></i>add user</button>
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
                        <i class="zmdi zmdi-account-calendar"></i>User</h3>
                    <div>
                        @if(session('success'))
                            <span class="text-success">{{session('success')}}</span>
                        @endif
                    </div>
                </div>
                
                <div class="table-responsive table-data">
                    <table class="table">
                        <thead>
                            <tr>
                                <td></td>
                                <td>Username</td>
                                <td>Email</td>
                                <td>Role</td>
                                <td>Reset Password</td>
                                <td>status</td>
                                <td></td>
                            </tr>
                        </thead>
                        @foreach($users as $user)
                        <tbody>
                            <tr>
                                <td>
                                    <label class="au-checkbox">
                                        <input type="checkbox">
                                        <span class="au-checkmark"></span>
                                    </label>
                                </td>
                                <td>
                                    <span>{{$user->username}}</span>
                                </td>
                                <td>
                                    <span>{{$user->email}}</span>
                                </td>
                                <td>{{$user->role}}</td>
                                <td>
                                    <a href="/user/{{$user->id}}/edit" class="btn btn-primary">Reset</a>
                                </td>
                                <td>
                                    @if($user->status == 1)
                                        <span class="text-success">active</span>
                                    @elseif($user->status == 0)
                                        <span class="text-danger">blocked</span>
                                    @endif
                                </td>
                                <td>
                                    @if($user->status == 1)
                                        <a href="/user/{{$user->id}}/block" class="btn btn-danger">block</a>
                                    @elseif($user->status == 0)
                                    <a href="/user/{{$user->id}}/unblock" class="btn btn-success">unblock</a>
                                    @endif
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