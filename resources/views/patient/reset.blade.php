@extends('layouts/app')
@section('title', 'Forgot Passwprd')

@section('main')

<!-- Page Content -->
<div class="content">
    <div class="container-fluid">
        
        <div class="row">
            <div class="col-md-8 offset-md-2">
                
                <!-- Account Content -->
                <div class="account-content">
                    <div class="row align-items-center justify-content-center">
                        <div class="col-md-7 col-lg-6 login-left">
                            <img src="{{asset('assets/img/login-banner.png')}}" class="img-fluid" alt="Login Banner">	
                        </div>
                        <div class="col-md-12 col-lg-6 login-right">
                            <div class="login-header text-center">
                                <h3>Reset Password?</h3>
                                <p class="small text-muted">Change your Password</p>
                            </div>
                            @include('validate')
                            <!-- Forgot Password Form -->
                            <form action="{{route('reset.password')}}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <input name="email" class="form-control" value="{{ $email }}" type="email" Readonly >
                                </div>
                                <div class="form-group">
                                    {{-- <input name="email" class="form-control" value="{{ $email }}" type="hidden"> --}}
                                    <input name="password" class="form-control" type="password" placeholder="New Password">
                                </div>
                                <div class="form-group">
                                    <input name="password_confirmation" class="form-control" type="password" placeholder="Confirm Password">
                                </div>
                                <div class="form-group mb-0">
                                    <button class="btn btn-primary btn-block" type="submit">Reset Password</button>
                                </div>
                            </form>
                            <!-- /Forgot Password Form -->
                            <div class="text-center dont-have">Remember your password? <a href="{{route('login.page')}}">Login</a></div>
                        </div>
                    </div>
                </div>
                <!-- /Account Content -->
                
            </div>
        </div>

    </div>

</div>		
<!-- /Page Content -->


@endsection