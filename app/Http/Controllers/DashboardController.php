<?php

namespace App\Http\Controllers;

use App\Editor;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use DB;

class DashboardController extends Controller
{
    public function show(){
        if(Session::get('role')=='editor' or Session::get('role')=='chief editor' or Session::get('role')=='bendahara'){
            $currentYear = date('Y');
            $dataUangMasuk = [];
            $dataUangKeluar = [];
            $bulanUangMasuk = [];
            $bulanUangKeluar = [];
            $nominalUangMasuk = [];
            $nominalUangKeluar = [];
            $jml_status = [];
            $status = [];

            $bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
            DB::statement("SET lc_time_names = 'id_ID';");
            $tahun = DB::select("select  DATE_FORMAT(keuangan.tgl_keuangan, '%Y') as tahun  from keuangan GROUP BY  DATE_FORMAT(keuangan.tgl_keuangan, '%Y');");
            $currentUangMasuk = DB::select("select sum(nominal) as nominal, DATE_FORMAT(keuangan.tgl_keuangan, '%M') as bulan from keuangan where tgl_keuangan like '%".$currentYear."%' and status='Uang masuk' GROUP BY DATE_FORMAT(keuangan.tgl_keuangan, '%M')");
            $currentUangKeluar = DB::select("select sum(nominal) as nominal, DATE_FORMAT(keuangan.tgl_keuangan, '%M') as bulan from keuangan where tgl_keuangan like '%".$currentYear."%' and status='Uang keluar' GROUP BY DATE_FORMAT(keuangan.tgl_keuangan, '%M')");
            $kode_statuss = DB::select("select count(artikel_status.kode_status) as jumlah, status.keterangan_status from artikel_status join status on artikel_status.kode_status=status.kode_status where id_artikel_status in (select max(id_artikel_status) from `artikel_status` group by id_artikel) group by status.keterangan_status;");

            foreach($kode_statuss as $kode_status){
                array_push($jml_status, $kode_status->jumlah);
                array_push($status, $kode_status->keterangan_status);
            }
            foreach($currentUangKeluar as $c){
                array_push($bulanUangKeluar, $c->bulan);
                array_push($nominalUangKeluar, $c->nominal);
            }
            foreach($currentUangMasuk as $c){
                array_push($bulanUangMasuk, $c->bulan);
                array_push($nominalUangMasuk, $c->nominal);
            }
            foreach($bulan as $m){
                if(in_array($m, $bulanUangKeluar)){
                   $index = array_search($m, $bulanUangKeluar);
                    array_push($dataUangKeluar, $nominalUangKeluar[$index]);
                }else{
                    array_push($dataUangKeluar, "0");
                }
            }
            foreach($bulan as $m){
                if(in_array($m, $bulanUangMasuk)){
                   $index = array_search($m, $bulanUangMasuk);
                    array_push($dataUangMasuk, $nominalUangMasuk[$index]);
                }else{
                    array_push($dataUangMasuk, "0");
                }
            }
            return view('home.dashboard', ["tahuns"=>$tahun])
            ->with('uangMasuk', json_encode($dataUangMasuk, JSON_NUMERIC_CHECK))
            ->with('uangKeluar', json_encode($dataUangKeluar, JSON_NUMERIC_CHECK))
            ->with('bulan', json_encode($bulan, JSON_NUMERIC_CHECK))
            ->with('currentYear', json_encode($currentYear, JSON_NUMERIC_CHECK))
            ->with('jml_status', json_encode($jml_status, JSON_NUMERIC_CHECK))
            ->with('status', json_encode($status, JSON_NUMERIC_CHECK));
        }
        else{
            return redirect('login')->with('alert','Anda belum login, silahkan login terlebih dahulu');
        }
    }

    public function filter(Request $request, $tahun){
        if(Session::get('role')=='editor' or Session::get('role')=='chief editor' or Session::get('role')=='bendahara'){
            $filter = $tahun;
            $dataUangMasuk = [];
            $dataUangKeluar = [];
            $bulanUangMasuk = [];
            $bulanUangKeluar = [];
            $nominalUangMasuk = [];
            $nominalUangKeluar = [];
            $jml_status = [];
            $status = [];

            $bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
            DB::statement("SET lc_time_names = 'id_ID';");
            $tahun = DB::select("select  DATE_FORMAT(keuangan.tgl_keuangan, '%Y') as tahun  from keuangan GROUP BY  DATE_FORMAT(keuangan.tgl_keuangan, '%Y');");
            $currentUangMasuk = DB::select("select sum(nominal) as nominal, DATE_FORMAT(keuangan.tgl_keuangan, '%M') as bulan from keuangan where tgl_keuangan like '%".$filter."%' and status='Uang masuk' GROUP BY DATE_FORMAT(keuangan.tgl_keuangan, '%M')");
            $currentUangKeluar = DB::select("select sum(nominal) as nominal, DATE_FORMAT(keuangan.tgl_keuangan, '%M') as bulan from keuangan where tgl_keuangan like '%".$filter."%' and status='Uang keluar' GROUP BY DATE_FORMAT(keuangan.tgl_keuangan, '%M')");
            $kode_statuss = DB::select("select count(artikel_status.kode_status) as jumlah, status.keterangan_status from artikel_status join status on artikel_status.kode_status=status.kode_status where id_artikel_status in (select max(id_artikel_status) from `artikel_status` group by id_artikel) group by status.keterangan_status;");

            foreach($kode_statuss as $kode_status){
                array_push($jml_status, $kode_status->jumlah);
                array_push($status, $kode_status->keterangan_status);
            }
            foreach($currentUangKeluar as $c){
                array_push($bulanUangKeluar, $c->bulan);
                array_push($nominalUangKeluar, $c->nominal);
            }
            foreach($currentUangMasuk as $c){
                array_push($bulanUangMasuk, $c->bulan);
                array_push($nominalUangMasuk, $c->nominal);
            }
            foreach($bulan as $m){
                if(in_array($m, $bulanUangKeluar)){
                   $index = array_search($m, $bulanUangKeluar);
                    array_push($dataUangKeluar, $nominalUangKeluar[$index]);
                }else{
                    array_push($dataUangKeluar, "0");
                }
            }
            foreach($bulan as $m){
                if(in_array($m, $bulanUangMasuk)){
                   $index = array_search($m, $bulanUangMasuk);
                    array_push($dataUangMasuk, $nominalUangMasuk[$index]);
                }else{
                    array_push($dataUangMasuk, "0");
                }
            }
            return view('home.dashboard', ["tahuns"=>$tahun])
            ->with('uangMasuk', json_encode($dataUangMasuk, JSON_NUMERIC_CHECK))
            ->with('uangKeluar', json_encode($dataUangKeluar, JSON_NUMERIC_CHECK))
            ->with('bulan', json_encode($bulan, JSON_NUMERIC_CHECK))
            ->with('currentYear', json_encode($filter, JSON_NUMERIC_CHECK))
            ->with('jml_status', json_encode($jml_status, JSON_NUMERIC_CHECK))
            ->with('status', json_encode($status, JSON_NUMERIC_CHECK));
        }
        else{
            return redirect('login')->with('alert','Anda belum login, silahkan login terlebih dahulu');
        }
    }
}
