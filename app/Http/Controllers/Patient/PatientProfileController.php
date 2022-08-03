<?php

namespace App\Http\Controllers\Patient;

use App\Models\patient;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\doctor;
use App\Notifications\DoctorForgotPasswordNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Notifications\PatientForgotPasswordNotification;

class PatientProfileController extends Controller
{


    // Patient Profile Update
    public function PatientProfileChange(Request $request)
    {
        // Patient Profile Validate

        $this -> validate($request, [
            'fname'             =>'required',
            'lname'             =>'required',
            'date_of_birth'     =>'required',
            'blood_group'     =>'required',
            // 'email'              =>'required',
            'mobile'            =>'required',
            'address'           =>'required',
            'city'                =>'required',
            'division'           =>'required',
            'country'           =>'required',
            'photo'             =>'required',
        ]);

        // Patient Photo Upload

    if( $request -> hasFile('photo') ){

        $img = $request -> file('photo');
        $file_name = md5( time(). rand() ) . '.' . $img -> clientExtension();
        $img -> move( storage_path('app/public/patients/'), $file_name );

     }else{
        $file_name = 'sharif.png';
     }

        $update_data = patient::findorFail(Auth::guard('patient') -> user() -> id);
        $update_data -> update([
            'fname'             => $request -> fname,
            'lname'             => $request -> lname,
            'date_of_birth'     => $request -> date_of_birth,
            'blood_group'      => $request -> blood_group,
            'email'              => $request -> email,
            'mobile'            => $request -> mobile,
            'address'           => $request -> address,
            'city'                 => $request -> city,
            'division'            => $request -> division,
            'country'            => $request -> country,
            'photo'              => $file_name
        ]);

        return back() -> with('success', 'Your Profile Data Update Successfully');

    }

    
    //  Password Change
    public function PatientPasswordChange(Request $request)
    {
        //  Validate
        $this -> validate($request, [
            'old_pass'  =>'required',
            'pass'      =>'required|confirmed'
        ]);

        
        //  Old Password Check
        if( !password_verify( $request -> old_pass, Auth::guard('patient') -> user() -> password ) ){
            return back() -> with('danger', 'Old Password dose not match');
        }

        //  Confirm Password Check
        if( $request -> pass != $request -> pass_confirmation ){
            return back() -> with('danger', 'Confirmation password not match');
        }

        //  Password Change Now

        $data = patient::findOrFail(Auth::guard('patient') -> user() -> id);
        $data -> update([
            'password'      => Hash::make($request -> pass),
        ]);

        Auth::guard('patient') -> logout();
        return redirect() -> route('login.page') -> with('success', 'Your Profile Password Change');

    }


    //  Forgot Password
    public function PatientForgotUpdate(Request $request, $id)
    {
        // Validate
        $this -> validate($request, [
            'email'         =>'required',
            'password'    =>'required|confirmed'
        ]);

        $for = patient::where('email', $request -> email) -> first();

        if( $for ){
            // return redirect() -> route('forgot.password.change');
        }else{
            return back() -> with('danger', 'We can not find your email. Please enter your valid email');
        }

         //   Create a token

         $token = md5( time(). rand() );

         $patient_update = patient::findOrFail($id);
         $patient_update ->update([
             'password'       => password_hash($request -> password, PASSWORD_DEFAULT),
             'access_token'   => $token,
         ]);

          //   Send Account Activation link
          $patient_update -> notify( new PatientForgotPasswordNotification($patient_update) );

          return redirect() -> route('login.page') -> with('success', 'Check your email address & click the link');


    }

     //  Patient Forgot Account Notification
     public function PatientForgotPasswordNotification($token = null)
     {
         //  Check Token
         if( !$token ){
             return redirect() -> route('login.page') -> with('danger',  'Access token not found');
         }
 
 
         //  Check Token
         if( $token ){
             
             $patient_update = patient::where('access_token', $token) -> first();
 
             if( $patient_update ){
 
                 $patient_update ->update([
                     'access_token'  =>NULL,
                     'status'           =>true
                 ]);
 
                 return redirect() -> route('login.page') -> with('success', 'Hi '.$patient_update-> name . ' Your account forgot password successfully change. Now Login');
             }else{
                 return redirect() -> route('login.page') -> with('warning',  'Access token not match');
             }
 
         }
     }




}
