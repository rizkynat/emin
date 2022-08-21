<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use DB;

class ArtikelController extends Controller
{
    public function show(){
        if(Session::get('login')==null){
            return redirect('login')->with('alert','Anda belum login, silahkan login terlebih dahulu');
        }
        else{
            DB::statement("SET lc_time_names = 'id_ID';");
            $artikels = DB::table('artikel')
            ->join('volume', 'volume.id_volume','=','artikel.id_volume')
            ->select('artikel.id_artikel','artikel.id_volume','artikel.nama_penulis','artikel.email_penulis','artikel.judul_artikel','artikel.instansi','volume.id_volume', DB::raw("DATE_FORMAT(volume.tahun, '%M %Y') as tahun"), 'volume.no_volume')->paginate(5);
            return view('home.list-artikel', ['artikels'=>$artikels]);
        }
    }

    public function tambahArtikelShow(){
        if(Session::get('login')==null){
            return redirect('login')->with('alert','Anda belum login, silahkan login terlebih dahulu');
        }
        else{
            DB::statement("SET lc_time_names = 'id_ID';");
            $artikels = DB::select('select id_volume, no_volume, DATE_FORMAT(tahun, "%M %Y") as tahun  from volume where status= "1"');
            return view('home.tambah-artikel',['artikels'=>$artikels]);
        }
    }

    public function tambahArtikelProses(Request $request){
        $validator = Validator::make($request->all(), [
            'id_artikel' => 'required',
            'id_volume' => 'required',
            'nama_penulis' => 'required',
            'email_penulis' => 'required|min:4|email|unique:artikel',
            'judul_artikel' => 'required|min:20',
            'instansi' => 'required'

        ]);

        if(!$validator->fails()){
            $validated_data = $request->all();
            $artikel = new Artikel();
            $artikel->fill($validated_data);
            $artikel->save();
            return redirect('list-artikel')->with('alert-success','Data artikel berhasil ditambahkan!');
        }else{
            $arrayValidator = $validator->messages();
            
            return redirect('tambah-volume')->with('alert','Isi data dengan baik dan lengkap');
        }
    }
}
