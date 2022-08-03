<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\SocialLoginController;
use App\Http\Controllers\Doctor\DoctorPagesController;
use App\Http\Controllers\Doctor\DoctorProfileController;
use App\Http\Controllers\Patient\PatientPagesController;
use App\Http\Controllers\Patient\PatientProfileController;


Route::get('/', [FrontendController::class, 'home']) ->name('home.page') ->middleware('patient.redirect') ->middleware('doctor.redirect');
Route::get('/login-page', [FrontendController::class, 'login']) ->name('login.page') ->middleware('patient.redirect');


// Patient Details
Route::get('/patient-register', [PatientPagesController::class, 'ShowPatientRegisterPage']) ->name('patient.register') ->middleware('patient.redirect');
Route::get('/patient-dashboard', [PatientPagesController::class, 'ShowPatientDashboard']) ->name('patient.dashboard') ->middleware('patient');
Route::get('/patient-setting', [PatientPagesController::class, 'ShowPatientSetting']) ->name('patient.setting') ->middleware('patient');
Route::get('/patient-password', [PatientPagesController::class, 'ShowPatientPassword']) ->name('patient.password') ->middleware('patient');
Route::post('/password-change', [PatientProfileController::class, 'PatientPasswordChange']) ->name('patient.password.change') ->middleware('patient');
Route::post('/patient-profile', [PatientProfileController::class, 'PatientProfileChange']) ->name('patient.profile.change') ->middleware('patient');

//  Patient Login Auth
Route::post('/patient-store', [AuthController::class, 'store']) ->name('patient.store');
Route::post('/patient-login', [AuthController::class, 'login']) ->name('patient.login');
Route::get('/patient-logout', [AuthController::class, 'logout']) ->name('patient.logout');

//  Patient Login Notification
Route::get('/patient_account_activation/{token?}', [AuthController::class, 'PatientAccountActivation']) ->name('patient.account.activation');

//  Patients Forgot & Reset Password
Route::get('/forgot-password', [PatientPagesController::class, 'ShowForgotPassword']) ->name('forgot.password.page') ->middleware('patient.redirect');
Route::get('/forgot-password/{id}', [ PatientPagesController::class, 'PatientForgotPassword' ]) ->name('patient.forgot.password') ->middleware('patient.redirect');
Route::post('/reset-password/{id}', [ PatientProfileController::class, 'PatientForgotUpdate' ]) ->name('patient.forgot.update');

//  Patient Forgot Password Token
Route::get('/patient_forgot_password/{token?}', [PatientProfileController::class, 'PatientForgotPasswordNotification']) ->name('patient.forgot.password.notify');


//  Patient Social Github Login
Route::get('github-login', [ SocialLoginController::class, 'SendGithubLogin' ]) -> name('github.login');
Route::get('github-login-system', [ SocialLoginController::class, 'LoginWithGithub' ]);

//  Patient Social Facebook Login
Route::get('facebook-login', [ SocialLoginController::class, 'SendFacebookLogin' ]) -> name('facebook.login');
Route::get('facebook-login-system', [ SocialLoginController::class, 'LoginWithFacebook' ]);

//  Patient Social Facebook Login
Route::get('google-login', [ SocialLoginController::class, 'SendGoogleLogin' ]) -> name('google.login');
Route::get('google-login-system', [ SocialLoginController::class, 'LoginWithGoogle' ]);

//  Doctor Details
Route::get('/doctor-register', [DoctorPagesController::class, 'ShowDoctorRegisterPage']) ->name('doctor.register') ->middleware('doctor.redirect');
Route::get('/doctor-dashboard', [DoctorPagesController::class, 'ShowDoctordashboard']) ->name('doctor.dashboard') ->middleware('doctor');
Route::get('/doctor-profile', [DoctorPagesController::class, 'ShowDoctorProfile']) ->name('doctor.profile') ->middleware('doctor');
Route::get('/doctor-password', [DoctorPagesController::class, 'ShowDoctorPassword']) ->name('doctor.password') ->middleware('doctor');
Route::post('/doctor-password', [DoctorProfileController::class, 'DoctorPasswordChange']) ->name('doctor.password.change') ->middleware('doctor');
Route::post('/doctor-profile', [DoctorProfileController::class, 'DoctorProfileChange']) ->name('doctor.profile.change') ->middleware('doctor');

//  Doctor Login Auth
Route::post('/doctor-store', [AuthController::class, 'doctor_store']) ->name('doctor.store');
Route::post('/doctor-login', [AuthController::class, 'login']) ->name('doctor.login');
Route::get('/doctor-logout', [AuthController::class, 'DoctorLogout']) ->name('doctor.logout');

//  Doctor Login Notification
Route::get('/doctor_account_activation/{token?}', [AuthController::class, 'DoctorAccountActivation']) ->name('doctor.account.activation');

//  Doctors Forgot & Reset Password
Route::get('/forgot-password-page', [DoctorPagesController::class, 'DoctorForgotPage']) ->name('doctor.forgot.page') ->middleware('doctor.redirect');
Route::get('/doctor-forgot-password/{id}', [ DoctorPagesController::class, 'DoctorForgotPassword' ]) ->name('doctor.forgot.password') ->middleware('doctor.redirect');
Route::post('/docotr-reset-password/{id}', [ DoctorProfileController::class, 'DoctorForgotUpdate' ]) ->name('doctor.forgot.update');

//  Patient Forgot Password Token
Route::get('/doctor_forgot_password/{token?}', [DoctorProfileController::class, 'DoctorForgotPasswordNotification']) ->name('doctor.forgot.password.notify');