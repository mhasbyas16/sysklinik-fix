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
Route::get('/', function () {
    return view('index');
});

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
//jadwal terapi
Route::get('/jadwal-terapi','mainmenuController@jadwalterapi');
Route::get('/jadwal-terapi/asses/{id}','mainmenuController@jadwalasses');
//jadwal Evaluasi
Route::get('/jadwal-evaluasi','mainmenuController@jadwalevaluasi');
Route::post('/jadwal-evaluasi/filter-date','mainmenuController@jadwalevaluasifilter');
//Data Pasien
Route::get('/data-pasien','datamasterController@datapasien');
Route::get('/data-pasien/view/{id}','datamasterController@datapasienview');
Route::post('/data-pasien/update','datamasterController@datapasienupdate');
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

//billing
Route::get('/billing','Controller@Billing');
Route::get('/d_billing','Controller@Detail_Billing');
//rekam medis
Route::resource('rekam_medis','RekamMedis');
Route::resource('detail_rekam_medis','DetailRekamMedis');
//keuangan
Route::resource('transaksi_keuangan', 'TransaksiKeuangan');
Route::resource('laporan_keuangan', 'LaporanKeuangan');
//payroll
Route::get('/payroll','Controller@Payroll');
//setting
Route::get('/setting','Controller@Setting');

// ------------------------------------- ENNY PART END ----------------------------------- //


// ---------------------------------- DINDIN PART BEGIN ---------------------------------- //

//alat terapi
Route::resource('/alatterapi','alatterapi');
Route::resource('/transalat','transaksiat');
Route::resource('/persediaan','persediaan');

// ------------------------------------ DINDIN PART END ---------------------------------- //