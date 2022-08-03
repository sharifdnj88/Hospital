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
					
						@include('patient.sidebar')
						
						<div class="col-md-7 col-lg-8 col-xl-9">
							<div class="card">
								<div class="card-body">
									@include('validate')
									<!-- Profile Settings Form -->
									<form action="{{route('patient.profile.change')}}" method="POST" enctype="multipart/form-data">
										@csrf
										<div class="row form-row">
											<div class="col-12 col-md-12">
												<div class="form-group">
													<div class="change-avatar">
														<div class="profile-img">
															@if ( !Auth::guard('patient') -> User() -> photo )
                                                                <img src="{{asset('assets/img/sharif.png')}}" alt="Sharif">
                                                            @else
                                                                <img src="{{url('storage/patients/' . Auth::guard('patient') -> User() -> photo )}}" alt="Sharif">
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
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label>First Name</label>
													<input name="fname" value="{{ Auth::guard('patient') -> User() -> fname }}" type="text" class="form-control">
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label>Last Name</label>
													<input name="lname" value="{{ Auth::guard('patient') -> User() -> lname }}" value="" type="text" class="form-control">
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label>Date of Birth</label>
													<div class="cal-icon">
														<input name="date_of_birth" value="{{ Auth::guard('patient') -> User() -> date_of_birth }}" type="text" class="form-control datetimepicker">
													</div>
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label>Blood Group</label>
													<select name="blood_group"  class="form-control select">
														<option value="">--Select--</option>
														<option @if( Auth::guard('patient') -> user() -> blood_group == "A-" ) selected @endif value="A-" >A-</option>
														<option @if( Auth::guard('patient') -> user() -> blood_group == "A+" ) selected @endif  value="A+" >A+</option>
														<option @if( Auth::guard('patient') -> user() -> blood_group == "B-" ) selected @endif value="B-" >B-</option>
														<option @if( Auth::guard('patient') -> user() -> blood_group == "B+" ) selected @endif value="B+" >B+</option>
														<option @if( Auth::guard('patient') -> user() -> blood_group == "AB-" ) selected @endif value="AB-" >AB-</option>
														<option @if( Auth::guard('patient') -> user() -> blood_group == "AB+" ) selected @endif value="AB+" >AB+</option>
														<option @if( Auth::guard('patient') -> user() -> blood_group == "O-" ) selected @endif value="O-" >O-</option>
														<option  @if( Auth::guard('patient') -> user() -> blood_group == "O+" ) selected @endif value="O+" >O+</option>
													</select>
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label>Email ID</label>
													<input name="email" class="form-control" type="text" value="{{ Auth::guard('patient') -> User() -> email }}" aria-label="readonly input example" readonly>
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label>Mobile</label>
													<input name="mobile" value="{{ Auth::guard('patient') -> User() -> mobile }}" type="text" class="form-control">
												</div>
											</div>
											<div class="col-12">
												<div class="form-group">
												<label>Address</label>
													<input name="address" value="{{ Auth::guard('patient') -> User() -> address }}" type="text" class="form-control">
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label>City</label>
													<input name="city" value="{{ Auth::guard('patient') -> User() -> city }}" type="text" class="form-control">
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label>Division</label>
													<input name="division" value="{{ Auth::guard('patient') -> User() -> division }}" type="text" class="form-control">
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label>Country</label>
													<input name="country" value="{{ Auth::guard('patient') -> User() -> country }}" type="text" class="form-control">
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