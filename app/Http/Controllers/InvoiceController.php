<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use DB;
use PDF;

class InvoiceController extends Controller
{
    public function show(){
        if(Session::get('login')==null){
            return redirect('login')->with('alert','Anda belum login, silahkan login terlebih dahulu');
        }
        else{
            DB::statement("SET lc_time_names = 'id_ID';");
            $invoices = DB::table('invoice')
            ->join('artikel', 'invoice.id_artikel','=','artikel.id_artikel')
            ->select('artikel.judul_artikel', 'invoice.id_invoice', DB::raw("DATE_FORMAT(invoice.tgl_invoice, '%d %M %Y') as tgl_invoice"))->paginate(5);
            return view('home.list-invoice', ['invoices'=>$invoices]);
        }
    }

    public function tambahInvoiceShow(){
        if(Session::get('login')==null){
            return redirect('list-artikel')->with('alert','Anda belum login, silahkan login terlebih dahulu');
        }
        else{
            if(Session::get('role')!='bendahara'){
                return redirect('list-invoice')->with('alert','Hanya bendahara yang dapat mengakses fitur ini!');
            }else{
            DB::statement("SET lc_time_names = 'id_ID';");
            $artikels = DB::select('select id_artikel, judul_artikel from artikel where status="0"');
            return view('home.tambah-invoice',['artikels'=>$artikels]);
            }
        }
    }

    public function tambahInvoiceProses(Request $request){
        
        $validator = Validator::make($request->all(), [
            'id_artikel' => 'required'
        ]);

        if(!$validator->fails()){
            $id_artikel = $request->id_artikel;
            $status = '1';

            DB::insert('insert into invoice (id_artikel) values (?)', [$id_artikel]);
            
            DB::insert('insert into artikel_status (kode_status, id_artikel) values(?, ?)',['ii', $id_artikel]);
            DB::update('update artikel set status=? where id_artikel=?',[$status, $id_artikel]);

                 
            return redirect('list-invoice/')->with('alert-success','Data invoice berhasil ditambahkan');
        }else{
            return redirect('tambah-invoice/')->with('alert','Isi data dengan baik dan lengkap');
        }
    }

    public function pdfInvoiceShow($id_invoice){
        if(Session::get('login')==null){
            return redirect('login')->with('alert','Anda belum login, silahkan login terlebih dahulu');
        }
        else{
            DB::statement("SET lc_time_names = 'id_ID';");
            $banks = DB::table('bank')
            ->join('volume','volume.id_bank','=','bank.id_bank')
            ->select('volume.id_volume','bank.nama_bank','bank.no_rek','bank.atas_nama', 'bank.email')->get();

            $invoices = DB::table('artikel')
            ->join('invoice', 'invoice.id_artikel','=','artikel.id_artikel')
            ->join('volume', 'volume.id_volume','=','artikel.id_volume')
            ->where('invoice.id_invoice',$id_invoice)
            ->select('invoice.id_invoice','volume.id_volume', 'artikel.id_artikel','volume.no_volume','volume.harga',DB::raw("DATE_FORMAT(DATE_ADD(invoice.tgl_invoice, INTERVAL 2 DAY), '%d %M %Y') as jatuh_tempo"),DB::raw("DATE_FORMAT(volume.tahun, '%M %Y') as tahun"), DB::raw("DATE_FORMAT(invoice.tgl_invoice, '%d %M %Y') as tgl_invoice"),'artikel.nama_penulis','artikel.instansi')->get();
            return view('home.pdf-invoice', ['invoices'=>$invoices, 'banks'=>$banks]);
        }
    }

    public function downloadInvoiceProses($id_invoice) {
        set_time_limit(300);
        // retreive all records from db
        DB::statement("SET lc_time_names = 'id_ID';");
        $banks = DB::table('bank')
        ->join('volume','volume.id_bank','=','bank.id_bank')
        ->select('volume.id_volume','bank.nama_bank','bank.no_rek','bank.atas_nama', 'bank.email')->get();

        $invoices = DB::table('artikel')
        ->join('invoice', 'invoice.id_artikel','=','artikel.id_artikel')
        ->join('volume', 'volume.id_volume','=','artikel.id_volume')
        ->where('invoice.id_invoice',$id_invoice)
        ->select('invoice.id_invoice','volume.id_volume', 'artikel.id_artikel','volume.no_volume','volume.harga',DB::raw("DATE_FORMAT(DATE_ADD(invoice.tgl_invoice, INTERVAL 2 DAY), '%d %M %Y') as jatuh_tempo"),DB::raw("DATE_FORMAT(volume.tahun, '%M %Y') as tahun"), DB::raw("DATE_FORMAT(invoice.tgl_invoice, '%d %M %Y') as tgl_invoice"),'artikel.nama_penulis','artikel.instansi')->get();
        // share data to view
        $pdf = PDF::loadView('home.pdf-invoice', ['invoices'=>$invoices, 'banks'=>$banks]);
        $pdf->setOptions(['isRemoteEnabled' => true]);
        $pdf->setPaper([0, -5, 685.98, 480.85], 'landscape');
        // download PDF file with download method
        return $pdf->download('Invoice '.$invoices[0]->nama_penulis.'.pdf');
      }

}