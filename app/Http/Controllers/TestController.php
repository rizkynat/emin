<?php

namespace App\Http\Controllers;

use App\Models\Approve;
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
    public function test($id_approve){
        session_start();
        echo session_id();
        $approve = Approve::find($id_approve);
        $isFile = 'images/temp/'.$approve->bukti_bayar;
        $pindah = copy($isFile, 'images/bukti_bayar/'.$approve->bukti_bayar);
        return $approve;
    }



}