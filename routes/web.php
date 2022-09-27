<?php

use Illuminate\Support\Facades\Route;


Route::group(['namespace' => 'App\Http\Controllers'], function()
{  

//Route::post('/LoginController', 'LoginController');

Route::get('/dashboard', 'DashboardController@show')->name('dashboard.show');
Route::get('/', 'DashboardController@show')->name('dashboard.index');
Route::get('/filter-dashboard/{tahun}','DashboardController@filter')->name('filter-dashboard.show');

Route::group(['middleware' => ['guest']], function() {
    //Login Routes
    Route::get('/login', 'LoginController@show')->name('login.show');
    Route::post('/login', 'LoginController@loginProses')->name('login.proses');

    Route::get('/register', 'RegisterController@show')->name('register.show');
    Route::post('/register', 'RegisterController@registerProses')->name('register.proses');

    Route::get('/list-notifikasi', 'NotifikasiController@show')->name('list-notifikasi.show');

    Route::get('/list-akun', 'EditorController@show')->name('list-akun.show');
    Route::get('/cari-akun','EditorController@cari')->name('cari-akun.show');
    Route::get('/edit-akun/{id_akun}', 'EditorController@editEditorShow')->name('edit-akun.show');
    Route::post('/edit-akun/{id_akun}', 'EditorController@editEditorProses')->name('edit-akun.proses');
    Route::get('/hapus-akun/{id_akun}', 'EditorController@hapusEditorProses')->name('hapus-akun.proses');

    Route::get('/list-artikel', 'ArtikelController@show')->name('list-artikel.show');
    Route::get('/cari-artikel','ArtikelController@cari')->name('cari-artikel.show');
    Route::get('/filter-artikel/{kode_status}','ArtikelController@filter')->name('filter-artikel.show');
    Route::get('/tambah-artikel', 'ArtikelController@tambahArtikelShow')->name('tambah-artikel.show');
    Route::post('/tambah-artikel', 'ArtikelController@tambahArtikelProses')->name('tambah-artikel.proses');
    Route::get('/edit-artikel/{id_artikel}', 'ArtikelController@editArtikelShow')->name('edit-artikel.show');
    Route::post('/edit-artikel/{id_artikel}', 'ArtikelController@editArtikelProses')->name('edit-artikel.proses');
    Route::get('/hapus-artikel/{id_artikel}', 'ArtikelController@hapusArtikelProses')->name('hapus-artikel.proses');
    Route::get('/excel-artikel', 'ArtikelController@excelArtikelProses')->name('excel-artikel.proses');
    Route::get('/csv-artikel', 'ArtikelController@csvArtikelProses')->name('csv-artikel.proses');

    Route::get('/list-bank', 'BankController@show')->name('list-bank.show');
    Route::get('/cari-bank','BankController@cari')->name('cari-list-bank.show');
    Route::get('/tambah-bank', 'BankController@tambahBankShow')->name('tambah-bank.show');
    Route::post('/tambah-bank', 'BankController@tambahBankProses')->name('tambah-bank.proses');
    Route::get('/edit-bank/{id_bank}', 'BankController@editBankShow')->name('edit-bank.show');
    Route::post('/edit-bank/{id_bank}', 'BankController@editBankProses')->name('edit-bank.proses');
    Route::get('/hapus-bank/{id_bank}', 'BankController@hapusBankProses')->name('hapus-bank.proses');
    Route::get('/change-status-bank', 'BankController@changeStatus')->name('change-status-bank');

    Route::get('/list-volume', 'VolumeController@show')->name('list-volume.show');
    Route::get('/cari-volume','VolumeController@cari')->name('cari-list-volume.show');
    Route::get('/tambah-volume', 'VolumeController@tambahVolumeShow')->name('tambah-volume.show');
    Route::post('/tambah-volume', 'VolumeController@tambahVolumeProses')->name('tambah-volume.proses');
    Route::get('/edit-volume/{id_volume}', 'VolumeController@editVolumeShow')->name('edit-volume.show');
    Route::post('/edit-volume/{id_volume}', 'VolumeController@editVolumeProses')->name('edit-volume.proses');
    Route::get('/hapus-volume/{id_volume}', 'VolumeController@hapusVolumeProses')->name('hapus-volume.proses');
    Route::get('/change-status-volume', 'VolumeController@changeStatus')->name('change-status-volume');

    Route::get('/list-reviewer', 'ReviewerController@show')->name('list-reviewer.show');
    Route::get('/cari-reviewer','ReviewerController@cari')->name('cari-reviewer.show');
    Route::get('/tambah-reviewer', 'ReviewerController@tambahReviewerShow')->name('tambah-reviewer.show');
    Route::post('/tambah-reviewer', 'ReviewerController@tambahReviewerProses')->name('tambah-reviewer.proses');
    Route::get('/edit-reviewer/{id_reviewer}', 'ReviewerController@editReviewerShow')->name('edit-reviewer.show');
    Route::post('/edit-reviewer/{id_reviewer}', 'ReviewerController@editReviewerProses')->name('edit-reviewer.proses');
    Route::get('/hapus-reviewer/{id_reviewer}', 'ReviewerController@hapusReviewerProses')->name('hapus-reviewer.proses');

    Route::get('/list-review/{id_artikel}', 'ReviewController@show')->name('list-review.show');
    Route::get('/tambah-review/{id_artikel}', 'ReviewController@tambahReviewShow')->name('tambah-review.show');
    Route::post('/tambah-review/{id_artikel}', 'ReviewController@tambahReviewProses')->name('tambah-review.proses');
    Route::get('/edit-review/{id_review}/{id_artikel}', 'ReviewController@editReviewShow')->name('edit-review.show');
    Route::post('/edit-review/{id_artikel}/{id_review}/{kategori}', 'ReviewController@editReviewProses')->name('edit-review.proses');

    Route::get('/list-status', 'StatusController@show')->name('list-status.show');
    Route::get('/cari-status','StatusController@cari')->name('cari-status.show');
    Route::get('/tambah-status', 'StatusController@tambahStatusShow')->name('tambah-status.show');
    Route::post('/tambah-status', 'StatusController@tambahStatusProses')->name('tambah-status.proses');
    Route::get('/edit-status/{kode_status}', 'StatusController@editStatusShow')->name('edit-status.show');
    Route::post('/edit-status/{kode_status}', 'StatusController@editStatusProses')->name('edit-status.proses');
    Route::get('/hapus-status/{kode_status}', 'StatusController@hapusStatusProses')->name('hapus-status.proses');

    Route::get('/list-artstatus/{id_artikel}', 'ArtStatusController@show')->name('list-artstatus.show');
    Route::get('/tambah-artstatus/{id_artikel}', 'ArtStatusController@tambahArtStatusShow')->name('tambah-artstatus.show');
    Route::post('/tambah-artstatus/{id_artikel}', 'ArtStatusController@tambahArtStatusProses')->name('tambah-artstatus.proses');
    
    Route::get('/list-invoice/', 'InvoiceController@show')->name('list-invoice.show');
    Route::get('/cari-invoice','InvoiceController@cari')->name('cari-invoice.show');
    Route::get('/tambah-invoice/', 'InvoiceController@tambahInvoiceShow')->name('tambah-invoice.show');
    Route::post('/tambah-invoice/', 'InvoiceController@tambahInvoiceProses')->name('tambah-invoice.proses');
    Route::get('/pdf-invoice/{id_invoice}', 'InvoiceController@pdfInvoiceShow')->name('pdf-invoice.show');
    Route::get('/download-invoice/{id_invoice}', 'InvoiceController@downloadInvoiceProses')->name('download-invoice.proses');

    Route::get('/list-bayar/', 'BayarController@show')->name('list-bayar.show');
    Route::get('/cari-bayar','BayarController@cari')->name('cari-bayar.show');
    Route::get('/submit/{id_invoice}', 'BayarController@submitBayarShow')->name('submit.show');
    Route::get('/expire', 'BayarController@expireShow')->name('expire.show');
    Route::post('/submit/{id_invoice}', 'BayarController@submitBayarProses')->name('submit.proses');
    Route::get('/submit-success/', 'BayarController@successSubmit')->name('success-submit.show');
    Route::get('/upload-bayar/', 'BayarController@tambahBayarShow')->name('tambah-bayar.show');
    Route::post('/upload-bayar/', 'BayarController@tambahBayarProses')->name('tambah-bayar.proses');
    Route::get('/edit-bayar/{id_bayar}', 'BayarController@editBayarShow')->name('edit-bayar.show');
    Route::post('/edit-bayar/{id_bayar}', 'BayarController@editBayarProses')->name('edit-bayar.proses');
    Route::get('/hapus-bayar/{id_bayar}/{id_invoice}', 'BayarController@hapusBayarProses')->name('hapus-bayar.proses');

    Route::get('/list-approve/', 'ApproveController@show')->name('list-approve.show');
    Route::get('/cari-approve','ApproveController@cari')->name('cari-approve.show');
    Route::get('/kirim-approve/{id_approve}', 'ApproveController@kirimApprove')->name('kirim-approve.show');
    Route::get('/hapus-approve/{id_approve}/{id_invoice}', 'ApproveController@hapusApprove')->name('hapus-approve.proses');
    
    Route::get('/list-kwitansi/', 'KwitansiController@show')->name('list-kwitansi.show');
    Route::get('/cari-kwitansi','KwitansiController@cari')->name('cari-kwitansi.show');
    Route::get('/pdf-kwitansi/{id_kwitansi}', 'KwitansiController@pdfKwitansiShow')->name('pdf-kwitansi.show');
    Route::get('/download-kwitansi/{id_kwitansi}', 'KwitansiController@downloadKwitansiProses')->name('download-kwitansi.proses');

    Route::get('/list-loa/', 'LOAController@show')->name('list-loa.show');
    Route::get('/cari-loa','LOAController@cari')->name('cari-loa.show');
    Route::get('/pdf-loa/{id_loa}', 'LOAController@pdfLOAShow')->name('pdf-loa.show');
    Route::get('/download-loa/{id_loa}', 'LOAController@downloadLOAProses')->name('download-loa.proses');

    Route::get('/list-keuangan/', 'KeuanganController@show')->name('list-keuangan.show');
    Route::get('/cari-keuangan','KeuanganController@cari')->name('cari-keuangan.show');
    Route::get('/tambah-keuangan/', 'KeuanganController@tambahKeuanganShow')->name('tambah-keuangan.show');
    Route::post('/tambah-keuangan/', 'KeuanganController@tambahKeuanganProses')->name('tambah-keuangan.proses');
    Route::get('/edit-keuangan/{id_keuangan}', 'KeuanganController@editKeuanganShow')->name('edit-keuangan.show');
    Route::post('/edit-keuangan/{id_keuangan}', 'KeuanganController@editKeuanganProses')->name('edit-keuangan.proses');
    Route::get('/hapus-keuangan/{id_keuangan}', 'KeuanganController@hapusKeuanganProses')->name('hapus-keuangan.proses');
    Route::get('/excel-keuangan', 'KeuanganController@excelKeuanganProses')->name('excel-keuangan.proses');
    Route::get('/csv-keuangan', 'KeuanganController@csvKeuanganProses')->name('csv-keuangan.proses');
    

    //test route
    Route::get('/test/{id_review}', 'TestController@test')->name('test');
    
});

Route::group(['middleware' => ['guest']], function() {
    /**
     * Logout Routes
     */
    Route::get('/logout', 'LogoutController@perform')->name('logout.perform');
});

});