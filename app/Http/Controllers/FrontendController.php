<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontendController extends Controller
{
    // Home page Show
    public function home()
    {
        return view('home');
    }

    // Login page Show
    public function login()
    {
        return view('login');
    }


}
