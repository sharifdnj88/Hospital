<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Models\patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PatientPagesController extends Controller
{
    // Patient Register Page Show
    public function ShowPatientRegisterPage()
    {
        return view('patient.register');
    }


    // Patient Dashboard Page Show
    public function ShowPatientDashboard()
    {
        return view('patient.dashboard');
    }


    // Patient Setting Page Show
    public function ShowPatientSetting()
    {
        return view('patient.setting');
    }


    // Patient Password Page Show
    public function ShowPatientPassword()
    {
        return view('patient.password');
    }

    

}
