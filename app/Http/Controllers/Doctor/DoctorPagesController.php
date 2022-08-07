<?php

namespace App\Http\Controllers\Doctor;

use App\Models\doctor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DoctorPagesController extends Controller
{
    // Docotor Register Page Show
    public function ShowDoctorRegisterPage()
    {
        return view('doctor.register');
    }

    // Docotor Register Page Show
    public function ShowDoctordashboard()
    {
        return view('doctor.dashboard');
    }

    // Docotor Profile Page Show
    public function ShowDoctorProfile()
    {
        return view('doctor.profile');
    }

    // Docotor Password Page Show
    public function ShowDoctorPassword()
    {
        return view('doctor.password');
    }

     

}
