<?php

namespace App\Http\Controllers\Auth;

use App\Models\doctor;
use App\Models\patient;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Notifications\DoctorAccountActivationNotification;
use App\Notifications\PatientAccountActivationNotification;

class AuthController extends Controller
{
    // Patient Store Data
    public function store(Request $request)
    {
        
         // Patient Validate

         $this ->validate($request, [
            'name'           =>'required',
            'mobile'         =>'required|unique:patients',
            'email'           =>'required|unique:patients|email',
            'password'      =>'required|confirmed',
        ]);

         //   Create a token

         $token = md5( time(). rand() );

         $patient = patient::create([
            'name'            => $request -> name,
            'mobile'          => $request -> mobile,
            'email'            => $request -> email,
            'access_token'   => $token,
            'status'           => false,
            'password'       => password_hash($request -> password, PASSWORD_DEFAULT),
        ]);

         //   Send Account Activation link
         $patient -> notify( new PatientAccountActivationNotification($patient) );

         return redirect() -> route('login.page') -> with('success', 'Hi ' .$patient -> name . ' Your account is ready. Please login');
       

        

    }

    //  Patient Account Activation

    public function PatientAccountActivation($token = null)
    {
         //  Check Token
         if( !$token ){
            return redirect() -> route('login.page') -> with('danger',  'Access token not found');
        }

        //  Check Token
        if( $token ){
            
            $patient_data = patient::where('access_token', $token) -> first();

            if( $patient_data ){

                $patient_data ->update([
                    'access_token'  =>NULL,
                    'status'           =>true
                ]);

                return redirect() -> route('login.page') -> with('success', 'Hi '.$patient_data-> name . ' Your Account is Verified. Now Login');
            }else{
                return redirect() -> route('login.page') -> with('warning',  'Access token not match');
            }

        }



    }

      


 // Patient Login Auth

 public function login(Request $request)
 {
     //  Patient Login Validate

     $this -> validate($request, [
         'email'             =>'required',
         'password'        =>'required',
     ]);

     // Login Auth

     if( Auth::guard('patient') -> attempt([ 'email' => $request -> email, 'password' => $request -> password, ]) || Auth::guard('patient') -> attempt([ 'mobile' => $request -> email, 'password' => $request -> password ]) ){

         //  patient access_token
         if( Auth::guard('patient') -> user() -> access_token == null && Auth::guard('patient') -> user() -> status == true ){
            return redirect() -> route('patient.dashboard');
        }else{
            Auth::guard('patient') ->logout();
            return redirect() -> route('login.page') -> with('danger', 'Please check your email & Active your account first');
        }
        //  patient access_token

    }else if( Auth::guard('doctor') -> attempt([ 'email' => $request -> email, 'password' => $request -> password, ]) || Auth::guard('doctor') -> attempt([ 'mobile' => $request -> email, 'password' => $request -> password ]) ){
        
        //  Doctor access_token
        if( Auth::guard('doctor') -> user() -> access_token == null && Auth::guard('doctor') -> user() -> status == true ){
            return redirect() -> route('doctor.dashboard');
        }else{
            Auth::guard('doctor') ->logout();
            return redirect() -> route('login.page') -> with('danger', 'Please check your email & Active your account first');
        }
        //  Doctor access_token
        
        
        
    }else{
        return redirect() -> route('login.page') -> with('danger', 'Worng Email or Password');
    }

     //  Patient Login Auth S

 }

 // Patient Logout

 public function logout()
 {
     Auth::guard('patient') -> logout();
     return redirect() -> route('login.page') -> with('success',  'Thanks for staying with us');
 }



    //  Doctor Store
    public function doctor_store(Request $request)
    {
          // Doctor Validate

          $this ->validate($request, [
            'name'           =>'required',
            'mobile'         =>'required|unique:doctors',
            'email'           =>'required|unique:doctors|email',
            'password'      =>'required|confirmed',
        ]);

         //   Create a token

         $token = md5( time(). rand() );

         $doctor = doctor::create([
            'name'            => $request -> name,
            'mobile'          => $request -> mobile,
            'email'            => $request -> email,
            'access_token'   => $token,
            'status'           => false,
            'password'       => password_hash($request -> password, PASSWORD_DEFAULT),
        ]);

        //   Send Account Activation link
        $doctor -> notify( new DoctorAccountActivationNotification($doctor) );

        return redirect() -> route('login.page') -> with('success', 'Hi ' .$doctor -> name . ' Your account is ready. Please login');
      



    }

    //  Patient Account Activation

    public function DoctorAccountActivation($token = null)
    {
         //  Check Token
         if( !$token ){
            return redirect() -> route('login.page') -> with('danger',  'Access token not found');
        }

        //  Check Token
        if( $token ){
            
            $doctor_data = doctor::where('access_token', $token) -> first();

            if( $doctor_data ){

                $doctor_data ->update([
                    'access_token'  =>NULL,
                    'status'           =>true
                ]);

                return redirect() -> route('login.page') -> with('success', 'Hi '.$doctor_data-> name . ' Your Account is Verified. Now Login');
            }else{
                return redirect() -> route('login.page') -> with('warning',  'Access token not match');
            }

        }



    }

    // Doctor Logout

 public function DoctorLogout()
 {
     Auth::guard('doctor') -> logout();
     return redirect() -> route('login.page') -> with('info',  'Thanks for staying with us');
 }





}