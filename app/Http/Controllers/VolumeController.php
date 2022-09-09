<?php

namespace App\Http\Controllers;

use App\Models\Volume;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use DB;

class VolumeController extends Controller
{
    public function show(){
        if(Session::get('login')==null){
            return redirect('login')->with('alert','Anda belum login, silahkan login terlebih dahulu');
        }
        else{
            DB::statement("SET lc_time_names = 'id_ID';");
            $volumes = DB::table('volume')
            ->join('bank', 'volume.id_bank','=','bank.id_bank')
            ->select('volume.id_volume','volume.id_bank',DB::raw("DATE_FORMAT(volume.tahun, '%e %M %Y') as tahun"),'volume.no_volume','volume.harga','volume.status','bank.id_bank', 'bank.nama_bank', 'bank.no_rek')->paginate(10);
            return view('home.list-volume', ['volumes'=>$volumes]);
        }
    }

    public function cari(Request $request){
        $cari = $request->cari;
        
        DB::statement("SET lc_time_names = 'id_ID';");
        $volume = DB::table('volume')
        ->join('bank', 'volume.id_bank','=','bank.id_bank')
        ->select('volume.id_volume','volume.id_bank',DB::raw("DATE_FORMAT(volume.tahun, '%e %M %Y') as tahun"),'volume.no_volume','volume.harga','volume.status','bank.id_bank', 'bank.nama_bank', 'bank.no_rek');
        $columns = array('bank.nama_bank','bank.no_rek','volume.tahun','volume.no_volume','volume.harga');
        $resultsArray = array();

        foreach($columns as $column){
            $volume = $volume->orWhere($column,'like', "%".$cari."%");
        }
        $volumes = $volume->paginate(10);
        return view('home.list-volume', ['volumes'=>$volumes]);
    }

    public function changeStatus(Request $request){
        $volumes = Volume::find($request->id_volume);
        $volumes->status = $request->status;
        $volumes->save();
    }

    public function tambahVolumeShow(){
        if(Session::get('login')==null){
            return redirect('login')->with('alert','Anda belum login, silahkan login terlebih dahulu');
        }
        else{
            $volumes = DB::select('select id_bank, nama_bank, no_rek  from bank where status= "1"');
            return view('home.tambah-volume',['volumes'=>$volumes]);
        }
    }

    public function tambahVolumeProses(Request $request){
        $validator = Validator::make($request->all(), [
            'tahun' => 'required',
            'no_volume' => 'required',
            'harga' => 'required',
        ]);

        if(!$validator->fails()){
            $validated_data = $request->all();
            $editor = new Volume();
            $editor->fill($validated_data);
            $editor->save();
            return redirect('list-volume')->with('alert-success','Data volume berhasil ditambahkan!');
        }else{
            $arrayValidator = $validator->messages();
            
            return redirect('tambah-volume')->with('alert','Isi data dengan baik dan lengkap');
        }
    }

    public function editVolumeShow($id_volume){
        if(Session::get('login')==null){
            return redirect('login')->with('alert','Anda belum login, silahkan login terlebih dahulu');
        }
        else{
            $banks_status = DB::select('select id_bank, nama_bank, no_rek  from bank where status= "1"');
            $volumes = DB::select('select *  from volume v inner join bank b on v.id_bank=b.id_bank where v.id_volume= ?',[$id_volume]);
            return view('home.edit-volume', ['volumes'=>$volumes], ['banks_status'=>$banks_status]);
        }
    }

    public function editVolumeProses(Request $request, $id_volume){
        $id_bank = $request->input('id_bank');
        $tahun = $request->input('tahun');
        $no_volume = $request->input('no_volume');
        $harga = $request->input('harga');

        DB::update('update volume set id_bank=?, tahun=?, no_volume=?, harga=? where id_volume=?',
        [$id_bank, $tahun, $no_volume, $harga, $id_volume]);
        return redirect('list-volume')->with('alert-success','Data volume berhasil diubah!');
    }

    public function hapusVolumeProses(Request $request, $id_volume){
        $bank = DB::table('volume')->where('id_volume',$id_volume)->delete();
        return redirect('list-volume')->with('alert-success','Data volume berhasil dihapus!');
    }

}