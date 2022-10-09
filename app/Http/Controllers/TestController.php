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
    public function test($id_artikel){
        $reviews = DB::table('review')
        ->join('reviewer', 'review.id_reviewer','=','reviewer.id_reviewer')
        ->join('artikel', 'review.id_artikel','=','artikel.id_artikel')
        ->where('artikel.id_artikel',$id_artikel)
        ->select('review.id_review','review.catatan', 'review.id_artikel', DB::raw("DATE_FORMAT(review.tgl_review, '%d %M %Y') as tanggal"),'reviewer.nama_reviewer','artikel.nama_penulis','artikel.judul_artikel')->paginate(2);
        $data = DB::select('select count(*) as jumlah from review where id_artikel=?',[$id_artikel]);
            return $data[0]->jumlah;
    }



}