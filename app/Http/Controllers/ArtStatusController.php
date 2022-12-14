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

            $files = DB::table('kwitansi')
            ->join('pembayaran', 'kwitansi.id_bayar', '=', 'pembayaran.id_bayar')
            ->join('invoice', 'invoice.id_invoice','=','pembayaran.id_invoice')
            ->join('artikel','artikel.id_artikel', '=','invoice.id_artikel')
            ->join('loa', 'loa.id_artikel', '=', 'artikel.id_artikel')
            ->where('artikel.id_artikel',$id_artikel)
            ->select('artikel.id_artikel','invoice.id_invoice', 'pembayaran.bukti_bayar', 'loa.id_loa', 'kwitansi.id_kwitansi')->get();

            $checkInvoices = DB::select('select count(*) as jumlah from invoice where id_artikel='.$id_artikel);
            $invoice = DB::select('select id_artikel, id_invoice from invoice where id_artikel='.$id_artikel);
            $artstatuss = DB::table('artikel_status')
            ->join('status', 'artikel_status.kode_status','=','status.kode_status')
            ->join('artikel', 'artikel_status.id_artikel','=','artikel.id_artikel')
            ->where('artikel.id_artikel',$id_artikel)
            ->select('artikel.id_artikel','status.kode_status', 'status.keterangan_status','artikel.judul_artikel','artikel.nama_penulis', DB::raw("DATE_FORMAT(artikel_status.tanggal, '%e %M %Y, %H:%i') as tanggal"))->get();
            return view('home.list-artstatus', ['artstatuss'=>$artstatuss, 'files'=>$files,'checkInvoices'=>$checkInvoices, 'invoice'=>$invoice]);
        }
    }

    public function tambahArtStatusShow($id_artikel){
        if(Session::get('login')==null){
            return redirect('login')->with('alert','Anda belum login, silahkan login terlebih dahulu');
        }
        else{
            if(Session::get('role')!='chief editor'){
            return redirect('list-artikel/')->with('alert','Hanya chief editor yang dapat mengakses fitur ini!');
            }else{
                $arrayTambahStatuss = [];
                $artikel = DB::select('select * from artikel where id_artikel=?',[$id_artikel]);
                $statuss = DB::select('select kode_status, keterangan_status from status');
                $artikel_status = DB::select('select s.kode_status, s.keterangan_status from artikel_status at inner join status s on at.kode_status = s.kode_status where at.id_artikel=?',[$id_artikel]);
                $x=0;
                foreach($statuss as $i){
                    if(!in_array($i, $artikel_status)){
                        array_push($arrayTambahStatuss, $i);
                    }
                    $x++;
                }
                return view('home.tambah-artstatus',['arrayTambahStatuss'=>$arrayTambahStatuss, 'artikel'=>$artikel])->with('id_artikel',$id_artikel);
            }
        }
    }

    public function tambahArtStatusProses(Request $request, $id_artikel){
        
        $validator = Validator::make($request->all(), [
            'kode_status' => 'required'
        ]);

        if(!$validator->fails()){
            $kode_status = $request->kode_status;

            DB::insert('insert into artikel_status (kode_status, id_artikel) values (?, ?)', [$kode_status, $id_artikel]);
                 
            return redirect('list-artikel/')->with('alert-success','Data Status Artikel berhasil ditambahkan');
        }else{
            return redirect('tambah-status/'.$id_artikel)->with('alert','Isi data dengan baik dan lengkap');
        }
    }

    
}