<?php

namespace App\Http\Controllers;

use App\Models\Reviewer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use DB;

class ReviewerController extends Controller
{
    public function show(){
        if(Session::get('login')==null){
            return redirect('login')->with('alert','Anda belum login, silahkan login terlebih dahulu');
        }
        else{
            $reviewers = DB::table('reviewer')->latest('id_reviewer')->paginate(10);
            return view('home.list-reviewer', ['reviewers'=>$reviewers]);
        }
    }

    public function cari(Request $request){
        $cari = $request->cari;

        $reviewer = DB::table('reviewer')->latest('id_reviewer');
        $columns = array('nama_reviewer','kategori','instansi');
        $resultsArray = array();

        foreach($columns as $column){
            $reviewers = $reviewer->orWhere($column,'like', "%".$cari."%");
        }
        $reviewers = $reviewers->paginate(10);
        return view('home.list-reviewer', ['reviewers'=>$reviewers]);
    }

    public function tambahReviewerShow(){
        if(Session::get('login')==null){
            return redirect('login')->with('alert','Anda belum login, silahkan login terlebih dahulu');
        }
        else{
            return view('home.tambah-reviewer');
        }
    }

    public function tambahReviewerProses(Request $request){
        $validator = Validator::make($request->all(), [
            'nama_reviewer' => 'required',
            'kategori' => 'required',
            'instansi' => 'required'
        ]);

        if(!$validator->fails()){
            $validated_data = $request->all();
            $editor = new Reviewer();
            $editor->fill($validated_data);
            $editor->save();
            return redirect('list-reviewer')->with('alert-success','Data reviewer berhasil ditambahkan!');
        }else{
            $arrayValidator = $validator->messages();
            
            return redirect('tambah-reviewer')->with('alert','Isi data dengan baik dan lengkap');
        }
    }

    public function editReviewerShow($id_reviewer){
        if(Session::get('login')==null){
            return redirect('login')->with('alert','Anda belum login, silahkan login terlebih dahulu');
        }
        else{
            $reviewers_all = DB::select('select id_reviewer, kategori  from reviewer');
            $reviewers = DB::select('select * from reviewer where id_reviewer= ?',[$id_reviewer]);
            return view('home.edit-reviewer', ['reviewers'=>$reviewers], ['reviewers_all'=>$reviewers_all]);
        }
    }

    public function editReviewerProses(Request $request, $id_reviewer){
        $nama_reviewer = $request->input('nama_reviewer');
        $kategori = $request->input('kategori');
        $instansi = $request->input('instansi');

        DB::update('update reviewer set nama_reviewer=?, kategori=?, instansi=? where id_reviewer=?',
        [$nama_reviewer, $kategori, $instansi, $id_reviewer]);
        return redirect('list-reviewer')->with('alert-success','Data reviewer berhasil diubah!');
    }

    public function hapusReviewerProses(Request $request, $id_reviewer){
        $reviewer = DB::table('reviewer')->where('id_reviewer',$id_reviewer)->delete();
        return redirect('list-reviewer')->with('alert-success','Data reviewer berhasil dihapus!');
    }

}