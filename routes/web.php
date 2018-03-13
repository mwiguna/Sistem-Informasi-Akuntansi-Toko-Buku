<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|

Route::get('/', function () {
    return view('welcome');
});

*/

Auth::routes();
Route::get('/home', 'HomeController@home');
Route::get('/', 	'HomeController@index');

Route::post('/addPenjualan', 	 	  	  'AdminController@addPenjualan');
Route::post('/infoBuku', 		 	      'AdminController@infoBuku');
Route::get('/nota/{faktur}',	 	  	  'AdminController@nota');
Route::get('/daftar/penjualan/{m?}/{y?}', 'AdminController@daftarPenjualan');
Route::get('/pembelian',		 	  	  'AdminController@pembelian');
Route::post('/addPembelian', 	 	  	  'AdminController@addPembelian');
Route::get('/daftar/pembelian/{m?}/{y?}', 'AdminController@daftarPembelian');
Route::get('/notaPembelian/{faktur}', 	  'AdminController@notaPembelian');
Route::get('/daftar/buku', 			  	  'AdminController@daftarBuku');
Route::get('/buku/{id}',			  	  'AdminController@buku');
Route::post('/editBook', 			  	  'AdminController@editBook');
Route::post('/addBook',				  	  'AdminController@addBook');
Route::get('/deletePembelian/{id}',	  	  'AdminController@deletePembelian');
Route::get('/laporan/labarugi', 	  	  'AdminController@labarugi');
Route::post('/getLabaRugi', 		  	  'AdminController@getLabaRugi');
Route::post('/getPenjualan', 		  	  'AdminController@getPenjualan');
Route::post('/getPembelian', 		  	  'AdminController@getPembelian');
Route::get('/laporan/pembelian',	  	  'AdminController@laporanPembelian');
Route::get('/buku/penerbit/{id}',		  'AdminController@penerbitBuku');
Route::get('/buku/kategori/{id}',		  'AdminController@kategoriBuku');
Route::post('/searchBook',				  'AdminController@searchBook');
Route::get('/cari/buku/{id}',			  'AdminController@cariBuku');
Route::get('cetak/daftarBuku', 			  'AdminController@cetakBuku');