<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('users')->middleware('auth:web')->group(function () {
    Route::post('/', 'v1\Api\UserManagement\UserController@index')->name('index');
    Route::post('/delete/{userId}', 'v1\Api\UserManagement\UserController@delete')->name('delete');
});

Route::prefix('lokasi')->middleware('auth:web')->group(function () {
    Route::post('/', 'Api\LokasiController@index')->name('index');
    Route::post('/delete/{lokasiId}', 'Api\LokasiController@delete')->name('delete');
});

Route::prefix('konklusi')->middleware('auth:web')->group(function () {
    Route::post('/', 'Api\KonklusiController@index')->name('index');
    Route::post('/delete/{konklusiId}', 'Api\KonklusiController@delete')->name('delete');
});

Route::prefix('kategori-gangguan')->middleware('auth:web')->group(function () {
    Route::post('/', 'Api\KategoriGangguanController@index')->name('index');
    Route::post('/delete/{kategoriGangguanId}', 'Api\KategoriGangguanController@delete')->name('delete');
});


Route::prefix('histori-gangguan')->middleware('auth:web')->group(function () {
    Route::post('/', 'Api\HistoriGangguanController@index')->name('index');
    Route::post('/delete/{HistoriGangguanId}', 'Api\HistoriGangguanController@delete')->name('delete');
    Route::get('/export', 'Api\HistoriGangguanController@exportHistori');
});

Route::prefix('restitusi')->middleware('auth:web')->group(function () {
    Route::post('/', 'Api\HistoriGangguanController@getRestitusi')->name('index');
    Route::get('/export', 'Api\HistoriGangguanController@exportRestitusi');
});