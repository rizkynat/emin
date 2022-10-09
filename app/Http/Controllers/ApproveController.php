<?php

namespace App\Http\Controllers;

use App\Models\Approve;
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

class ApproveController extends Controller
{
    public function show(){
        if(Session::get('login')==null){
            return redirect('login')->with('alert','Anda belum login, silahkan login terlebih dahulu');
        }
        else{
            DB::statement("SET lc_time_names = 'id_ID';");
            $approves = DB::table('approve_payment')
            ->latest('id_approve')
            ->join('invoice', 'invoice.id_invoice','=','approve_payment.id_invoice')
            ->select('invoice.id_invoice','approve_payment.id_approve', 'approve_payment.status', 'approve_payment.nama_pengirim', 'approve_payment.bukti_bayar', DB::raw("DATE_FORMAT(approve_payment.tgl_bayar, '%e %M %Y') as tgl_bayar"))->paginate(10);
            return view('home.list-approve', ['approves'=>$approves]);
            }
    }

    public function cari(Request $request){
        $cari = $request->cari;
        
        DB::statement("SET lc_time_names = 'id_ID';");
        $approve = DB::table('approve_payment')
        ->latest('id_approve')
        ->join('invoice', 'invoice.id_invoice','=','approve_payment.id_invoice')
        ->select('invoice.id_invoice', 'approve_payment.status','approve_payment.id_approve','approve_payment.nama_pengirim', 'approve_payment.bukti_bayar', DB::raw("DATE_FORMAT(approve_payment.tgl_bayar, '%e %M %Y') as tgl_bayar"));
        $columns = array('invoice.id_invoice','approve_payment.nama_pengirim','approve_payment.tgl_bayar');
        $resultsArray = array();

        foreach($columns as $column){
            $approve = $approve->orWhere($column,'like', "%".$cari."%");
        }
        $approves = $approve->paginate(10);
        return view('home.list-approve', ['approves'=>$approves]);
    }

    public function kirimApprove(Request $request, $id_approve){
            $approve = Approve::find($id_approve);
            $status = '1';
            $id_invoice = $approve->id_invoice;
            $nama_pengirim = $approve->nama_pengirim;
            $filename = $approve->bukti_bayar;
            $tempFile = 'images/temp/'.$filename;
            $destination = 'images/bukti_bayar/'.$filename;
            $file_upload = copy($tempFile, $destination);
            $tgl_bayar = $approve->tgl_bayar;
            
            DB::update('update approve_payment set status=?, tgl_bayar=? where id_approve=?', [$status, $tgl_bayar, $id_approve]);
            DB::insert('insert into pembayaran (id_invoice, nama_pengirim, bukti_bayar, tgl_bayar) values (?, ?, ?, ?)', [$id_invoice, $nama_pengirim, $filename, $tgl_bayar]);
            $bayar = DB::select('select id_bayar from pembayaran where id_invoice='.$id_invoice);
            $invoice = DB::table('invoice')
            ->join('artikel', 'artikel.id_artikel','=','invoice.id_artikel')
            ->join('volume', 'volume.id_volume','=','artikel.id_volume')
            ->where('invoice.id_invoice',$id_invoice)
            ->select('invoice.id_invoice', 'volume.harga', 'invoice.tgl_invoice', 'artikel.id_artikel')->get(); 
            
            $deskripsi = str_pad(substr($id_invoice, 0, 4), 4, '0', STR_PAD_LEFT).'/INV/JKT/PCR/'.date('Y');
            DB::insert('insert into keuangan (deskripsi, status, foto_kwitansi, nominal, tgl_keuangan) values(?, ?, ?, ?, ?)', [$deskripsi, 'Uang masuk', $filename, $invoice[0]->harga, $tgl_bayar]);
            
            $kode_status = 'plri';
            DB::insert('insert into kwitansi (id_bayar, tgl_kwitansi) values (?, ?)', [$bayar[0]->id_bayar, $invoice[0]->tgl_invoice]);
            DB::insert('insert into loa (id_artikel, tgl_loa) values (?, ?)', [$invoice[0]->id_artikel, $invoice[0]->tgl_invoice]);
            DB::insert('insert into artikel_status (kode_status,id_artikel) values (?, ?)', [$kode_status, $invoice[0]->id_artikel]);
            DB::update('update invoice set status=?, tgl_invoice=? where id_invoice=?',[$status, $invoice[0]->tgl_invoice, $id_invoice]);

            return redirect('list-bayar/')->with('alert-success','Data bukti pembayaran berhasil ditambahkan');       
    }

    public function hapusApprove(Request $request, $id_approve, $id_invoice){
        $approve = Approve::find($id_approve);
        $invoice = Invoice::find($id_invoice);
        $path = public_path('images/temp/').$approve->bukti_bayar;
        unlink($path);
        $artikel = DB::table('approve_payment')->where('id_approve',$id_approve)->delete();
        return redirect('list-approve')->with('alert-success','Data approve berhasil dihapus!');
    }
}