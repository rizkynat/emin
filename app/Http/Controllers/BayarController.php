<?php

namespace App\Http\Controllers;

use App\Models\Bayar;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use DB;

class BayarController extends Controller
{
    public function show(){
        if(Session::get('login')==null){
            return redirect('login')->with('alert','Anda belum login, silahkan login terlebih dahulu');
        }
        else{
            if(Session::get('role')!='bendahara'){
                return redirect('list-bayar')->with('alert','Hanya bendahara yang dapat mengakses fitur ini!');
            }else{
            DB::statement("SET lc_time_names = 'id_ID';");
            $pembayarans = DB::table('pembayaran')
            ->join('invoice', 'invoice.id_invoice','=','pembayaran.id_invoice')
            ->select('invoice.id_invoice','pembayaran.nama_pengirim', 'pembayaran.bukti_bayar', DB::raw("DATE_FORMAT(pembayaran.tgl_bayar, '%d %M %Y') as tgl_bayar"))->paginate(5);
            return view('home.list-bayar', ['pembayarans'=>$pembayarans]);
            }
        }
    }

    public function tambahBayarShow(){
        if(Session::get('login')==null){
            return redirect('login')->with('alert','Anda belum login, silahkan login terlebih dahulu');
        }
        else{
            if(Session::get('role')!='bendahara'){
                return redirect('list-bayar')->with('alert','Hanya bendahara yang dapat mengakses fitur ini!');
            }else{
            DB::statement("SET lc_time_names = 'id_ID';");
            $invoices = DB::select("select id_invoice from invoice where status='0'");
            return view('home.upload-bayar',['invoices'=>$invoices]);
            }
        }
    }

    public function tambahBayarProses(Request $request){
        
        $validator = Validator::make($request->all(), [
            'id_invoice' => 'required',
            'nama_pengirim' => 'required',
            'file_upload' => 'required',
            'tgl_bayar'=>'required'
        ]);

        if(!$validator->fails()){
            $status = '1';
            $id_invoice = $request->id_invoice;
            $nama_pengirim = $request->nama_pengirim;
            $file_upload = $request->file('file_upload');
            $filename = date('YmdHi').'_'.$file_upload->getClientOriginalName();
            $file_upload -> move(public_path('images/invoices/'), $filename);
            $tgl_bayar = $request->tgl_bayar;
            DB::insert('insert into pembayaran (id_invoice, nama_pengirim, bukti_bayar, tgl_bayar) values (?, ?, ?, ?)', [$id_invoice, $nama_pengirim, $filename, $tgl_bayar]);
            DB::update('update invoice set status=? where id_invoice=?',[$status, $id_invoice]);

            return redirect('list-bayar/')->with('alert-success','Data bukti pembayaran berhasil ditambahkan');                        
            
        }else{
            return redirect('upload-bayar/')->with('alert','Isi data dengan baik dan lengkap');
        }
    }

}