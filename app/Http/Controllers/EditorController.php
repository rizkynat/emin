<?php

namespace App\Http\Controllers;

use App\Models\Editor;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use DB;

class EditorController extends Controller
{
    public function show(){
        if(Session::get('login')==null){
            return redirect('login')->with('alert','Anda belum login, silahkan login terlebih dahulu');
        }
        else{
            if(Session::get('role')!='chief editor'){
                return redirect('list-invoice')->with('alert','Hanya chief editor yang dapat mengakses halaman "Tambah akun" !');
            }else{
            DB::statement("SET lc_time_names = 'id_ID';");
            $editors = DB::table('editor')
            ->latest('id_editor')
            ->select('editor.id_editor','editor.nama_editor', 'editor.password', 'editor.email_editor', 'editor.role')->paginate(10);
            return view('home.list-akun', ['editors'=>$editors]);
            }
        }
    }

    public function cari(Request $request){
        $cari = $request->cari;
        
        DB::statement("SET lc_time_names = 'id_ID';");
        $editor = DB::table('editor')
        ->latest('id_editor')
        ->select('editor.id_editor','editor.nama_editor', 'editor.password', 'editor.email_editor', 'editor.role');
        $columns = array('editor.id_editor','editor.nama_editor', 'editor.password', 'editor.email_editor', 'editor.role');
        $resultsArray = array();

        foreach($columns as $column){
            $editor = $editor->orWhere($column,'like', "%".$cari."%");
        }
        $editors = $editor->paginate(10);
        return view('home.list-akun', ['editors'=>$editors]);
    }

    public function editEditorShow($id_editor){
        if(Session::get('login')==null){
            return redirect('login')->with('alert','Anda belum login, silahkan login terlebih dahulu');
        }
        else{
            $editors = DB::select('select * from editor where id_editor= ?',[$id_editor]);
            $roles = ['chief editor', 'bendahara', 'editor'];
            return view('home.edit-akun', ['editors'=>$editors, 'roles'=>$roles]);
        }
    }

    public function editEditorProses(Request $request, $id_editor){
        $nama_editor = $request->input('nama_editor');
        $password = $request->input('password');
        $email_editor = $request->input('email_editor');
        $role = $request->input('role');

        DB::update('update editor set nama_editor=?, password=?, email_editor=?, role=? where id_editor=?',
        [$nama_editor, $password, $email_editor, $role, $id_editor]);
        return redirect('list-akun')->with('alert-success','Data akun berhasil diubah!');
    }


}