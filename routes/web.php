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



//Dashboard
Route::get('/', 'Controller@index');

// ------------------------------------- HASBY PART  BEGIN ----------------------------------- //

//main menu
//Register list
Route::get('/register-list','mainmenuController@registerlist');
Route::get('/register-list/{id}','mainmenuController@registerlistdata');
Route::post('/register-list/update','mainmenuController@registerlistupdate');
Route::get('/register-list/delete/{id}','mainmenuController@registerlistdelete');
Route::post('/register-list/filter-date','mainmenuController@registerlistfilter');
//Absensi
Route::get('/absensi','mainmenuController@absensi');
Route::post('/absensi/{id}','mainmenuController@absensifilter');
Route::get('/absensi/export/{awal}/{akhir}','mainmenuController@exportabsensi');
//jadwal terapi
Route::get('/jadwal-terapi','mainmenuController@jadwalterapi');
Route::get('/jadwal-terapi/asses/{id}','mainmenuController@jadwalasses');
Route::post('/jadwal-terapi/add','mainmenuController@addjadwal');
Route::get('/jadwal-terapi/{idJ}/{id}/{validate}/{type}','mainmenuController@validatejadwal')->name('jadwal_validate');
//jadwal Evaluasi
Route::get('/jadwal-evaluasi','mainmenuController@jadwalevaluasi');
Route::post('/jadwal-evaluasi/filter-date','mainmenuController@jadwalevaluasifilter');
//Data Pasien
Route::get('/data-pasien','datamasterController@datapasien');
Route::get('/data-pasien/view/{id}','mainmenuController@registerlistdata');
Route::post('/data-pasien/update','mainmenuController@registerlistupdate');
Route::get('/data-pasien/record/{id}','datamasterController@recordpasien');
//Data Karyawan
Route::get('/karyawan','datamasterController@karyawan');
Route::get('/karyawan/tambah-data/{kt}','datamasterController@karyawantambah');
Route::get('/karyawan/edit-data/{id}','datamasterController@karyawaneditview');
Route::get('/karyawan/hapus-data/{id}','datamasterController@karyawandelete');
Route::post('/pegawai/{save}','datamasterController@pegawaisave');
//Data terapis
Route::get('/data-terapis','datamasterController@dataterapis');
//Data terapi
Route::get('/data-terapi','datamasterController@dataterapi');
Route::get('/data-terapi/delete/{id}','datamasterController@dataterapidelete');
Route::post('/data-terapi/add','datamasterController@dataterapiadd');

// ------------------------------------- HASBY PART END ----------------------------------- //


// ------------------------------------- ENNY PART BEGIN ---------------------------------- //

//Login and Logout
Route::resource('login','login');
Route::get('logout', 'datamasterController@logout');

//Billing
Route::resource('billing','billing');
Route::resource('detail_billing','detail_billing');

//Rekam Medis
Route::resource('rekam_medis','rekam_medis');
Route::resource('detail_rekam_medis','detail_rekam_medis');

//Keuangan
Route::resource('transaksi_keuangan', 'transaksi_keuangan');
Route::resource('laporan_keuangan', 'laporan_keuangan');
Route::resource('kwitansi', 'detail_kwitansi');

//Payroll
Route::resource('payroll','payroll');

//Setting
Route::resource('setting', 'setting');

//Print Page and Send Email
Route::get('/print/billing/{id}', 'printpage@printBilling');
Route::get('/send/billing/{id}', 'printpage@sendBilling');
Route::get('/print/laporan/{id}', 'printpage@printLaporanKeuangan');


// ------------------------------------- ENNY PART END ----------------------------------- //


// ---------------------------------- DINDIN PART BEGIN ---------------------------------- //

//alat terapi
Route::resource('/alatterapi','alatterapi');
Route::resource('/transalat','transaksiat');
Route::resource('/persediaan','persediaan');

Route::get('/merk/{id}','alatterapi@merkAjax');
Route::get('/ambil/{id}','alatterapi@merkAjax');

//dashboard asses baru
Route::get('/ubahstatus/{id}','Controller@ubahstatus');
Route::post('/hapus/{id}','Controller@hapus');

// ------------------------------------ DINDIN PART END ---------------------------------- //
