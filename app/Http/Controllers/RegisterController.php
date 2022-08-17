<?php

namespace App\Http\Controllers;

use App\Models\Editor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller{
    public function show()
    {
        if(Session::get('role')=='chief editor'){
            return view('auth.register');            
        }
        else{
            return redirect('login')->with('alert','Akses hanya dapat dilakukan Chief editor');
        }
    }

    public function registerProses(Request $request){
        $validator = Validator::make($request->all(), [
            'nama_editor' => 'required|min:4',
            'email_editor' => 'required|min:4|email|unique:editor',
            'password' => 'required',
            'repassword' => 'required|same:password',
            'role' => 'required',
        ]);
        if(!$validator->fails()){
            $validated_data = $request->all();
            $editor = new Editor();
            $editor->fill($validated_data);
            $editor->save();
            return redirect('login')->with('alert-success','Akun anda berhasil ditambahkan!');
        }else{
            $arrayValidator = $validator->messages();
            
            return redirect('register')->with('alert','Isi data dengan baik dan lengkap, Nama editor dan Email harus lebih dari 4 huruf!');
        }
            }
    
    public function create(array $data){
        return Editor::create([
            'nama_editor'=>$data['nama_editor'],
            'email_editor'=>$data['email_editor'],
            'password'=>Hash::make($data['password']),
            'role'=>$data['role']
        ]);
    }

    public function logout(){
        Session::flush();
        return redirect('login')->with('alert','Anda telah logout');
    }

/*
    public function login(LoginRequest $request)
    {
        $credentials = $request->getCredentials();

        if(!Auth::validate($credentials)):
            return redirect()->to('login')
                ->withErrors(trans('auth.failed'));
        endif;

        $user = Auth::getProvider()->retrieveByCredentials($credentials);

        Auth::login($user);

        return $this->authenticated($request, $user);
    }

    protected function authenticated(Request $request, $user) 
    {
        return redirect()->intended();
    }
    */
}
?>