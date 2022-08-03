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

    // Patient Forgot Password Page Show
    public function ShowForgotPassword()
    {
            $patients = patient::latest() -> first();
            return view('patient.forgot', [
            'patients' => $patients
            ] );          

        
    }

    // Patient Reset Password Page Show
    public function PatientForgotPassword($id)
    {
        $patient_password = patient::findOrFail($id);
        return view('patient.reset', [
            'patient_password'     =>$patient_password
        ]);
    }


}
