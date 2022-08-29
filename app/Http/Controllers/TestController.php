<?php

namespace App\Http\Controllers;

use App\Models\ArtStatus;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use DB;

class TestController extends Controller
{
    public function test($id_invoice){
        /*$arrayTambahStatuss = [];
        $statuss = DB::select('select kode_status, keterangan_status from status');
        $artikel_status = DB::select('select s.kode_status, s.keterangan_status from artikel_status at inner join status s on at.kode_status = s.kode_status where at.id_artikel=?',[$id_artikel]);
        $x=0;
        foreach($statuss as $i){
            if(!in_array($i, $artikel_status)){
                array_push($arrayTambahStatuss, $i);
            }
            $x++;
        }*/
        $banks = DB::table('bank')
        ->join('volume','volume.id_bank','=','bank.id_bank')
        ->select('volume.id_volume','bank.nama_bank','bank.no_rek','bank.atas_nama', 'bank.email')->get();

        $invoices = DB::table('artikel')
        ->join('invoice', 'invoice.id_artikel','=','artikel.id_artikel')
        ->join('volume', 'volume.id_volume','=','artikel.id_volume')
        ->where('invoice.id_invoice',$id_invoice)
        ->select('invoice.id_invoice', 'artikel.id_artikel','volume.no_volume','volume.harga',DB::raw("DATE_FORMAT(DATE_ADD(invoice.tgl_invoice, INTERVAL 2 DAY), '%d %M %Y') as jatuh_tempo"),DB::raw("DATE_FORMAT(volume.tahun, '%M %Y') as tahun"), DB::raw("DATE_FORMAT(invoice.tgl_invoice, '%d %M %Y') as tgl_invoice"),'artikel.nama_penulis','artikel.instansi')->get();
        $a = asset('images/layout_invoice.jpg');
        $en = base64_encode($a);
        
        $checkInvoices = DB::select('select count(*) as jumlah from invoice where id_artikel='.$id_invoice);
        return asset('images/invoices/');
    }



}