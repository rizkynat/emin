<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['namespace' => 'App\Http\Controllers'], function()
{  

//Route::post('/LoginController', 'LoginController');

Route::get('/dashboard', 'DashboardController@show')->name('dashboard.show');
Route::get('/', 'DashboardController@show')->name('dashboard.index');

Route::group(['middleware' => ['guest']], function() {
    //Login Routes
    Route::get('/login', 'LoginController@show')->name('login.show');
    Route::post('/login', 'LoginController@loginProses')->name('login.proses');

    Route::get('/register', 'RegisterController@show')->name('register.show');
    Route::post('/register', 'RegisterController@registerProses')->name('register.proses');

    Route::get('/list-artikel', 'ArtikelController@show')->name('list-artikel.show');
    Route::get('/tambah-artikel', 'ArtikelController@tambahArtikelShow')->name('tambah-artikel.show');
    Route::post('/tambah-artikel', 'ArtikelController@tambahArtikelProses')->name('tambah-artikel.proses');

    Route::get('/list-bank', 'BankController@show')->name('list-bank.show');
    Route::get('/cari-list-bank','BankController@cari')->name('cari-list-bank.show');
    Route::get('/tambah-bank', 'BankController@tambahBankShow')->name('tambah-bank.show');
    Route::post('/tambah-bank', 'BankController@tambahBankProses')->name('tambah-bank.proses');
    Route::get('/edit-bank/{id_bank}', 'BankController@editBankShow')->name('edit-bank.show');
    Route::post('/edit-bank/{id_bank}', 'BankController@editBankProses')->name('edit-bank.proses');
    Route::get('/hapus-bank/{id_bank}', 'BankController@hapusBankProses')->name('hapus-bank.proses');
    Route::get('/change-status-bank', 'BankController@changeStatus')->name('change-status-bank');

    Route::get('/list-volume', 'VolumeController@show')->name('list-volume.show');
    Route::get('/cari-list-volume','VolumeController@cari')->name('cari-list-volume.show');
    Route::get('/tambah-volume', 'VolumeController@tambahVolumeShow')->name('tambah-volume.show');
    Route::post('/tambah-volume', 'VolumeController@tambahVolumeProses')->name('tambah-volume.proses');
    Route::get('/edit-volume/{id_volume}', 'VolumeController@editVolumeShow')->name('edit-volume.show');
    Route::post('/edit-volume/{id_volume}', 'VolumeController@editVolumeProses')->name('edit-volume.proses');
    Route::get('/hapus-volume/{id_volume}', 'VolumeController@hapusVolumeProses')->name('hapus-volume.proses');
    Route::get('/change-status-volume', 'VolumeController@changeStatus')->name('change-status-volume');

    Route::get('/list-reviewer', 'ReviewerController@show')->name('list-reviewer.show');
    Route::get('/cari-list-reviewer','ReviewerController@cari')->name('cari-list-reviewer.show');
    Route::get('/tambah-reviewer', 'ReviewerController@tambahReviewerShow')->name('tambah-reviewer.show');
    Route::post('/tambah-reviewer', 'ReviewerController@tambahReviewerProses')->name('tambah-reviewer.proses');
    Route::get('/edit-reviewer/{id_reviewer}', 'ReviewerController@editReviewerShow')->name('edit-reviewer.show');
    Route::post('/edit-reviewer/{id_reviewer}', 'ReviewerController@editReviewerProses')->name('edit-reviewer.proses');
    Route::get('/hapus-reviewer/{id_reviewer}', 'ReviewerController@hapusReviewerProses')->name('hapus-reviewer.proses');
    
});

Route::group(['middleware' => ['guest']], function() {
    /**
     * Logout Routes
     */
    Route::get('/logout', 'LogoutController@perform')->name('logout.perform');
});

});