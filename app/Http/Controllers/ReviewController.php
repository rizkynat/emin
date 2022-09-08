<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use DB;

class ReviewController extends Controller
{
    public function show($id_artikel){
        if(Session::get('login')==null){
            return redirect('login')->with('alert','Anda belum login, silahkan login terlebih dahulu');
        }
        else{
            DB::statement("SET lc_time_names = 'id_ID';");
            $historys_review = DB::select('select id_history_review, id_review, isi_history, tgl_history from history_review');
            $reviews = DB::table('review')
            ->join('reviewer', 'review.id_reviewer','=','reviewer.id_reviewer')
            ->join('artikel', 'review.id_artikel','=','artikel.id_artikel')
            ->where('artikel.id_artikel',$id_artikel)
            ->select('review.id_review','review.catatan', 'review.id_artikel', DB::raw("DATE_FORMAT(review.tgl_review, '%d %M %Y') as tanggal"),'reviewer.nama_reviewer','artikel.nama_penulis','artikel.judul_artikel')->paginate(2);
            return view('home.list-review', ['reviews'=>$reviews], ['historys_review'=>$historys_review]);
        }
    }

    public function tambahReviewShow($id_artikel){
        if(Session::get('login')==null){
            return redirect('list-artikel')->with('alert','Anda belum login, silahkan login terlebih dahulu');
        }
        else{
            if(Session::get('role')!='chief editor'){
                return redirect('list-artikel')->with('alert','Hanya chief editor yang dapat mengakses fitur ini!');
            }else{
            DB::statement("SET lc_time_names = 'id_ID';");
            $reviewers = DB::select('select id_reviewer, nama_reviewer, kategori from reviewer');
            $artikel = DB::select('select judul_artikel from artikel where id_artikel='.$id_artikel);
            return view('home.tambah-review',['reviewers'=>$reviewers, 'artikel'=>$artikel])->with('id_artikel',$id_artikel);
            }
        }
    }

    public function tambahReviewProses(Request $request, $id_artikel){
        
        $validator = Validator::make($request->all(), [
            'id_reviewer_internal' => 'required',
            'catatan_internal' => 'required',
            'id_reviewer_eksternal' => 'required',
            'catatan_eksternal' => 'required'
        ]);

        if(!$validator->fails()){
            $id_artikel_internal = $id_artikel;
            $id_reviewer_internal = $request->id_reviewer_internal;
            $catatan_internal = $request->catatan_internal;
            
            $id_artikel_eksternal = $id_artikel;
            $id_reviewer_eksternal = $request->id_reviewer_eksternal;
            $catatan_eksternal = $request->catatan_eksternal;

            DB::insert('insert into review (id_artikel, id_reviewer, catatan) values (?, ? , ?)', [$id_artikel_internal, $id_reviewer_internal, $catatan_internal]);
            DB::insert('insert into review (id_artikel, id_reviewer, catatan) values (?, ? , ?)', [$id_artikel_eksternal, $id_reviewer_eksternal, $catatan_eksternal]);
            DB::insert('insert into artikel_status (kode_status, id_artikel) values(?, ?)',['ir', $id_artikel]);
            

            if($catatan_eksternal == 'Accepted' and $catatan_internal == 'Accepted'){
                DB::insert('insert into artikel_status (kode_status, id_artikel) values(?, ?)',['rd', $id_artikel]);
            }elseif($catatan_eksternal == 'Revisi' and $catatan_internal == 'Revisi'){
                DB::insert('insert into artikel_status (kode_status, id_artikel) values(?, ?)',['sa', $id_artikel]);
            }elseif(($catatan_internal == 'Revisi' and $catatan_eksternal == 'Accepted') or ($catatan_eksternal=='Revisi' and $catatan_internal=='Accepted')){
                DB::insert('insert into artikel_status (kode_status, id_artikel) values(?, ?)',['sa', $id_artikel]);
            }
                 
            return redirect('list-review/'.$id_artikel)->with('alert-success','Data review berhasil ditambahkan');
        }else{
            return redirect('tambah-review/'.$id_artikel)->with('alert','Isi data dengan baik dan lengkap');
        }
    }

    public function editReviewShow($id_review, $id_artikel){
        if(Session::get('login')==null){
            return redirect('login')->with('alert','Anda belum login, silahkan login terlebih dahulu');
        }
        else{
            if(Session::get('role')!='chief editor'){
                return redirect('list-review/'.$id_artikel)->with('alert','Hanya chief editor yang dapat mengakses fitur ini!');
            }else{
            $artikel = DB::select('select judul_artikel from artikel where id_artikel='.$id_artikel);
            $reviews = DB::select('select a.catatan, a.id_review, a.id_reviewer, r.kategori, r.nama_reviewer, a.id_artikel  from review a inner join reviewer r on a.id_reviewer=r.id_reviewer where a.id_review= ?',[$id_review]);
            return view('home.edit-review', ['reviews'=>$reviews, 'artikel'=>$artikel]);
            }
        }
    }

    public function editReviewProses(Request $request,$id_artikel, $id_review, $kategori){
        if($kategori == 'Internal'){
            $id_reviewer_internal = $request->input('id_reviewer_internal');
            $catatan_internal = $request->input('catatan_internal');
            DB::insert('insert into history_review (id_review, isi_history) values (?, ? )', [$id_review, $catatan_internal]);
            DB::update('update review set id_reviewer=?, catatan=? where id_review=?',
            [$id_reviewer_internal, $catatan_internal, $id_review]);

            $this->checkReview($id_artikel);
            return redirect('list-review/'.$id_artikel)->with('alert-success', 'Data review berhasil diubah');
        }else{
            $id_reviewer_eksternal = $request->input('id_reviewer_eksternal');
            $catatan_eksternal = $request->input('catatan_eksternal');
            DB::insert('insert into history_review (id_review, isi_history) values (?, ? )', [$id_review, $catatan_eksternal]);
            DB::update('update review set id_reviewer=?, catatan=? where id_review=?',
            [$id_reviewer_eksternal, $catatan_eksternal, $id_review]);

            $this->checkReview($id_artikel);
            return redirect('list-review/'.$id_artikel)->with('alert-success', 'Data review berhasil diubah');
        }
    }

    public function  checkReview($id_artikel){
        $data = DB::select('select * from review where id_artikel=?',[$id_artikel]);
            if($data[0]->catatan == 'Revisi' and $data[1]->catatan=='Revisi'){
                DB::insert('insert into artikel_status (kode_status, id_artikel) values(?, ?)',['sa', $id_artikel]);
            }elseif($data[0]->catatan=='Accepted' and $data[1]->catatan == 'Accepted'){
                DB::insert('insert into artikel_status (kode_status, id_artikel) values(?, ?)',['rd', $id_artikel]);
            }
    }

}
