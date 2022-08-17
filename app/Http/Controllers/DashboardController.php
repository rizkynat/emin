<?php

namespace App\Http\Controllers;

use App\Editor;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    public function show(){
        if(Session::get('role')=='editor' or Session::get('role')=='chief editor' or Session::get('role')=='bendahara'){
            return view('home.dashboard');
        }
        else{
            return redirect('login')->with('alert','Anda belum login, silahkan login terlebih dahulu');
        }
    }
}
