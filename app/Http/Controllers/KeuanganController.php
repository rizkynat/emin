<?php

namespace App\Http\Controllers;

use App\Models\Keuangan;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use DB;

class KeuanganController extends Controller
{
    public function show(){
        if(Session::get('login')==null){
            return redirect('login')->with('alert','Anda belum login, silahkan login terlebih dahulu');
        }
        else{
            DB::statement("SET lc_time_names = 'id_ID';");
            $uangMasuk = DB::select("select sum(nominal) as nominal from keuangan where status='Uang masuk'");
            $uangKeluar = DB::select("select sum(nominal) as nominal from keuangan where status='Uang keluar'");
            $keuangans = DB::table('keuangan')
            ->select('keuangan.deskripsi', 'keuangan.id_keuangan', 'keuangan.status', 'keuangan.foto_kwitansi', 'keuangan.nominal', DB::raw("DATE_FORMAT(keuangan.tgl_keuangan, '%d %M %Y') as tgl_keuangan"))->paginate(10);
            return view('home.list-keuangan', ['keuangans'=>$keuangans, 'uangMasuk'=>$uangMasuk, 'uangKeluar'=>$uangKeluar]);
        }
    }

    public function tambahKeuanganShow(){
        if(Session::get('login')==null){
            return redirect('login')->with('alert','Anda belum login, silahkan login terlebih dahulu');
        }
        else{
            if(Session::get('role')!='bendahara'){
                return Redirect::to(url()->previous())->with('alert','Hanya bendahara yang dapat mengakses halaman "Tambah Keuangan" !');
            }else{
            return view('home.tambah-keuangan');
            }
        }
    }

    public function tambahKeuanganProses(Request $request){
        
        $validator = Validator::make($request->all(), [
            'deskripsi' => 'required',
            'status' => 'required',
            'foto_kwitansi' => 'required',
            'nominal' => 'required',
            'tgl_keuangan'=>'required'
        ]);

        if(!$validator->fails()){
            $deskripsi = $request->deskripsi;
            $status = $request->status;
            $foto_kwitansi = $request->file('foto_kwitansi');
            $filename = date('YmdHi').'_'.$foto_kwitansi->getClientOriginalName();
            $foto_kwitansi -> move(public_path('images/keuangan/'), $filename);
            $nominal = $request->nominal;
            $tgl_keuangan = $request->tgl_keuangan;

            DB::insert('insert into keuangan (deskripsi, status, foto_kwitansi, nominal, tgl_keuangan) values(?, ?, ?, ?, ?)', [$deskripsi, $status, $filename, $nominal, $tgl_keuangan]);
            return redirect('list-keuangan/')->with('alert-success','Data keuangan berhasil ditambahkan'); 
        }else{
            return redirect('tambah-keuangan/')->with('alert','Isi data dengan baik dan lengkap');
        }
    }

}