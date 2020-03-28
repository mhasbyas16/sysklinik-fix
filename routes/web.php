<?php

// ---------------------------------------- ADD DINDIN --------------------------------------- //

// Events
Route::delete('events/massdestroy', 'EventsController@massDestroy')->name('events.massdestroy');
Route::get('events/create', 'EventsController@create');
Route::post('events/store', 'EventsController@store');
Route::get('events/show/{event}', 'EventsController@show')->name('admin.events.show');
Route::get('events/edit/{event}', 'EventsController@edit');
Route::delete('events/destroy/{event}', 'EventsController@destroy');
Route::post('events/update/{event}', 'EventsController@update');
   
// Calendar 
Route::get('system-calendar', 'SystemCalendarController@index')->name('admin.systemCalendar');

// ------------------------------------------- MAIN ------------------------------------------ //

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
Route::get('/absensi/export/{awal}/{akhir}/{validate}','mainmenuController@exportabsensi');
//jadwal terapi
Route::get('/jadwal-terapi','mainmenuController@jadwalterapi');
Route::get('/jadwal-terapi/asses/{id}','mainmenuController@jadwalasses');
Route::post('/jadwal-terapi/add','mainmenuController@addjadwal');
Route::get('/jadwal-terapi/hapus/{id}','mainmenuController@hapusjadwal_asses');
Route::get('/jadwal-terapi/{idJ}/{id}/{validate}/{type}','mainmenuController@validatejadwal')->name('jadwal_validate');

Route::get('/tambah_jadwal', 'mainmenuController@tambah_jadwal');
Route::get('/edit_jadwal/{id}', 'mainmenuController@edit_jadwal');
Route::post('/edit_jadwal/store', 'mainmenuController@edit_jadwal_store');
Route::post('/tambah_jadwal/store', 'mainmenuController@tambah_jadwal_store');
Route::get('/tambah_asses', 'mainmenuController@tambah_asses');
Route::post('/store_asses','mainmenuController@store_asses');
Route::post('/jterapi_pasien','mainmenuController@jterapiPasien')->name("ajaxRequest.post");
//jadwal Evaluasi
Route::get('/jadwal-evaluasi','mainmenuController@jadwalevaluasi');
Route::post('/jadwal-evaluasi/filter-date','mainmenuController@jadwalevaluasifilter');
Route::get('/edit-eval/{id}','mainmenuController@editeval');
Route::post('/jadwal-evaluasi/update/{id}','mainmenuController@jadwalevaluasiupdate');
//Data Pasien
Route::get('/data-pasien','datamasterController@datapasien');
Route::get('/data-pasien/view/{id}','mainmenuController@datapasiendata');
Route::post('/data-pasien/update','mainmenuController@datapasienupdate');
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
Route::get('/send/email/{id}', 'printpage@sendEmail');
Route::get('/terima/asses/{id}', 'printpage@sendEmail_terimaasses');
Route::get('/tolak/asses/{id}', 'printpage@sendEmail_tolakasses');
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
Route::get('/terima/{id}','Controller@ubahstatusterima');
Route::get('/tolak/{id}','Controller@ubahstatustolak');
Route::get('/hapus/{id}','Controller@hapus');

// ------------------------------------ DINDIN PART END ---------------------------------- //
