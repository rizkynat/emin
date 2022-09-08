<?php

namespace App\Http\Controllers;

use App\Models\Bayar;
use App\Models\Invoice;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use DB;

class BayarController extends Controller
{
    public function show(){
        if(Session::get('login')==null){
            return redirect('login')->with('alert','Anda belum login, silahkan login terlebih dahulu');
        }
        else{
            if(Session::get('role')!='bendahara'){
                return Redirect::to(url()->previous())->with('alert','Hanya bendahara yang dapat mengakses halaman "List Bukti Bayar" !');
            }else{
            DB::statement("SET lc_time_names = 'id_ID';");
            $pembayarans = DB::table('pembayaran')
            ->join('invoice', 'invoice.id_invoice','=','pembayaran.id_invoice')
            ->select('invoice.id_invoice','pembayaran.id_bayar','pembayaran.nama_pengirim', 'pembayaran.bukti_bayar', DB::raw("DATE_FORMAT(pembayaran.tgl_bayar, '%d %M %Y') as tgl_bayar"))->paginate(5);
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
                return Redirect::to(url()->previous())->with('alert','Hanya bendahara yang dapat mengakses halaman "Upload Bukti Bayar" !');
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
            $file_upload -> move(public_path('images/bukti_bayar/'), $filename);
            $tgl_bayar = $request->tgl_bayar;
            DB::insert('insert into pembayaran (id_invoice, nama_pengirim, bukti_bayar, tgl_bayar) values (?, ?, ?, ?)', [$id_invoice, $nama_pengirim, $filename, $tgl_bayar]);
            $bayar = DB::select('select id_bayar from pembayaran where id_invoice='.$id_invoice);
            $invoice = DB::table('invoice')
            ->join('artikel', 'artikel.id_artikel','=','invoice.id_artikel')
            ->join('volume', 'volume.id_volume','=','artikel.id_volume')
            ->where('invoice.id_invoice',$id_invoice)
            ->select('invoice.id_invoice', 'volume.harga', 'invoice.tgl_invoice', 'artikel.id_artikel')->get(); 
            
            $deskripsi = str_pad(substr($id_invoice, 0, 4), 4, '0', STR_PAD_LEFT).'/INV/JKT/PCR/2022';
            DB::insert('insert into keuangan (deskripsi, status, foto_kwitansi, nominal, tgl_keuangan) values(?, ?, ?, ?, ?)', [$deskripsi, 'Uang masuk', $filename, $invoice[0]->harga, $tgl_bayar]);
            
            $kode_status = 'plri';
            DB::insert('insert into kwitansi (id_bayar, tgl_kwitansi) values (?, ?)', [$bayar[0]->id_bayar, $invoice[0]->tgl_invoice]);
            DB::insert('insert into loa (id_artikel, tgl_loa) values (?, ?)', [$invoice[0]->id_artikel, $invoice[0]->tgl_invoice]);
            DB::insert('insert into artikel_status (kode_status,id_artikel) values (?, ?)', [$kode_status, $invoice[0]->id_artikel]);
            DB::update('update invoice set status=?, tgl_invoice=? where id_invoice=?',[$status, $invoice[0]->tgl_invoice, $id_invoice]);

            return redirect('list-bayar/')->with('alert-success','Data bukti pembayaran berhasil ditambahkan');                        
            
        }else{
            return redirect('upload-bayar/')->with('alert','Isi data dengan baik dan lengkap');
        }
    }

    public function editBayarShow($id_bayar){
        if(Session::get('login')==null){
            return redirect('login')->with('alert','Anda belum login, silahkan login terlebih dahulu');
        }if(Session::get('role')!='bendahara'){
            return Redirect::to(url()->previous())->with('alert','Hanya bendahara yang dapat mengakses halaman "Edit Bukti Bayar" !');
        }else{
            $invoices = DB::select("select id_invoice from invoice");
            $pembayarans = DB::select('select * from pembayaran where id_bayar=?',[$id_bayar]);
            return view('home.edit-bayar', ['invoices'=>$invoices, 'pembayarans'=>$pembayarans]);
        }
    }

    public function editBayarProses(Request $request, $id_bayar){
        $bayar = Bayar::find($id_bayar);

        $nama_pengirim = $request->input('nama_pengirim');
        $file_upload = $request->file('file_upload');
        $tgl_bayar = $request->input('tgl_bayar');
        $id_invoice = $bayar->id_invoice;

        $invoice = DB::table('invoice')
        ->join('artikel', 'artikel.id_artikel','=','invoice.id_artikel')
        ->join('volume', 'volume.id_volume','=','artikel.id_volume')
        ->where('invoice.id_invoice',$id_invoice)
        ->select('invoice.id_invoice', 'volume.harga', 'invoice.tgl_invoice', 'artikel.id_artikel')->get(); 
        
        if($request->file_upload == NULL){
            DB::update('update pembayaran set nama_pengirim=?, tgl_bayar=? where id_bayar=?',
            [$nama_pengirim, $tgl_bayar, $id_bayar]);

            DB::update('update keuangan set nominal=?, tgl_keuangan=? where foto_kwitansi=?', [$invoice[0]->harga, $tgl_bayar, $bayar->bukti_bayar]);
        }else{
            $filename = date('YmdHi').'_'.$file_upload->getClientOriginalName();
            $path = public_path('images/bukti_bayar/').$bayar->bukti_bayar;
            unlink($path);
            $file_upload -> move(public_path('images/bukti_bayar/'), $filename);

            DB::update('update keuangan set foto_kwitansi=?, nominal=?, tgl_keuangan=? where foto_kwitansi=?', [$filename, $invoice[0]->harga, $tgl_bayar, $bayar->bukti_bayar]);
            DB::update('update pembayaran set nama_pengirim=?, bukti_bayar=?, tgl_bayar=? where id_bayar=?',
            [$nama_pengirim, $filename, $tgl_bayar, $id_bayar]);
        }
        return redirect('list-bayar/')->with('alert','Data bukti bayar berhasil diedit !');
        
    }

    public function hapusBayarProses(Request $request, $id_bayar, $id_invoice){
        $bayar = Bayar::find($id_bayar);
        $invoice = Invoice::find($id_invoice);
        $status0 = '0';
        DB::update('update invoice set status=?, tgl_invoice=? where id_invoice=?',[$status0,$invoice->tgl_invoice, $id_invoice]);
        $path = public_path('images/bukti_bayar/').$bayar->bukti_bayar;
        unlink($path);
        $artikel = DB::table('pembayaran')->where('id_bayar',$id_bayar)->delete();
        return redirect('list-bayar')->with('alert-success','Data bukti bayar berhasil dihapus!');
    }

}