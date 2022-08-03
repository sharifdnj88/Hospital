@extends('layouts/app')

@section('main')
    <!-- Page Content -->
			<div class="content">
				<div class="container-fluid">
					
					<div class="row">
						<div class="col-md-8 offset-md-2">
							
							<!-- Login Tab Content -->
							<div class="account-content">
								<div class="row align-items-center justify-content-center">
									<div class="col-md-7 col-lg-6 login-left">
										<img src="{{asset('assets/img/login-banner.png')}}" class="img-fluid" alt="Doccure Login">	
									</div>
									<div class="col-md-12 col-lg-6 login-right shadow">
										<div class="login-header">
											<h3>Login <span>Doccure</span></h3>
										</div>
										@include('validate')
										<form action="{{route('patient.login')}}" method="POST">
											@csrf
											<div class="form-group form-focus">
												<input name="email" type="text" class="form-control floating">
												<label class="focus-label">Email / Mobile</label>
											</div>
											<div class="form-group form-focus">
												<input name="password" id="new_pass" type="password" class="form-control floating">
												<label class="focus-label">Password</label>
												<label>
													<input id="show_pass" type="checkbox"> Show Password
												</label>
											</div>
											<div class="text-right">
												<p class="text-danger my-2">Forgot Password</p>
												<a class="forgot-link" href="{{route('forgot.password.page')}}">Patient</a> OR
												<a class="forgot-link" href="{{route('doctor.forgot.page')}}">Doctor</a>
											</div>
											<button class="btn btn-primary btn-block btn-lg login-btn" type="submit">Login</button>
											<div class="login-or">
												<span class="or-line"></span>
												<span class="span-or">or</span>
											</div>											
											<div class="text-center dont-have">Don’t have an account? <a href="{{route('patient.register')}}">Register</a></div>
										</form>
									</div>
								</div>
							</div>
							<!-- /Login Tab Content -->
								
						</div>
					</div>

				</div>

			</div>		
			<!-- /Page Content -->
@endsection