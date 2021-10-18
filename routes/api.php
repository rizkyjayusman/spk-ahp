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

Route::prefix('coupons')->group(function() {
    Route::post('/bulk', 'v1\Api\Coupon\CouponController@createBulkCoupon');
    Route::post('/', 'v1\Api\Coupon\CouponController@index')->name('index');
    Route::get('/detail/{id}', 'v1\Api\Coupon\CouponController@detail');
    Route::get('/export', 'v1\Api\Coupon\CouponController@export');

});

Route::prefix('users')->middleware('auth:web')->group(function () {
    Route::post('/', 'v1\Api\UserManagement\UserController@index')->name('index');
    Route::post('/store', 'v1\Api\UserManagement\UserController@store')->name('api_add_user');
    Route::get('/show/{userId}', 'v1\Api\UserManagement\UserController@show')->name('show');
    Route::post('/edit/{userId}', 'v1\Api\UserManagement\UserController@edit')->name('api_edit_user');
    Route::post('/delete/{userId}', 'v1\Api\UserManagement\UserController@delete')->name('delete');
});

Route::prefix('lokasi')->middleware('auth:web')->group(function () {
    Route::post('/', 'Api\LokasiController@index')->name('index');
    Route::post('/store', 'Api\LokasiController@store')->name('api_add_lokasi');
    Route::get('/show/{lokasiId}', 'Api\LokasiController@show')->name('show');
    Route::post('/edit/{lokasiId}', 'Api\LokasiController@edit')->name('api_edit_lokasi');
    Route::post('/delete/{lokasiId}', 'Api\LokasiController@delete')->name('delete');
});

Route::prefix('konklusi')->middleware('auth:web')->group(function () {
    Route::post('/', 'Api\KonklusiController@index')->name('index');
    Route::post('/store', 'Api\KonklusiController@store')->name('api_add_konklusi');
    Route::get('/show/{konklusiId}', 'Api\KonklusiController@show')->name('show');
    Route::post('/edit/{konklusiId}', 'Api\KonklusiController@edit')->name('api_edit_konklusi');
    Route::post('/delete/{konklusiId}', 'Api\KonklusiController@delete')->name('delete');
});

Route::prefix('kategori-gangguan')->middleware('auth:web')->group(function () {
    Route::post('/', 'Api\KategoriGangguanController@index')->name('index');
    Route::post('/store', 'Api\KategoriGangguanController@store')->name('api_add_kategori_gangguan');
    Route::get('/show/{kategoriGangguanId}', 'Api\KategoriGangguanController@show')->name('show');
    Route::post('/edit/{kategoriGangguanId}', 'Api\KategoriGangguanController@edit')->name('api_edit_kategori_gangguan');
    Route::post('/delete/{kategoriGangguanId}', 'Api\KategoriGangguanController@delete')->name('delete');
});


Route::prefix('histori-gangguan')->middleware('auth:web')->group(function () {
    Route::post('/', 'Api\HistoriGangguanController@index')->name('index');
    Route::post('/store', 'Api\HistoriGangguanController@store')->name('api_add_histori_gangguan');
    Route::get('/show/{historiGangguanId}', 'Api\HistoriGangguanController@show')->name('show');
    Route::post('/edit/{historiGangguanId}', 'Api\HistoriGangguanController@edit')->name('api_edit_histori_gangguan');
    Route::post('/delete/{HistoriGangguanId}', 'Api\HistoriGangguanController@delete')->name('delete');
    Route::get('/export', 'Api\HistoriGangguanController@exportHistori');
});

Route::prefix('restitusi')->middleware('auth:web')->group(function () {
    Route::post('/', 'Api\HistoriGangguanController@getRestitusi')->name('index');
    Route::get('/export', 'Api\HistoriGangguanController@exportRestitusi');
});