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
use DB;

class ArtikelController extends Controller
{
    public function show(){
        if(Session::get('login')==null){
            return redirect('login')->with('alert','Anda belum login, silahkan login terlebih dahulu');
        }
        else{
            DB::statement("SET lc_time_names = 'id_ID';");
            /*$kode_statuss = DB::table('artikel_status')
            ->join('artikel','artikel.id_artikel','=','artikel_status.id_artikel')
            ->join('status','status.kode_status','=','artikel_status.kode_status')
            ->select('artikel_status.id_artikel','artikel_status.kode_status',DB::raw('max() as '),'status.keterangan_status')->get();*/
            $reviews = DB::select('select * from review');

            $kode_statuss = DB::select('select * from artikel_status join status on artikel_status.kode_status=status.kode_status where id_artikel_status in (select max(id_artikel_status) from `artikel_status` group by id_artikel)');

            $checkId_artikel = DB::table('review')
            ->join('artikel', 'artikel.id_artikel','=','review.id_artikel')
            ->select('review.id_artikel')
            ->distinct()->get();

            $invoices = DB::select('select * from invoice');
            
            $artikels = DB::table('artikel')
            ->join('volume', 'volume.id_volume','=','artikel.id_volume')
            ->select('artikel.id_artikel','artikel.id_volume','artikel.nama_penulis','artikel.email_penulis','artikel.judul_artikel','artikel.instansi','volume.id_volume', DB::raw("DATE_FORMAT(volume.tahun, '%M %Y') as tahun"), 'volume.no_volume')->paginate(5);
            return view('home.list-artikel',['artikels'=>$artikels,'checks'=>$checkId_artikel,'kode_statuss'=>$kode_statuss, 'reviews'=>$reviews, 'invoices'=>$invoices]);
        }
    }

    public function cari(Request $request){
        $cari = $request->cari;

        DB::statement("SET lc_time_names = 'id_ID';");

        $kode_statuss = DB::table('artikel_status')
        ->join('artikel','artikel.id_artikel','=','artikel_status.id_artikel')
        ->join('status','status.kode_status','=','artikel_status.kode_status')
        ->select('artikel_status.id_artikel','artikel_status.kode_status','status.keterangan_status')->get();

        $checkId_artikel = DB::table('review')
        ->join('artikel', 'artikel.id_artikel','=','review.id_artikel')
        ->select('review.id_artikel')
        ->distinct()->get();

        $artikel = DB::table('artikel')
        ->join('volume', 'artikel.id_volume','=','volume.id_volume')
        ->select('artikel.id_artikel','artikel.id_volume','artikel.nama_penulis','artikel.email_penulis','artikel.judul_artikel','artikel.instansi','volume.no_volume', 'volume.tahun');
        $columns = array('volume.no_volume','volume.tahun','artikel.id_artikel','artikel.nama_penulis','artikel.judul_artikel','artikel.instansi','artikel.email_penulis');
        $resultsArray = array();

        foreach($columns as $column){
            $artikel = $artikel->orWhere($column,'like', "%".$cari."%");
        }
        $artikels = $artikel->paginate();
        return view('home.list-artikel', ['artikels'=>$artikels,'checks'=>$checkId_artikel,'kode_statuss'=>$kode_statuss]);
    }

    public function tambahArtikelShow(){
        if(Session::get('login')==null){
            return redirect('login')->with('alert','Anda belum login, silahkan login terlebih dahulu');
        }
        else{
            DB::statement("SET lc_time_names = 'id_ID';");
            $artikels = DB::select('select id_volume, no_volume, DATE_FORMAT(tahun, "%M %Y") as tahun  from volume where status= "1"');
            return view('home.tambah-artikel',['artikels'=>$artikels]);
        }
    }

    public function tambahArtikelProses(Request $request){
        $validator = Validator::make($request->all(), [
            'id_artikel' => 'required|unique:artikel',
            'id_volume' => 'required',
            'nama_penulis' => 'required',
            'email_penulis' => 'required|min:4|email|',
            'judul_artikel' => 'required|min:20',
            'instansi' => 'required'

        ]);

        $id_artikel = $request->id_artikel;
        $kode_status = 'wr';

        if(!$validator->fails()){
            $validated_data = $request->all();
            $artikel = new Artikel();
            $artikel->fill($validated_data);
            $artikel->save();
            DB::insert('insert into artikel_status (kode_status,id_artikel) values (?, ?)', [$kode_status, $id_artikel]);
            return redirect('list-artikel')->with('alert-success','Data artikel berhasil ditambahkan!');
        }else{
            $arrayValidator = $validator->messages();
            
            return redirect('tambah-artikel')->with('alert','Isi data dengan baik dan lengkap, id artikel tidak boleh sama');
        }
    }

    public function editArtikelShow($id_artikel){
        if(Session::get('login')==null){
            return redirect('login')->with('alert','Anda belum login, silahkan login terlebih dahulu');
        }
        else{
            $volumes_status = DB::select('select id_volume, no_volume, tahun  from volume where status= "1"');
            $artikels = DB::select('select *  from artikel a inner join volume v on a.id_volume=v.id_volume where a.id_artikel= ?',[$id_artikel]);
            return view('home.edit-artikel', ['artikels'=>$artikels], ['volumes_status'=>$volumes_status]);
        }
    }

    public function editArtikelProses(Request $request, $id_artikel){
        $re_id_artikel = $request->input('id_artikel');
        $id_volume = $request->input('id_volume');
        $nama_penulis = $request->input('nama_penulis');
        $email_penulis = $request->input('email_penulis');
        $judul_artikel = $request->input('judul_artikel');
        $instansi = $request->input('instansi');

        DB::update('update artikel set id_artikel=?, id_volume=?, nama_penulis=?, email_penulis=?, judul_artikel=?, instansi=? where id_artikel=?',
        [$re_id_artikel, $id_volume, $nama_penulis, $email_penulis, $judul_artikel, $instansi, $id_artikel]);
        return redirect('list-artikel')->with('alert-success','Data artikel berhasil diubah!');
    }

    public function hapusArtikelProses(Request $request, $id_artikel){
        $artikel = DB::table('artikel')->where('id_artikel',$id_artikel)->delete();
        return redirect('list-artikel')->with('alert-success','Data artikel berhasil dihapus!');
    }
}
