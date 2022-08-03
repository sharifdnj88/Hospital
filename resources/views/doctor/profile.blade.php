@extends('layouts/app')

@section('main')
    <!-- Breadcrumb -->
			<div class="breadcrumb-bar">
				<div class="container-fluid">
					<div class="row align-items-center">
						<div class="col-md-12 col-12">
							<nav aria-label="breadcrumb" class="page-breadcrumb">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="index-2.html">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">Profile Settings</li>
								</ol>
							</nav>
							<h2 class="breadcrumb-title">Profile Settings</h2>
						</div>
					</div>
				</div>
			</div>
			<!-- /Breadcrumb -->
			
			<!-- Page Content -->
			<div class="content">
				<div class="container-fluid">

					<div class="row">
						<div class="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar">
							
							@include('doctor/sidebar')
							
						</div>
						
						<div class="col-md-7 col-lg-8 col-xl-9">

							<div class="card">
								<div class="card-body">
									@include('validate')
									<!-- Profile Settings Form -->
									<form action="{{route('doctor.profile.change')}}" method="POST" enctype="multipart/form-data">
										@csrf
										<div class="row form-row">
											<div class="col-12 col-md-12">
												<div class="form-group">
													<div class="change-avatar">
														<div class="profile-img">
															@if ( !Auth::guard('doctor') -> User() -> photo )
                    											<img src="{{asset('assets/img/sharif.png')}}" alt="User Image">
                											@else
                    											<img src="{{url('storage/doctors/' . Auth::guard('doctor') -> User() -> photo )}}" alt="User Image">
                											@endif
														</div>
														<div class="upload-img">
															<div class="change-photo-btn">
																<span><i class="fa fa-upload"></i> Upload Photo</span>
																<input name="photo" type="file" class="upload">
															</div>
															<small class="form-text text-muted">Allowed JPG, GIF or PNG. Max size of 2MB</small>
														</div>
													</div>
												</div>
											</div>
											<div class="col-12">
												<h3 class="text-center text-danger">Services and Specialization</h3>
											<hr>
											</div>											
											<div class="col-12 col-md-6">												
												<div class="form-group">
													<label>Specialization</label>
													<select name="specialization"  class="form-control select">
														<option value="">--Select--</option>
														<option @if( Auth::guard('doctor') -> user() -> specialization == "Cardiologist" ) selected @endif  value="Cardiologist" >Cardiologist</option>
														<option @if( Auth::guard('doctor') -> user() -> specialization == "Urology" ) selected @endif  value="Urology" >Urology</option>
														<option @if( Auth::guard('doctor') -> user() -> specialization == "Neurology" ) selected @endif  value="Neurology" >Neurology</option>
														<option @if( Auth::guard('doctor') -> user() -> specialization == "Orthopedic" ) selected @endif value="Orthopedic" >Orthopedic</option>
														<option @if( Auth::guard('doctor') -> user() -> specialization == "Paediatric" ) selected @endif value="Paediatric" >Paediatric</option>
														<option @if( Auth::guard('doctor') -> user() -> specialization == "Internal_Medicine" ) selected @endif value="Internal_Medicine" >Internal Medicine</option>
													</select>
												</div>																							
											</div>
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label>Services</label>
													<input name="services"  value="{{ Auth::guard('doctor') -> User() -> services }}" type="text" class="form-control">
													<small class="form-text text-muted">Note : Type your services</small>
												</div>	
											</div>
											<div class="col-12">
												<h3 class="text-center text-danger">Personal Details</h3>
											<hr>
											</div>
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label>First Name</label>
													<input name="fname" value="{{ Auth::guard('doctor') -> User() -> fname }}" type="text" class="form-control">
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label>Last Name</label>
													<input name="lname"  value="{{ Auth::guard('doctor') -> User() -> lname}}" type="text" class="form-control">
												</div>
											</div>
											<div class="col-12 col-md-4">
												<div class="form-group">
													<label>Date of Birth</label>
													<div class="cal-icon">
														<input name="date_of_birth" value="{{ Auth::guard('doctor') -> User() -> date_of_birth }}" type="text" class="form-control datetimepicker">
													</div>
												</div>
											</div>
											<div class="col-12 col-md-4">
												<div class="form-group">
													<label>Gender</label>
													<select name="gender" class="form-control select">
														<option value="">--Select--</option>
														<option @if( Auth::guard('doctor') -> user() -> gender == "Male" ) selected @endif value="Male">Male</option>
														<option @if( Auth::guard('doctor') -> user() -> gender == "Female" ) selected @endif value="Female">Female</option>
													</select>
												</div>
											</div>
											<div class="col-12 col-md-4">
												<div class="form-group">
													<label>Blood Group</label>
													<select name="blood_group"  class="form-control select">
														<option value="">--Select--</option>
														<option @if( Auth::guard('doctor') -> user() -> blood_group == "A-" ) selected @endif value="A-" >A-</option>
														<option @if( Auth::guard('doctor') -> user() -> blood_group == "A+" ) selected @endif  value="A+" >A+</option>
														<option @if( Auth::guard('doctor') -> user() -> blood_group == "B-" ) selected @endif value="B-" >B-</option>
														<option @if( Auth::guard('doctor') -> user() -> blood_group == "B+" ) selected @endif value="B+" >B+</option>
														<option @if( Auth::guard('doctor') -> user() -> blood_group == "AB-" ) selected @endif value="AB-" >AB-</option>
														<option @if( Auth::guard('doctor') -> user() -> blood_group == "AB+" ) selected @endif value="AB+" >AB+</option>
														<option @if( Auth::guard('doctor') -> user() -> blood_group == "O-" ) selected @endif value="O-" >O-</option>
														<option  @if( Auth::guard('doctor') -> user() -> blood_group == "O+" ) selected @endif value="O+" >O+</option>
													</select>
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label>Email ID</label>
													{{-- <input name="email" value="{{ Auth::guard('patient') -> User() -> email }}" type="email" class="form-control"> --}}
													<input name="email" class="form-control" type="text" value="{{ Auth::guard('doctor') -> User() -> email }}" aria-label="readonly input example" readonly>
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label>Mobile</label>
													<input name="mobile" value="{{ Auth::guard('doctor') -> User() -> mobile }}" type="text" class="form-control">
												</div>
											</div>
											<div class="col-12">
												<div class="form-group">
												<label>Address</label>
													<input name="address" value="{{ Auth::guard('doctor') -> User() -> address }}" type="text" class="form-control">
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label>City</label>
													<input name="city" value="{{ Auth::guard('doctor') -> User() -> city }}" type="text" class="form-control">
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label>Division</label>
													<input name="division" value="{{ Auth::guard('doctor') -> User() -> division }}" type="text" class="form-control">
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label>Country</label>
													<input name="country" value="{{ Auth::guard('doctor') -> User() -> country }}" type="text" class="form-control">
												</div>
											</div>
										</div>
										<div class="submit-section">
											<button type="submit" class="btn btn-primary submit-btn">Save Changes</button>
										</div>
									</form>
									<!-- /Profile Settings Form -->
									
								</div>
							</div>

						</div>
					</div>

				</div>

			</div>		
			<!-- /Page Content -->
@endsection