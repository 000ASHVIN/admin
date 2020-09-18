@extends('layouts.admin')

@section('content')
<div class="page-wrapper">
    <div class="page-content--bge5">
        <div class="container">
            <div class="login-wrap">
                <div class="login-content">
                    <div class="login-logo">
                        <a href="#">
                            <img src="images/icon/logo.png" alt="CoolAdmin">
                        </a>
                    </div>
                    <div class="login-form">
                        <form method="POST" action="{{ route('register') }}" onsubmit="return validate_term();">
                            @csrf
                            <input type="hidden" class="form-control" name="role" value="admin">
                            <div class="form-group">
                                <label>Username</label>
                                <input class="au-input au-input--full form-control @error('username') is-invalid @enderror" type="text" name="username" value="{{ old('username') }}" placeholder="Username">

                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

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

                            <div class="login-checkbox form-group">
                                <label>
                                    <input type="checkbox" class="check-term @error('aggree') is-invalid @enderror" name="aggree" value="{{ old('email') }}">Agree the terms and policy
                                </label>

                                    <span class="error-term" style="color:red" role="alert">
                                    </span>
                            </div>

                            <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">register</button>


                        </form>
                        <div class="register-link">
                            <p>
                                Already have account?
                                <a href="/login">Sign In</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
