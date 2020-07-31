<?php

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

Route::get('/', 'HomeController@welcome')->name('welcome');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');
Route::resource('jeniszis','JenisZisController')->only('store','index')->middleware(['auth','notjamaah','panitiaramadhan']);
Route::get('/jeniszis/{jeniszis}/edit','JenisZisController@edit')->name('jeniszis.edit')->middleware(['auth','notjamaah','panitiaramadhan']);
Route::patch('/jeniszis/{jeniszis}','JenisZisController@update')->name('jeniszis.update')->middleware(['auth','notjamaah','panitiaramadhan']);
Route::delete('/jeniszis/{jeniszis}','JenisZisController@destroy')->name('jeniszis.destroy')->middleware(['auth','notjamaah','panitiaramadhan']);

Route::resource('/bentukzis','BentukzisController')->only('store','index')->middleware(['auth','notjamaah','panitiaramadhan']);
Route::patch('/bentukzis/{bentukzis}','BentukzisController@update')->name('bentukzis.update')->middleware(['auth','notjamaah','panitiaramadhan']);
Route::delete('/bentukzis/{bentukzis}','BentukzisController@destroy')->name('bentukzis.destroy')->middleware(['auth','notjamaah','panitiaramadhan']);

Route::get('/Pengeluaran/pdf','PengeluaranController@pdf')->name('pengeluaran.pdf')->middleware("auth");
Route::get('/Pemasukan/pdf','PemasukanController@pdf')->name('pemasukan.pdf')->middleware("auth");

Route::get('/pemasukan/filter','PemasukanController@filter')->name('pemasukan.filter')->middleware("auth");
Route::get('/pengeluaran/filter','PengeluaranController@filter')->name('pengeluaran.filter')->middleware("auth");

Route::get('/Pengeluaran-bentuk/pdf','PengeluaranBentukController@pdf')->name('pengeluaran-bentuk.pdf')->middleware("auth");
Route::get('/Pemasukan-bentuk/pdf','PemasukanBentukController@pdf')->name('pemasukan-bentuk.pdf')->middleware("auth");

Route::get('/pemasukan-bentuk/filter','PemasukanBentukController@filter')->name('pemasukan-bentuk.filter')->middleware("auth");
Route::get('/pengeluaran-bentuk/filter','PengeluaranBentukController@filter')->name('pengeluaran-bentuk.filter')->middleware("auth");

Route::resource('pengguna','PenggunaController')->only('index','update','destroy')->middleware(['auth','admin','panitiaramadhan']);
//Route::resource('roles','RoleController')->only('index','update','store','destroy')->middleware('auth');
//Route::resource('permissions','PermissionController')->only('index','store','update','destroy')->middleware('auth');

Route::resource('pemasukan','PemasukanController')->middleware(['auth','notjamaah']);
Route::resource('pemasukan-bentuk','PemasukanBentukController')->middleware(['auth','notjamaah']);
Route::resource('pengeluaran-bentuk','PengeluaranBentukController')->middleware(['auth','notjamaah']);

Route::resource('pengeluaran','PengeluaranController')->middleware(['auth','notjamaah']);

Route::get('laporan/pemasukan-detail/{jenis}','LaporanController@masuk_show')->name('laporan.masuk.show');
Route::get('laporan/pengeluaran-detail/{jenis}','LaporanController@keluar_show')->name('laporan.keluar.show');
Route::get('laporan/chart','LaporanController@chart')->name('laporan.chart');
Route::get('laporan','LaporanController@index')->name('laporan.index');
Route::post('laporan/filter','LaporanController@filter')->name('laporan.filter');

