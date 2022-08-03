@extends('layouts/app')

@section('main')
    <!-- Main Wrapper -->
		<div class="main-wrapper">
		
			
			
			<!-- Page Content -->
			<div class="content">
				<div class="container-fluid">
					
					<div class="row">
						<div class="col-md-8 offset-md-2">
							
							<!-- Account Content -->
							<div class="account-content">
								<div class="row align-items-center justify-content-center">
									<div class="col-md-7 col-lg-6 login-left">
										<img src="assets/img/login-banner.png" class="img-fluid" alt="Login Banner">	
									</div>
									<div class="col-md-12 col-lg-6 login-right">
										<div class="login-header">
											<h3 class="text-center">Forgot Password?</h3>
											{{-- <p class="small text-muted">Enter your email to get a password reset link</p> --}}
										</div>
										@include('validate')
										<div class="card">
											<div class="card-body text-center">
												<a class="btn btn-primary btn-sm" href="{{route('doctor.forgot.password', $doctors -> id)}}">Forgot Your Account Password</a>
											</div>
										</div>
										<!-- Forgot Password Form -->
										{{-- <form action="{{route('forgot.password.update')}}" method="POST" >
                                            @csrf
											<div class="form-group form-focus">
												<input name="password" type="password" class="form-control floating">
												<label class="focus-label">New Password</label>
											</div>
											<div class="form-group form-focus">
												<input name="password_confirmation" type="password" class="form-control floating">
												<label class="focus-label">Confirm Password</label>
											</div>
											<div class="text-right">
												<a class="forgot-link" href="">Remember your password?</a>
											</div>
											<button class="btn btn-primary btn-block btn-lg login-btn" type="submit">Reset Password</button>
										</form> --}}
										<!-- /Forgot Password Form -->
										
									</div>
								</div>
							</div>
							<!-- /Account Content -->
							
						</div>
					</div>

				</div>

			</div>		
			<!-- /Page Content -->
   
					   
		</div>
		<!-- /Main Wrapper -->
@endsection