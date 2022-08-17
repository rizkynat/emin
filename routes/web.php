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
    Route::post('/list-artikel', 'ArtikelController@artikelProses')->name('list-artikel.proses');
    Route::get('/list-bank', 'BankController@show')->name('list-bank.show');
    Route::get('/tambah-bank', 'BankController@tambahBankShow')->name('tambah-bank.show');
    Route::post('/tambah-bank', 'BankController@bankProses')->name('tambah-bank.proses');
});

Route::group(['middleware' => ['guest']], function() {
    /**
     * Logout Routes
     */
    Route::get('/logout', 'LogoutController@perform')->name('logout.perform');
});

});