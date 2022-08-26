<?php

namespace App\Http\Controllers;

use App\Models\ArtSTa;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use DB;

class ArtStatusController extends Controller
{
    public function show($id_artikel){
        if(Session::get('login')==null){
            return redirect('login')->with('alert','Anda belum login, silahkan login terlebih dahulu');
        }
        else{
            DB::statement("SET lc_time_names = 'id_ID';");
            $artstatuss = DB::table('artikel_status')
            ->join('status', 'artikel_status.kode_status','=','status.kode_status')
            ->join('artikel', 'artikel_status.id_artikel','=','artikel.id_artikel')
            ->where('artikel.id_artikel',$id_artikel)
            ->select('status.keterangan_status','artikel.judul_artikel','artikel.nama_penulis', DB::raw("DATE_FORMAT(artikel_status.tanggal, '%d %M %Y, %H:%i') as tanggal"))->get();
            return view('home.list-artstatus', ['artstatuss'=>$artstatuss]);
        }
    }

    
}