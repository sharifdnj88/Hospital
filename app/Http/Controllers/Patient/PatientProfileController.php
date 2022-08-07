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



    // Management Forgot Page View
    public function ShowForgotPassword()
    {
        return view('patient.forgot');
    }

    public function ForgotPassword(Request $request)
    {
        $this -> validate($request, [
            'email'     =>'required|email'
        ]);

        $manage_data = patient::where('email', $request -> email) -> first();
        $staff_data = doctor::where('email', $request -> email) -> first();

        if( $manage_data ){
            $token = md5( time(). rand() );
            $manage_data ->update([
                'access_token'  => $token
            ]);
            $manage_data ->notify(new PatientForgotPasswordNotification($manage_data));
            return redirect() -> route('login.page') -> with('success', 'Please check your email & Click the Link'); 
        }elseif( $staff_data ){
            $token = md5( time(). rand() );
            $staff_data ->update([
                'access_token'  => $token
            ]);
            $staff_data ->notify(new DoctorForgotPasswordNotification($staff_data));
            return redirect() -> route('login.page') -> with('success', 'Please check your email & Click the Link'); 
        }else{
            return back() -> with('danger', 'We can not find your email. Please enter your valid email');
        }



    }

    //  Reset Password Link
    public function ResetPasswordLink($token =null, $email =null)
    {
        if( !$token && !$email ){
            return redirect() -> route('login.page') -> with('danger', 'Acces token or Email not found');
        }
        
        if( $token && $email ){
            $manage_data = patient::where('access_token', $token) -> first();
            $manag_data_email = patient::where('email', $email) -> first();
            $staff_data = doctor::where('access_token', $token) -> first();
            $staf_data_email = doctor::where('email', $email) -> first();

            if( $manage_data && $manag_data_email || $staff_data && $staf_data_email ){
                return view('patient.reset', compact('email'));

            }else{
                return redirect() -> route('login.page') -> with('danger', 'Acces token or Email not match');
            }

        }

    }

    public function ResetPassword(Request $request)
    {
        $this -> validate($request, [
            'password'    =>'required|confirmed'
        ]);

        $manage_data = patient::where('email', $request -> email) -> first();
        $staff_data = doctor::where('email', $request -> email) -> first();

        if( $manage_data ){
            $manage_data ->update([
                'access_token'  => null,
                'password'      => Hash::make( $request -> password )
            ]);
            return redirect() -> route('login.page') -> with('success', 'Your Password Change'); 
        }else{
            $staff_data ->update([
                'access_token'  => null,
                'password'      => Hash::make( $request -> password )
            ]);
            return redirect() -> route('login.page') -> with('success', 'Your Password Change'); 
        }

         


    }






    


}
