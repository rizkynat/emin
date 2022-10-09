<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class LogoutController extends Controller
{

    public function out(){
        return Redirect::to("https://jurnal.pcr.ac.id/index.php/jkt/");
    }

    public function perform()
    {
        Session::flush();
        
        Auth::logout();

        return redirect('login')->with('alert','Anda telah logout');
    }
}
