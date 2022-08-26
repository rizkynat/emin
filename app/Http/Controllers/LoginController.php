<?php

namespace App\Http\Controllers;

use App\Models\Editor;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller{
    public function show()
    {
        return view('auth.login');
    }

    public function loginProses(Request $request){
        $email = $request->email_editor;
        $password = Hash::make($request->password);

        $data = Editor::where(['email_editor'=>$email])->first();
        if($data){ //apakah email tersebut ada atau tidak
            $check = Hash::check($data->password,$password);
            if($check){
                Session::put('nama_editor',$data['nama_editor']);
                Session::put('email_editor',$data['email_editor']);
                Session::put('role',$data['role']);
                Session::put('login',TRUE);
                return redirect('/dashboard');
            }
            else{
                return redirect('login')->with('alert','Email atau Password anda salah!');
            }
        }else{
            return redirect('login')->with('alert','Email atau Password anda salah!');
        }
    }

    public function logout(){
        Session::flush();
        return redirect('login')->with('alert','Anda telah logout');
    }
}
?>