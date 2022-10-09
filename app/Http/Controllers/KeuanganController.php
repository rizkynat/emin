<?php

namespace App\Http\Controllers;

use App\Models\Keuangan;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\Exports\KeuanganExport;
use DB;
use Excel;

class KeuanganController extends Controller
{
    public function show(){
        if(Session::get('login')==null){
            return redirect('login')->with('alert','Anda belum login, silahkan login terlebih dahulu');
        }
        else{
            DB::statement("SET lc_time_names = 'id_ID';");
            $volumes = DB::select('select distinct no_volume from volume');
            $uangMasuk = DB::select("select sum(nominal) as nominal from keuangan where status='Uang masuk'");
            $uangKeluar = DB::select("select sum(nominal) as nominal from keuangan where status='Uang keluar'");
            $keuangans = DB::table('keuangan')
            ->latest('id_keuangan')
            ->select('keuangan.deskripsi', 'keuangan.id_keuangan', 'keuangan.status', 'keuangan.foto_kwitansi', 'keuangan.nominal', DB::raw("DATE_FORMAT(keuangan.tgl_keuangan, '%e %M %Y') as tgl_keuangan"))->paginate(10);
            return view('home.list-keuangan', ['keuangans'=>$keuangans,'volumes'=>$volumes, 'uangMasuk'=>$uangMasuk, 'uangKeluar'=>$uangKeluar]);
        }
    }

    public function cari(Request $request){
        $cari = $request->cari;
        
        DB::statement("SET lc_time_names = 'id_ID';");
        $volumes = DB::select('select distinct no_volume from volume');
        $uangMasuk = DB::select("select sum(nominal) as nominal from keuangan where status='Uang masuk'");
        $uangKeluar = DB::select("select sum(nominal) as nominal from keuangan where status='Uang keluar'");
        $keuangan = DB::table('keuangan')
        ->latest('id_keuangan')
        ->select('keuangan.deskripsi', 'keuangan.id_keuangan', 'keuangan.status', 'keuangan.foto_kwitansi', 'keuangan.nominal', DB::raw("DATE_FORMAT(keuangan.tgl_keuangan, '%e %M %Y') as tgl_keuangan"));
        $columns = array('keuangan.deskripsi','keuangan.status','keuangan.nominal','keuangan.tgl_keuangan');
        $resultsArray = array();

        foreach($columns as $column){
            $keuangan = $keuangan->orWhere($column,'like', "%".$cari."%");
        }
        $keuangans = $keuangan->paginate(10);
        return view('home.list-keuangan', ['keuangans'=>$keuangans, 'volumes'=>$volumes, 'uangMasuk'=>$uangMasuk, 'uangKeluar'=>$uangKeluar]);
    }

    public function filter(Request $request, $kode_status){
        if(Session::get('login')==null){
            return redirect('login')->with('alert','Anda belum login, silahkan login terlebih dahulu');
        }
        else{
            $filter = $kode_status;
            DB::statement("SET lc_time_names = 'id_ID';");
            $volumes = DB::select('select distinct no_volume from volume');
            $filter_volumes = DB::select("select invoice.id_invoice from artikel join invoice on invoice.id_artikel=artikel.id_artikel join volume on volume.id_volume=artikel.id_volume where volume.no_volume like '%".$filter."%'"); 
            $filter_array = array();
                foreach($filter_volumes as $filter_volume){
                    array_push($filter_array, str_pad(substr($filter_volume->id_invoice, 0, 4), 4, '0', STR_PAD_LEFT).'/INV/JKT/PCR/'.date('Y'));
                }
            $uangMasuk = DB::select("select sum(nominal) as nominal from keuangan where status='Uang masuk'");
            $uangKeluar = DB::select("select sum(nominal) as nominal from keuangan where status='Uang keluar'");
            $keuangans = DB::table('keuangan')
            ->whereIn('keuangan.deskripsi', $filter_array)
            ->latest('id_keuangan')
            ->select('keuangan.deskripsi', 'keuangan.id_keuangan', 'keuangan.status', 'keuangan.foto_kwitansi', 'keuangan.nominal', DB::raw("DATE_FORMAT(keuangan.tgl_keuangan, '%e %M %Y') as tgl_keuangan"))->paginate(10);
            return view('home.list-keuangan', ['keuangans'=>$keuangans,'volumes'=>$volumes, 'uangMasuk'=>$uangMasuk, 'uangKeluar'=>$uangKeluar]);
        }
    }

