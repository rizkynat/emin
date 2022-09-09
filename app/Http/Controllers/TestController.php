<?php

namespace App\Http\Controllers;

use App\Models\ArtStatus;
use App\Models\Bayar;
use App\Models\Invoice;
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
    public function test($id_bayar){
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
            
            $uangMasuk = DB::select("select sum(nominal) as nominal from keuangan where status='Uang masuk'");
            $kode_statuss = DB::select("select id_artikel from artikel_status join status on artikel_status.kode_status=status.kode_status where id_artikel_status in (select max(id_artikel_status) from `artikel_status` group by id_artikel) and artikel_status.kode_status='".$id_bayar."'");
            $filter_array = array();
            foreach($kode_statuss as $kode_status){
                array_push($filter_array, $kode_status->id_artikel);
            }
            return $filter_array;
    }



}