<?php

namespace App\Http\Controllers;

use App\Models\patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialLoginController extends Controller
{

    //  Facebook Login 
    public function SendFacebookLogin()
    {
        return Socialite::driver('facebook')-> redirect();
    }


    public function LoginWithFacebook()
    {
        $user = Socialite::driver('facebook')->user();
 
         $login_user = patient::where('facebook_id', '$user -> id') -> first();
 
         if( $login_user ){
             Auth::guard('patient') -> login($login_user);
             return redirect('/patient-dashboard');
         }else{
             $patient = patient::create([
                'name'               =>  $user -> name,
                'facebook_id'       => $user -> id,
                'status'               =>true,
             ]);
 
             Auth::guard('patient') -> login($patient);
             return redirect('/patient-dashboard');
         }
    }





     // Github Login
     public function SendGithubLogin()
     {
         return Socialite::driver('github')-> redirect();
     }


     public function LoginWithGithub()
     {
         $user = Socialite::driver('github')->user();
 
         $login_user = patient::where('github_id', '$user -> id') -> first();
 
         if( $login_user ){
             Auth::guard('patient') -> login($login_user);
             return redirect('/patient-dashboard');
         }else{
             $patient = patient::create([
                'name'               =>  $user -> name,
                'facebook_id'       => $user -> id,
                'status'               =>true,
             ]);
 
             Auth::guard('patient') -> login($patient);
             return redirect('/patient-dashboard');
         }
 
 
     }


    //   Google Login
    public function SendGoogleLogin()
    {
        return Socialite::driver('google')-> redirect();
    }

    public function LoginWithGoogle()
     {
         $user = Socialite::driver('google')->user();
 
         $login_user = patient::where('google_id', '$user -> id') -> first();
 
         if( $login_user ){
             Auth::guard('patient') -> login($login_user);
             return redirect('/patient-dashboard');
         }else{
             $patient = patient::create([
                'name'               =>  $user -> name,
                'facebook_id'       => $user -> id,
                'status'               =>true,
             ]);
 
             Auth::guard('patient') -> login($patient);
             return redirect('/patient-dashboard');
         }
 
 
     }



}
