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
    public function test($id_artikel){
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
            
           
            
            $artikel = DB::select('select * from artikel where id_artikel=?',[$id_artikel]);
            return $artikel;
    }



}