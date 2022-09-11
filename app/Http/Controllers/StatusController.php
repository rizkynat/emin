<?php

namespace App\Http\Controllers;

use App\Models\Status;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use DB;

class StatusController extends Controller
{
    public function show(){
        if(Session::get('login')==null){
            return redirect('login')->with('alert','Anda belum login, silahkan login terlebih dahulu');
        }
        else{
            $statuss = DB::table('status')->paginate(10);
            return view('home.list-status', ['statuss'=>$statuss]);
        }
    }

    public function cari(Request $request){
        $cari = $request->cari;

        $status = DB::table('status');
        $columns = array('kode_status','keterangan_status');
        $resultsArray = array();

        foreach($columns as $column){
            $statuss = $status->orWhere($column,'like', "%".$cari."%");
        }
        $statuss = $statuss->paginate(10);
        return view('home.list-status', ['statuss'=>$statuss]);
    }

    public function tambahStatusShow(){
        if(Session::get('login')==null){
            return redirect('login')->with('alert','Anda belum login, silahkan login terlebih dahulu');
        }
        else{
            return view('home.tambah-status');
        }
    }

    public function tambahStatusProses(Request $request){
        $validator = Validator::make($request->all(), [
            'kode_status' => 'required|unique:status',
            'keterangan_status' => 'required|unique:status'
        ]);

        if(!$validator->fails()){
            $validated_data = $request->all();
            $status = new Status();
            $status->fill($validated_data);
            $status->save();
            return redirect('list-status')->with('alert-success','Data status berhasil ditambahkan!');
        }else{
            $arrayValidator = $validator->messages();
            
            return redirect('tambah-status')->with('alert','Isi data dengan baik dan lengkap, Kode status dan Keterangan status harus harus bersifat unik');
        }
    }

    public function hapusStatusProses(Request $request, $kode_status){
        $bank = DB::table('status')->where('kode_status',$kode_status)->delete();
        return redirect('list-status')->with('alert-success','Data status berhasil dihapus!');
    }

    public function editStatusShow($kode_status){
        if(Session::get('login')==null){
            return redirect('login')->with('alert','Anda belum login, silahkan login terlebih dahulu');
        }
        else{
            $statuss = DB::select('select * from status where kode_status= ?',[$kode_status]);
            return view('home.edit-status', ['statuss'=>$statuss]);
        }
    }

    public function editStatusProses(Request $request, $kode_status){
        $id_status = $request->input('kode_status');
        $ket_status = $request->input('keterangan_status');

        DB::update('update status set kode_status=?, keterangan_status=? where kode_status=?',
        [$id_status, $ket_status, $kode_status]);
        return redirect('list-status')->with('alert-success','Data status berhasil diubah!');
    }



}