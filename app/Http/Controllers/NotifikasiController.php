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
use App\Exports\ArtikelExport;
use DB;
use Excel;

class NotifikasiController extends Controller
{
    public function show(){
        if(Session::get('login')==null){
            return redirect('login')->with('alert','Anda belum login, silahkan login terlebih dahulu');
        }
        else{
            $listNotifs = DB::select("select artikel.judul_artikel, artikel.id_artikel, status.keterangan_status from artikel_status join status on artikel_status.kode_status=status.kode_status join artikel on artikel.id_artikel=artikel_status.id_artikel where id_artikel_status in (select max(id_artikel_status) from `artikel_status` group by id_artikel) and artikel_status.kode_status in ('ced', 'wp', 'plri')");
            return view('home.list-notifikasi', ['listNotifs'=>$listNotifs]);
        }

    }

    public function countBendahara(){
        $countNotifBendahara = DB::select("select count(id_artikel) as jumlah from artikel_status join status on artikel_status.kode_status=status.kode_status where id_artikel_status in (select max(id_artikel_status) from `artikel_status` group by id_artikel) and artikel_status.kode_status in ('ced', 'wp')");   
        return $countNotifBendahara;
    }

    public function countChiefEditor(){
        $countNotifChiefEditor = DB::select("select count(id_artikel) as jumlah from artikel_status join status on artikel_status.kode_status=status.kode_status where id_artikel_status in (select max(id_artikel_status) from `artikel_status` group by id_artikel) and artikel_status.kode_status in ('plri')");   
        return $countNotifChiefEditor;
    }

    public function countApprove(){
        $countNotifApprove = DB::select("select count(id_invoice) as jumlah from approve_payment where status='0'");
        return $countNotifApprove;
    }
}