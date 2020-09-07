@extends('layouts.admin')

@section('content')
<div class="page-wrapper">
    <div class="page-content--bge5">
        <div class="container">
            <div class="login-wrap">
                <div class="login-content">
                    <div class="login-logo">
                        <a href="#">
                            <img src="{{asset('images/icon/logo.png')}}" alt="CoolAdmin">
                        </a>
                    </div>
                    <div class="login-form">
                        <form method="POST" action="{{ route('password.update') }}">
                            @csrf
                            <input type="hidden" name="token" value="{{ $token }}">
                            <div class="form-group">
                                <label>Email Address</label>
                                <input class="au-input au-input--full form-control @error('email') is-invalid @enderror" type="email" name="email" value="{{ old('email') }}" placeholder="Email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Password</label>
                                <input class="au-input au-input--full form-control @error('password') is-invalid @enderror" type="password" name="password" placeholder="Password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Confirm Password</label>
                                <input id="password-confirm" type="password" class="au-input au-input--full form-control" name="password_confirmation" placeholder="Password" autocomplete="new-password">
                            </div>

                            <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">Reset Password</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection