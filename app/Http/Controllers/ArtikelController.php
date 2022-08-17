<?php

namespace App\Http\Controllers;

use App\Editor;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class ArtikelController extends Controller
{
    public function show(){
        if(Session::get('login')==null){
            return redirect('login')->with('alert','Anda belum login, silahkan login terlebih dahulu');
        }
        else{
            return view('home.list-artikel');
        }
    }
}
