<?php

namespace App\Http\Controllers;

use App\Models\LOA;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use DB;
use PDF;

class LOAController extends Controller
{
    public function show(){
        if(Session::get('login')==null){
            return redirect('login')->with('alert','Anda belum login, silahkan login terlebih dahulu');
        }
        else{
            DB::statement("SET lc_time_names = 'id_ID';");
            $loas = DB::table('loa')
            ->join('artikel','artikel.id_artikel', '=','loa.id_artikel')
            ->join('volume', 'artikel.id_volume','=','volume.id_volume')
            ->select('artikel.judul_artikel', 'loa.id_loa', DB::raw("DATE_FORMAT(loa.tgl_loa, '%d %M %Y') as tgl_loa"))->paginate(5);
            return view('home.list-loa', ['loas'=>$loas]);
        }
    }

    public function pdfLOAShow($id_loa){
        if(Session::get('login')==null){
            return redirect('login')->with('alert','Anda belum login, silahkan login terlebih dahulu');
        }
        else{
            DB::statement("SET lc_time_names = 'id_ID';");
            
            $loas = DB::table('loa')
            ->join('artikel','artikel.id_artikel', '=','loa.id_artikel')
            ->join('volume', 'artikel.id_volume','=','volume.id_volume')
            ->where('loa.id_loa',$id_loa)
            ->select('artikel.judul_artikel', 'artikel.nama_penulis', 'volume.no_volume', DB::raw("DATE_FORMAT(volume.tahun, '%M %Y') as tahun"), 'artikel.judul_artikel', 'artikel.instansi', 'loa.id_loa', DB::raw("DATE_FORMAT(loa.tgl_loa, '%d %M %Y') as tgl_loa"))->get();

            return view('home.pdf-loa', ['loas'=>$loas]);
        }
    }

    public function downloadLOAProses($id_loa) {
        set_time_limit(300);
        // retreive all records from db
        DB::statement("SET lc_time_names = 'id_ID';");

        
        $loas = DB::table('loa')
        ->join('artikel','artikel.id_artikel', '=','loa.id_artikel')
        ->join('volume', 'artikel.id_volume','=','volume.id_volume')
        ->where('loa.id_loa',$id_loa)
        ->select('artikel.judul_artikel', 'artikel.nama_penulis', 'volume.no_volume', DB::raw("DATE_FORMAT(volume.tahun, '%M %Y') as tahun"), 'artikel.judul_artikel', 'artikel.instansi', 'loa.id_loa', DB::raw("DATE_FORMAT(loa.tgl_loa, '%d %M %Y') as tgl_loa"))->get();
        // share data to view
        $pdf = PDF::loadView('home.pdf-loa', ['loas'=>$loas]);
        $pdf->setOptions(['isRemoteEnabled' => true]);
        $pdf->setPaper([0, -5, 685.98, 480.85], 'landscape');
        // download PDF file with download method
        return $pdf->download('LOA '.$loas[0]->nama_penulis.'.pdf');
      }

}