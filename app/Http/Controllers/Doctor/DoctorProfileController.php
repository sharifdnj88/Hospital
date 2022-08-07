<?php

namespace App\Http\Controllers\Doctor;

use App\Models\doctor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\DoctorForgotPasswordNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DoctorProfileController extends Controller
{
    // Patient Profile Update
    public function DoctorProfileChange(Request $request)
    {
        // Patient Profile Validate

        $this -> validate($request, [
            'specialization'    =>'required',
            'services'           =>'required',
            'fname'             =>'required',
            'lname'             =>'required',
            'date_of_birth'     =>'required',
            'gender'            =>'required',
            'blood_group'     =>'required',
            'email'              =>'required',
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
        $img -> move( storage_path('app/public/doctors/'), $file_name );

     }else{
        $file_name = 'sharif.png';
     }

        $update_data = doctor::findorFail(Auth::guard('doctor') -> user() -> id);
        $update_data -> update([
            'specialization'    => $request -> specialization,
            'services'           => $request -> services,
            'fname'             => $request -> fname,
            'lname'             => $request -> lname,
            'date_of_birth'     => $request -> date_of_birth,
            'blood_group'     => $request -> blood_group,
            'gender'            => $request -> gender,
            'email'              => $request -> email,
            'mobile'            => $request -> mobile,
            'address'           => $request -> address,
            'city'                 => $request -> city,
            'division'            => $request -> division,
            'country'            => $request -> country,
            'photo'              => $file_name,
        ]);

        return back() -> with('success', 'Your Profile Data Update Successfully');

    }



    //  Doctor Password Change
    public function DoctorPasswordChange(Request $request)
    {
        //  Validate
        $this -> validate($request, [
            'old_pass'  =>'required',
            'pass'      =>'required|confirmed'
        ]);

        
         //  Old Password Check
         if( !password_verify( $request -> old_pass, Auth::guard('doctor') -> user() -> password ) ){
            return back() -> with('danger', 'Old Password dose not match');
        }

        //  Confirm Password Check
        if( $request -> pass != $request -> pass_confirmation ){
            return back() -> with('danger', 'Confirmation password not match');
        }

        //  Password Change Now

        $data = doctor::findOrFail(Auth::guard('doctor') -> user() -> id);
        $data -> update([
            'password'      => Hash::make($request -> pass),
        ]);

        Auth::guard('doctor') -> logout();
        return redirect() -> route('login.page') -> with('success', 'Your Profile Password Change');
    }






}
