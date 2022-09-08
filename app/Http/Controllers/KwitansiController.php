<?php

namespace App\Http\Controllers;

use App\Models\Kwitansi;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use DB;
use PDF;

class KwitansiController extends Controller
{
    public function show(){
        if(Session::get('login')==null){
            return redirect('login')->with('alert','Anda belum login, silahkan login terlebih dahulu');
        }
        else{
            DB::statement("SET lc_time_names = 'id_ID';");
            $kwitansis = DB::table('kwitansi')
            ->join('pembayaran', 'kwitansi.id_bayar', '=', 'pembayaran.id_bayar')
            ->join('invoice', 'invoice.id_invoice','=','pembayaran.id_invoice')
            ->join('artikel','artikel.id_artikel', '=','invoice.id_artikel')
            ->join('volume', 'artikel.id_volume','=','volume.id_volume')
            ->select('artikel.judul_artikel', 'kwitansi.id_kwitansi', DB::raw("DATE_FORMAT(kwitansi.tgl_kwitansi, '%d %M %Y') as tgl_kwitansi"))->paginate(5);
            return view('home.list-kwitansi', ['kwitansis'=>$kwitansis]);
        }
    }

    public function pdfKwitansiShow($id_kwitansi){
        if(Session::get('login')==null){
            return redirect('login')->with('alert','Anda belum login, silahkan login terlebih dahulu');
        }
        else{
            DB::statement("SET lc_time_names = 'id_ID';");
            
            $kwitansis = DB::table('kwitansi')
            ->join('pembayaran', 'kwitansi.id_bayar', '=', 'pembayaran.id_bayar')
            ->join('invoice', 'invoice.id_invoice','=','pembayaran.id_invoice')
            ->join('artikel','artikel.id_artikel', '=','invoice.id_artikel')
            ->join('volume', 'artikel.id_volume','=','volume.id_volume')
            ->where('kwitansi.id_kwitansi', $id_kwitansi)
            ->select('artikel.judul_artikel', 'pembayaran.nama_pengirim', 'volume.no_volume', DB::raw("DATE_FORMAT(volume.tahun, '%M %Y') as tahun"), 'volume.harga', 'kwitansi.id_kwitansi', DB::raw("DATE_FORMAT(kwitansi.tgl_kwitansi, '%d %M %Y') as tgl_kwitansi"))->get();

            return view('home.pdf-kwitansi', ['kwitansis'=>$kwitansis]);
        }
    }

    public function downloadKwitansiProses($id_kwitansi) {
        set_time_limit(300);
        // retreive all records from db
        DB::statement("SET lc_time_names = 'id_ID';");

        $kwitansis = DB::table('kwitansi')
        ->join('pembayaran', 'kwitansi.id_bayar', '=', 'pembayaran.id_bayar')
        ->join('invoice', 'invoice.id_invoice','=','pembayaran.id_invoice')
        ->join('artikel','artikel.id_artikel', '=','invoice.id_artikel')
        ->join('volume', 'artikel.id_volume','=','volume.id_volume')
        ->where('kwitansi.id_kwitansi', $id_kwitansi)
        ->select('artikel.judul_artikel', 'pembayaran.nama_pengirim', 'volume.no_volume', DB::raw("DATE_FORMAT(volume.tahun, '%M %Y') as tahun"), 'volume.harga', 'kwitansi.id_kwitansi', DB::raw("DATE_FORMAT(kwitansi.tgl_kwitansi, '%d %M %Y') as tgl_kwitansi"))->get();
        // share data to view
        $pdf = PDF::loadView('home.pdf-kwitansi', ['kwitansis'=>$kwitansis]);
        $pdf->setOptions(['isRemoteEnabled' => true]);
        $pdf->setPaper([0, -5, 685.98, 480.85], 'landscape');
        // download PDF file with download method
        return $pdf->download('Kwitansi '.$kwitansis[0]->nama_pengirim.'.pdf');
      }

}