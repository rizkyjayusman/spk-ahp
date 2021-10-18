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

Auth::routes();


Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('/')->middleware(['auth'])->group(function () {
    Route::get('/', 'HomeController@index');
});

Route::prefix('users')->middleware(['auth'])->group(function () {
    Route::get('/', function () { return view('pages.users.index'); })->name('user_list');
    Route::post('/add', 'Users\UserController@addUser')->name('user_add_process');
    Route::get('/add', 'Users\UserController@add')->name('user_add');
    Route::post('/edit/{id}', 'Users\UserController@editUser')->name('user_edit_process');
    Route::get('/edit/{id}', 'Users\UserController@edit')->name('user_edit');
});

Route::prefix('lokasi')->middleware(['auth'])->group(function () {
    Route::get('/', 'Web\LokasiController@index')->name('lokasi_list');
    Route::post('/add', 'Web\LokasiController@addLokasi')->name('lokasi_add_process');
    Route::get('/add', 'Web\LokasiController@add')->name('lokasi_add');
    Route::post('/edit/{id}', 'Web\LokasiController@editLokasi')->name('lokasi_edit_process');
    Route::get('/edit/{id}', 'Web\LokasiController@edit')->name('lokasi_edit');
});

Route::prefix('konklusi')->middleware(['auth'])->group(function () {
    Route::get('/', 'Web\KonklusiController@index')->name('konklusi_list');
    Route::post('/add', 'Web\KonklusiController@addKonklusi')->name('konklusi_add_process');
    Route::get('/add', 'Web\KonklusiController@add')->name('konklusi_add');
    Route::post('/edit/{id}', 'Web\KonklusiController@editKonklusi')->name('konklusi_edit_process');
    Route::get('/edit/{id}', 'Web\KonklusiController@edit')->name('konklusi_edit');
});

Route::prefix('histori-gangguan')->middleware(['auth'])->group(function () {
    Route::get('/', 'Web\HistoriGangguanController@index')->name('histori_gangguan_list');
    Route::post('/add', 'Web\HistoriGangguanController@addHistori')->name('histori_add_process');
    Route::get('/add', 'Web\HistoriGangguanController@add')->name('histori_gangguan_add');
    Route::post('/edit/{id}', 'Web\HistoriGangguanController@editHistori')->name('histori_edit_process');
    Route::get('/edit/{id}', 'Web\HistoriGangguanController@edit')->name('histori_gangguan_edit');
});

Route::prefix('kategori-gangguan')->middleware(['auth'])->group(function () {
    Route::get('/', 'Web\KategoriGangguanController@index')->name('kategori_gangguan_list');
    Route::post('/add', 'Web\KategoriGangguanController@addKategori')->name('kategori_add_process');
    Route::get('/add', 'Web\KategoriGangguanController@add')->name('kategori_gangguan_add');
    Route::post('/edit/{id}', 'Web\KategoriGangguanController@editKategori')->name('kategori_edit_process');
    Route::get('/edit/{id}', 'Web\KategoriGangguanController@edit')->name('kategori_gangguan_edit');
});

Route::prefix('restitusi')->middleware(['auth'])->group(function () {
    Route::get('/', 'Web\RestitusiController@index')->name('restitusi_list');
    Route::get('/detail/{month}/{lokasi_id}', 'Web\RestitusiController@detail')->name('restitusi_detail');
});