    public function tambahKeuanganShow(){
        if(Session::get('login')==null){
            return redirect('login')->with('alert','Anda belum login, silahkan login terlebih dahulu');
        }
        else{
            if(Session::get('role')!='bendahara'){
                return Redirect::to(url()->previous())->with('alert','Hanya bendahara yang dapat mengakses halaman "Tambah Keuangan" !');
            }else{
            return view('home.tambah-keuangan');
            }
        }
    }

    public function tambahKeuanganProses(Request $request){
        
        $validator = Validator::make($request->all(), [
            'deskripsi' => 'required',
            'status' => 'required',
            'foto_kwitansi' => 'required',
            'nominal' => 'required',
            'tgl_keuangan'=>'required'
        ]);

        if(!$validator->fails()){
            $deskripsi = $request->deskripsi;
            $status = $request->status;
            $foto_kwitansi = $request->file('foto_kwitansi');
            $extension = pathinfo($foto_kwitansi->getClientOriginalName(), PATHINFO_EXTENSION);
            $filename = date('YmdHi').'_Keuangan.'.$extension;
            $foto_kwitansi -> move(public_path('images/keuangan/'), $filename);
            $nominal = $request->nominal;
            $tgl_keuangan = $request->tgl_keuangan;

            DB::insert('insert into keuangan (deskripsi, status, foto_kwitansi, nominal, tgl_keuangan) values(?, ?, ?, ?, ?)', [$deskripsi, $status, $filename, $nominal, $tgl_keuangan]);
            return redirect('list-keuangan/')->with('alert-success','Data keuangan berhasil ditambahkan'); 
        }else{
            return redirect('tambah-keuangan/')->with('alert','Isi data dengan baik dan lengkap');
        }
    }

    public function editKeuanganShow($id_keuangan){
        if(Session::get('login')==null){
            return redirect('login')->with('alert','Anda belum login, silahkan login terlebih dahulu');
        }else{
            if(Session::get('role')!='bendahara'){
                return Redirect::to(url()->previous())->with('alert','Hanya bendahara yang dapat mengakses halaman "Tambah Keuangan" !');
            }else{
                $keuangans = DB::select('select * from keuangan where id_keuangan= ?',[$id_keuangan]);
                return view('home.edit-keuangan', ['keuangans'=>$keuangans]);
        }
        }
    }

    public function editKeuanganProses(Request $request, $id_keuangan){
        $keuangan = Keuangan::find($id_keuangan);

        $deskripsi = $request->input('deskripsi');
        $foto_kwitansi = $request->file('foto_kwitansi');
        $nominal = $request->input('nominal');
        $tgl_keuangan = $request->input('tgl_keuangan');

        if($request->foto_kwitansi == NULL){
            DB::update('update keuangan set deskripsi=?, nominal=?, tgl_keuangan=? where id_keuangan=?',
            [$deskripsi, $nominal, $tgl_keuangan, $id_keuangan]);
        }else{
            $extension = pathinfo($foto_kwitansi->getClientOriginalName(), PATHINFO_EXTENSION);
            $filename = date('YmdHi').'_Keuangan.'.$extension;
            $path = public_path('images/keuangan/').$keuangan->foto_kwitansi;
            unlink($path);
            $foto_kwitansi->move(public_path('images/keuangan/'), $filename);

            DB::update('update keuangan set deskripsi=?, foto_kwitansi=?, nominal=?, tgl_keuangan=? where id_keuangan=?', [$deskripsi, $filename, $nominal, $tgl_keuangan, $id_keuangan]);
        }
        return redirect('list-keuangan')->with('alert-success','Data keuangan berhasil diubah!');
    }

    public function hapusKeuanganProses(Request $request, $id_keuangan){
        $keuangan = Keuangan::find($id_keuangan);

        $path = public_path('images/keuangan/').$keuangan->foto_kwitansi;
        unlink($path);
        $artikel = DB::table('keuangan')->where('id_keuangan',$id_keuangan)->delete();
        return redirect('list-keuangan')->with('alert-success','Data keuangan berhasil dihapus!');
    }

    public function excelKeuanganProses(Request $request){
        Return Excel::download(new KeuanganExport, 'Data_Keuangan.xlsx');
    }

    public function csvKeuanganProses(Request $request){
        Return Excel::download(new KeuanganExport, 'Data_Keuangan.csv');
    }

}