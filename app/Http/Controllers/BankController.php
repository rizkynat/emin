<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use DB;

class BankController extends Controller
{
    public function show(){
        if(Session::get('login')==null){
            return redirect('login')->with('alert','Anda belum login, silahkan login terlebih dahulu');
        }
        else{
            $banks = DB::table('bank')->paginate(5);
            return view('home.list-bank', ['banks'=>$banks]);
        }
    }

    public function cari(Request $request){
        $cari = $request->cari;

        $bank = DB::table('bank');
        $columns = array('nama_bank','no_rek','atas_nama','email');
        $resultsArray = array();

        foreach($columns as $column){
            $bank = $bank->orWhere($column,'like', "%".$cari."%");
        }
        $banks = $bank->paginate();
        return view('home.list-bank', ['banks'=>$banks]);
    }

    public function changeDefault(Request $request){
        $banks = Bank::find($request->id_bank);
        $banks->default = $request->default;
        $banks->save();
    }

    public function tambahBankShow(){
        if(Session::get('login')==null){
            return redirect('login')->with('alert','Anda belum login, silahkan login terlebih dahulu');
        }
        else{
            return view('home.tambah-bank');
        }
    }

    public function tambahBankProses(Request $request){
        $validator = Validator::make($request->all(), [
            'nama_bank' => 'required',
            'no_rek' => 'required|min:8|unique:bank',
            'atas_nama' => 'required',
            'email' => 'required|'
        ]);

        if(!$validator->fails()){
            $validated_data = $request->all();
            $editor = new Bank();
            $editor->fill($validated_data);
            $editor->save();
            return redirect('list-bank')->with('alert-success','Data bank berhasil ditambahkan!');
        }else{
            $arrayValidator = $validator->messages();
            
            return redirect('tambah-bank')->with('alert','Isi data dengan baik dan lengkap, Nama Rekening harus bersifat unik dengan minimal 8 digit');
        }
    }

    public function editBankShow($id_bank){
        if(Session::get('login')==null){
            return redirect('login')->with('alert','Anda belum login, silahkan login terlebih dahulu');
        }
        else{
            $banks = DB::select('select * from bank where id_bank= ?',[$id_bank]);
            return view('home.edit-bank', ['banks'=>$banks]);
        }
    }

    public function editBankProses(Request $request, $id_bank){
        $nama_bank = $request->input('nama_bank');
        $no_rek = $request->input('no_rek');
        $atas_nama = $request->input('atas_nama');
        $email = $request->input('email');

        DB::update('update bank set nama_bank=?, no_rek=?, atas_nama=?, email=? where id_bank=?',
        [$nama_bank, $no_rek, $atas_nama, $email, $id_bank]);
        return redirect('list-bank')->with('alert-success','Data bank berhasil diubah!');
    }

    public function hapusBankProses(Request $request, $id_bank){
        $bank = DB::table('bank')->where('id_bank',$id_bank)->delete();
        return redirect('list-bank')->with('alert-success','Data bank berhasil dihapus!');
    }
}
