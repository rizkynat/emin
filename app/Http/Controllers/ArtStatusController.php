<?php

namespace App\Http\Controllers;

use App\Models\ArtSTatus;
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

            $invoices = DB::select('select * from invoice where id_artikel='.$id_artikel);
            $checkInvoices = DB::select('select count(*) as jumlah from invoice where id_artikel='.$id_artikel);
            $artstatuss = DB::table('artikel_status')
            ->join('status', 'artikel_status.kode_status','=','status.kode_status')
            ->join('artikel', 'artikel_status.id_artikel','=','artikel.id_artikel')
            ->where('artikel.id_artikel',$id_artikel)
            ->select('artikel.id_artikel','status.keterangan_status','artikel.judul_artikel','artikel.nama_penulis', DB::raw("DATE_FORMAT(artikel_status.tanggal, '%d %M %Y, %H:%i') as tanggal"))->get();
            return view('home.list-artstatus', ['artstatuss'=>$artstatuss, 'invoices'=>$invoices,'checkInvoices'=>$checkInvoices]);
        }
    }

    public function tambahArtStatusShow($id_artikel){
        if(Session::get('login')==null){
            return redirect('login')->with('alert','Anda belum login, silahkan login terlebih dahulu');
        }
        else{
            $arrayTambahStatuss = [];
            $statuss = DB::select('select kode_status, keterangan_status from status');
            $artikel_status = DB::select('select s.kode_status, s.keterangan_status from artikel_status at inner join status s on at.kode_status = s.kode_status where at.id_artikel=?',[$id_artikel]);
            $x=0;
            foreach($statuss as $i){
                if(!in_array($i, $artikel_status)){
                    array_push($arrayTambahStatuss, $i);
                }
                $x++;
            }
            return view('home.tambah-artstatus',['arrayTambahStatuss'=>$arrayTambahStatuss])->with('id_artikel',$id_artikel);
        }
    }

    public function tambahArtStatusProses(Request $request, $id_artikel){
        
        $validator = Validator::make($request->all(), [
            'id_artikel' => 'required',
            'kode_status' => 'required'
        ]);

        if(!$validator->fails()){
            $id_artikel = $request->id_artikel;
            $kode_status = $request->kode_status;

            DB::insert('insert into artikel_status (kode_status, id_artikel) values (?, ?)', [$kode_status, $id_artikel]);
                 
            return redirect('list-artstatus/'.$id_artikel)->with('alert','Data Status Artikel berhasil ditambahkan');
        }else{
            return redirect('tambah-status/'.$id_artikel)->with('alert','Isi data dengan baik dan lengkap');
        }
    }

    
}