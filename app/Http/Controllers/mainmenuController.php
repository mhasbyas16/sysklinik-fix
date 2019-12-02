<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use MaddHatter\LaravelFullcalendar\Facades\Calendar;
use DB;
use App\Helper\absensi;
use App\Helper\idrandom;
use App\Helper\agama;
use File;
use App\RekamMedis;

class mainmenuController extends Controller
{
  //absensi
  public function absensi(){
    //pasien
    $pasien=absensi::pasien()->get();
    //terapis
    $terapis=absensi::terapis()->get();
    //karyawan
    $karyawan=absensi::karyawan()->get();

    return view('main_menu.absensi',[
      'pasien'=>$pasien,
      'terapis'=>$terapis,
      'karyawan'=>$karyawan
    ]);
  }

  public function absensifilter(Request $req, $id){
    $min=$req->min;
    $max=$req->max;

    if ($id=='pasien') {
      $pasien=absensi::pasien()->whereBetween('tgl',[$min,$max])->get();
      $terapis=absensi::terapis()->get();
      $karyawan=absensi::karyawan()->get();
    }elseif ($id=='terapis') {
      $pasien=absensi::pasien()->get();
      $terapis=absensi::terapis()->whereBetween('tgl',[$min,$max])->get();
      $karyawan=absensi::karyawan()->get();
    }elseif ($id=='karyawan') {
      $pasien=absensi::pasien()->get();
      $terapis=absensi::terapis()->get();
      $karyawan=absensi::karyawan()->whereBetween('tgl',[$min,$max])->get();
    }

    return view('main_menu.absensi',[
      'pasien'=>$pasien,
      'terapis'=>$terapis,
      'karyawan'=>$karyawan
    ]);
  }

//jadwal Evaluasi
public function jadwalevaluasi(){
  $awal=date('Y-m-01');
  $akhir=date('Y-m-31');
  $isi=DB::table('h_pasien')
  ->select('h_pasien.id_pasien as idpasien','assessment.status_pasien','d_pasien.nama'
  ,DB::raw('DATE_ADD(assessment.tgl_mulai_terapi, INTERVAL 3 MONTH) as tgl_eval1')
  ,DB::raw('DATE_ADD(assessment.tgl_mulai_terapi, INTERVAL 6 MONTH) as tgl_eval2')
  ,DB::raw('DATE_ADD(assessment.tgl_mulai_terapi, INTERVAL 9 MONTH) as tgl_eval3')
  ,DB::raw('DATE_ADD(assessment.tgl_mulai_terapi, INTERVAL 1 YEAR) as tgl_eval4')
  ,DB::raw('DATE_ADD(assessment.tgl_mulai_terapi, INTERVAL 1-3 YEAR_MONTH) as tgl_eval5')
  ,DB::raw('DATE_ADD(assessment.tgl_mulai_terapi, INTERVAL 1-5 YEAR_MONTH) as tgl_eval6'),'assessment.*')
  ->leftJoin('assessment','h_pasien.id_pasien','=','assessment.id_pasien')
  ->join('d_pasien','d_pasien.id_pasien','=','h_pasien.id_pasien')->whereBetween('assessment.tgl_mulai_terapi',[$awal,$akhir])->get();

  return view ('main_menu.jadwaleval',[
    'isi'=>$isi]);
}
public function jadwalevaluasifilter(Request $req){
  $min=$req->min;
  $max=$req->max;
  $pilih=$req->pilih;
  $isi=DB::table('h_pasien')
  ->select('h_pasien.id_pasien as idpasien','assessment.status_pasien','d_pasien.nama'
 ,DB::raw('DATE_ADD(assessment.tgl_mulai_terapi, INTERVAL 3 MONTH) as tgl_eval1')
 ,DB::raw('DATE_ADD(assessment.tgl_mulai_terapi, INTERVAL 6 MONTH) as tgl_eval2')
 ,DB::raw('DATE_ADD(assessment.tgl_mulai_terapi, INTERVAL 9 MONTH) as tgl_eval3')
 ,DB::raw('DATE_ADD(assessment.tgl_mulai_terapi, INTERVAL 1 YEAR) as tgl_eval4')
 ,DB::raw('DATE_ADD(assessment.tgl_mulai_terapi, INTERVAL 1-3 YEAR_MONTH) as tgl_eval5')
 ,DB::raw('DATE_ADD(assessment.tgl_mulai_terapi, INTERVAL 1-5 YEAR_MONTH) as tgl_eval6'),'assessment.*')->leftJoin('assessment','h_pasien.id_pasien','=','assessment.id_pasien')
  ->join('d_pasien','d_pasien.id_pasien','=','h_pasien.id_pasien')->whereBetween($pilih,[$min,$max])->get();


  return view ('main_menu.jadwaleval',[
    'isi'=>$isi]);
}

//Register List
  public function registerlist(){
    $awal=date('Y-m-01');
    $akhir=date('Y-m-31');
    $isi=DB::table('h_pasien')
    ->select('h_pasien.id_pasien','d_pasien.nama','assessment.*')
    ->leftJoin('d_pasien','d_pasien.id_pasien','=','h_pasien.id_pasien')
    ->leftJoin('assessment','assessment.id_pasien','=','h_pasien.id_pasien')
    //->whereBetween('record_status_pasien.tgl',[$awal,$akhir])
    ->where('assessment.status_pasien','Daftar')->get();

    return view ('main_menu.registerlist',[
      'isi'=>$isi]);
  }

  public function registerlistfilter(Request $req){
    $min=$req->min;
    $max=$req->max;
    $pilih=$req->pilih;
    $isi=DB::table('h_pasien')
    ->select('h_pasien.id_pasien as idpasien','h_pasien.status','d_pasien.nama','d_pasien.tgl_daftar','assessment.*')
    ->leftJoin('assessment','h_pasien.id_pasien','=','assessment.id_pasien')
    ->join('d_pasien','d_pasien.id_pasien','=','h_pasien.id_pasien')->whereBetween($pilih,[$min,$max])->get();


    return view ('main_menu.registerlist',[
      'isi'=>$isi]);
  }

  public function registerlistdelete($id){
    $data=DB::table('d_pasien')->select('foto')->where('id_pasien',$id)->first();
    File::delete('foto/pasien/'.$data->foto);
    DB::table('h_pasien')->where('id_pasien',$id)->delete();

    return redirect ('/register-list')->with('alert','Sukses Menghapus Data');
  }

  public function registerlistdata($id){

    $data=DB::table('d_pasien')
    ->join('h_pasien','h_pasien.id_pasien','=','d_pasien.id_pasien')
    ->join('record_status_pasien','record_status_pasien.id_pasien','=','h_pasien.id_pasien')
    ->join('assessment','assessment.id_pasien','=','d_pasien.id_pasien')
    ->where('d_pasien.id_pasien',$id)->orderBY('record_status_pasien.id_status','desc')->first();
    $assessment=DB::table('assessment');
    $count=$assessment->where('id_pasien',$id)->count();
    //lahir
    $tgl_lahir=explode('-',$data->tgl_lahir);
    $tahun=$tgl_lahir[0];
    $bulan=$tgl_lahir[1];
    $tahun_now=date('Y');
    $bulan_now=date('m');
    $agama=agama::listagama();
    $status=agama::liststatus();
    if ($bulan_now>=$bulan) {
      $diff=$tahun_now-$tahun;
    }else{
      $diff=$tahun_now-$tahun-1;
    }
    $umur=$diff;

    $kar=DB::table('d_pegawai')->orderBy('nama','asc')->get();
    $j_terapi=DB::table('jenis_terapi')->orderBY('terapi','asc')->get();
    if ($count==0) {
      $isiA='';
    }else {
      $isiA=$assessment
      ->where('id_pasien',$id)->first();
    }
    return view ('main_menu.registerlist_data',[
      'data'=>$data,
      'kar'=>$kar,
      'j_terapi'=>$j_terapi,
      'id'=>$id,
      'umur'=>$umur,
      'isiA'=>$isiA,
      'count'=>$count,
      'agama'=>$agama,
      'status'=>$status
    ]);
  }

  public function registerlistupdate(request $req){
    //pasien
    $id_pasien=$req->id_pasien;
    $nama_P=$req->nama_P;
    $jk=$req->jk;
    $alamat_P=$req->alamat_P;
    $tempat_lahir=$req->tempat_lahir;
    $tanggal_lahir=$req->tanggal_lahir;
    $umur=$req->umur;
    $notelp_P=$req->notelp_P;
    $tanggal_daftar=$req->tanggal_daftar;
    $agama=$req->agama;
    $keluhan=$req->keluhan;
    //foto
    if ($req->file('foto')=='') {
      $Nfoto=$id_pasien;
    }else{
    $foto=$req->file('foto');
    $size=$foto->getSize();
    $tipe=$foto->getClientOriginalExtension();
    if ($size>=1024000) {
      return redirect('/register-list'.'/'.$id_pasien)->with('alert','file foto tidak boleh melebihi dari 1MB');
    }
    $Nfoto=$id_pasien;
    $idfoto=$req->$Nfoto;
      if ($idfoto==$id_pasien) {

      }elseif($idfoto!=$id_pasien) {
          $data=DB::table('d_pasien')->select('foto')->where('id_pasien',$id_pasien)->first();
          File::delete('foto/pasien/'.$data->foto);
          $pict=$req->file('foto');
          $pict->move(public_path().'/foto/pasien',$Nfoto);
      }
    }
    //Ayah
    $nama_A=$req->nama_A;
    $nik_A=$req->nik_A;
    $agama_A=$req->agama_A;
    $alamat_A=$req->alamat_A;
    $pekerjaan_A=$req->pekerjaan_A;
    $pendTerakhir_A=$req->pendTerakhir_A;
    $noTelp_A=$req->noTelp_A;
    $email_A=$req->email_A;
    //ibu
    $nama_I=$req->nama_I;
    $nik_I=$req->nik_I;
    $agama_I=$req->agama_I;
    $alamat_I=$req->alamat_I;
    $pekerjaan_I=$req->pekerjaan_I;
    $pendTerakhir_I=$req->pendTerakhir_I;
    $noTelp_I=$req->noTelp_I;
    $email_I=$req->email_I;
    //
    $assesor=$req->assesor;
    $J_terapi=$req->J_terapi;
    $tgl_mulai_terapi=$req->tgl_mulai_terapi;
    $tgl_selesai_terapi=$req->tgl_selesai_terapi;
    $status=$req->status;

    $now=date('ymd');
    //id_asses

    $data_A=[
      'id_pegawai'=>$assesor,
      'tgl_mulai_terapi'=>$tgl_mulai_terapi,
      'tgl_selesai_terapi'=>$tgl_selesai_terapi,
      'status_pasien'=>$status];
    $data_DP=[
      'nama'=>$nama_P,
      'tempat_lahir'=>$tempat_lahir,
      'tgl_lahir'=>$tanggal_lahir,
      'jk'=>$jk,
      'agama'=>$agama,
      'alamat'=>$alamat_P,
      'tlp'=>$notelp_P,
      'keluhan'=>$keluhan,
      'foto'=>$Nfoto,
      'nama_ayah'=>$nama_A,
      'nik_ayah'=>$nik_A,
      'agama_ayah'=>$agama_A,
      'alamat_ayah'=>$alamat_A,
      'pend_ayah'=>$pendTerakhir_A,
      'tlp_ayah'=>$noTelp_A,
      'pekerjaan'=>$pekerjaan_A,
      'email_ayah'=>$email_A,
      'nama_ibu'=>$nama_I,
      'nik_ibu'=>$nik_I,
      'agama_ibu'=>$agama_I,
      'alamat_ibu'=>$alamat_I,
      'pend_ibu'=>$pendTerakhir_I,
      'pekerjaan_ibu'=>$pekerjaan_I,
      'tlp_ibu'=>$noTelp_I,
      'email_ibu'=>$email_I,
    ];


    $cariA=DB::table('assessment')->where('id_pasien',$id_pasien);
    if ($cariA->count()==0) {
      DB::table('assessment')->insert($data_A);
    }else{
      DB::table('assessment')->where('id_pasien',$id_pasien)->update($data_A);
    }
    $id_asses=$cariA->first();

    $record=[
      'id_asses'=>$id_asses->id_asses,
      'id_pasien'=>$id_pasien,
      'keterangan'=>$status,
      'tgl'=>$now
    ];
      DB::table('d_pasien')->where('id_pasien',$id_pasien)->update($data_DP);

      DB::table('daftar')->where('id_pasien',$id_pasien)->orderBY('id_daftar','desc')->limit('1')->update(['status'=>'1']);
      DB::table('record_status_pasien')->insert($record);
      if ($req->J_terapi=="") {

      }else{
        foreach ($req->J_terapi as $J_terapi) {
          $T_pasien=[
            'id_asses'=>$id_asses->id_asses,
            'id_terapi'=>$J_terapi,
            'status'=>'0',
            'keterangan'=>'Asses'
          ];
          DB::table('terapi_pasien')->insert($T_pasien);
        }
      }

      return redirect ('/register-list');
  }

  //Jadwal Terapi
  public function jadwalasses($id){
    $isi=DB::table('terapi_pasien')
    ->join('jenis_terapi','jenis_terapi.id_terapi','=','terapi_pasien.id_terapi')
    ->where('id_asses',$id)->get();
    $terapis=DB::table('d_pegawai')->where('id_pegawai','like','T%')->get();
    return view('main_menu.jadwal-add',[
      'isi'=>$isi,
      'id'=>$id,
      'terapis'=>$terapis]);
  }

  public function addjadwal(Request $req){
    $id_terapi=$req->id_terapi;
    $jam_masuk=$req->jam_masuk;
    $jam_keluar=$req->jam_keluar;
    $id_asses=$req->id_asses;
    $tgl=$req->tgl;
    $terapis=$req->terapis;
    $id_terapipasien=$req->id_terapipasien;
    $biaya=$req->biaya;
    $id_asses=$req->id_asses;
    $no=-1;
    foreach ($id_terapi as $id_terapi) {
      $no++;
      $id=$id_terapi;
      $masuk=$jam_masuk[$no];
      $keluar=$jam_keluar[$no];
      $tgls=$tgl[$no];
      $terps=$terapis[$no];
      $id_terapiP=$id_terapipasien[$no];
      $cost=$biaya[$no];
      $sql=[
        'id_pegawai'=>$terps,
        'id_asses'=>$id_asses,
        'id_terapipasien'=>$id_terapiP,
        'biaya'=>$cost,
        'tgl'=>$tgls,
        'jam_masuk'=>$masuk,
        'jam_keluar'=>$keluar,
        'keterangan'=>'Terapi',
        'status_pasien'=>'Hadir'
      ];

      DB::table('assessment')->where('id_asses',$id_asses)->update(['status_pasien'=>'Pasien']);
      DB::table('terapi_pasien')->where('id_asses',$id_asses)->update(['keterangan'=>'Pasien']);
      DB::table('jadwal_terapis')->insert($sql);

    }
    $now=date('ymd');
    $id_pasien=DB::table('assessment')->where('id_asses',$id_asses)->first();
    $record=[
      'id_asses'=>$id_asses,
      'id_pasien'=>$id_pasien->id_pasien,
      'keterangan'=>'Pasien',
      'tgl'=>$now
    ];
    DB::table('record_status_pasien')->insert($record);

    $data = [
      'id_rm' => 'RM'.date('YmdHis'),
      'id_pasien' => $id_pasien->id_pasien,
      'id_asses' => $id_asses,
      'diagnosa' => $id_pasien->diagnosa
    ];

    RekamMedis::insert($data);

    return redirect('jadwal-terapi');
  }

  public function jadwalterapi(){
    $sql = DB::table('jadwal_terapis')
    ->select('jadwal_terapis.*','d_pasien.nama as namaP','d_pegawai.nama')
    ->join('d_pegawai','d_pegawai.id_pegawai','=','jadwal_terapis.id_pegawai')
    ->leftJoin('assessment','assessment.id_asses','=','jadwal_terapis.id_asses')
    ->leftJoin('d_pasien','d_pasien.id_pasien','=','assessment.id_pasien');
    //fullcalendar
      $events = [];
      $data=$sql->get();
      if($data->count()) {
          foreach ($data as $value) {
            $color = dechex(rand(0x000000, 0xFFFFFF));
              $events[] = Calendar::event(
                  $value->nama.' - '.$value->namaP,
                  false,
                  $value->tgl.'T'.$value->jam_masuk,
                  $value->tgl.'T'.$value->jam_keluar,
                  null,
                  // Add color and link on event
                [
                    'color' => '#'.$color,
                    'url' => '#',
                ]
              );
          }
      }
      $calendar = Calendar::addEvents($events)
      ->setOptions([ //set fullcalendar options
          'firstDay' => 1
         ]);

         //jadwal tabel hari ini
         $sqlterapis=DB::table('request_jadwal')
                  ->join('d_pegawai','d_pegawai.id_pegawai','=','request_jadwal.id_pegawai')
                  ->where('request_jadwal.id_pegawai','like','T%')
                  ->whereNull('id_jadwal')
                  ->orderBy('deskripsi','desc');
         $rterapis=$sqlterapis->get();
         $countrterapis=$sqlterapis->where('deskripsi','Request')->count();
         //req izin terapis
         $sqlizinterapis=DB::table('request_jadwal')
                  ->join('d_pegawai','d_pegawai.id_pegawai','=','request_jadwal.id_pegawai')
                  ->where('request_jadwal.id_pegawai','like','T%')
                  ->whereNotNull('request_jadwal.id_jadwal')
                  ->whereNotNull('request_jadwal.id_pegawai')
                  ->orderBy('deskripsi','desc');
         $rizinterapis=$sqlizinterapis->get();
         $countizinrterapis=$sqlizinterapis->where('deskripsi','Request')->count();
         //req izin pasien
         $sqlrpasien=DB::table('request_jadwal')
                  ->join('d_pasien','d_pasien.id_pasien','=','request_jadwal.id_pasien')
                  ->where('request_jadwal.id_pasien','<>','')
                  ->whereNotNull('request_jadwal.id_jadwal')
                  ->whereNotNull('request_jadwal.id_pasien')
                  ->orderBy('deskripsi','desc');
         $rpasien=$sqlrpasien->get();
         $countrpasien=$sqlrpasien->where('deskripsi','Request')->count();
         //
         $data2=$sql->where('jadwal_terapis.tgl',date('Y-m-d'))->orderBY('jadwal_terapis.jam_masuk','asc')->get();
         $sqlassessment=DB::table('assessment')
                      ->select('assessment.*','d_pasien.nama as namaP', 'd_pegawai.nama as namaA')
                      ->join('d_pasien','d_pasien.id_pasien','=','assessment.id_pasien')
                      ->join('d_pegawai','d_pegawai.id_pegawai','=','assessment.id_pegawai')
                      ->where('status_pasien','Asses');
          $assessment=$sqlassessment->get();
          $countassessment=$sqlassessment->count();
      return view('main_menu.jadwalterapi', compact('calendar'),[
        'data2'=>$data2,
        'rterapis'=>$rterapis,
        'rizinterapis'=>$rizinterapis,
        'rpasien'=>$rpasien,
        'assessment'=>$assessment,
        'countrpasien'=>$countrpasien,
        'countrterapis'=>$countrterapis,
        'countizinrterapis'=>$countizinrterapis,
        'countassessment'=>$countassessment
      ]);
  }

  public function validatejadwal($idJ,$id,$validate,$type){
    if ($validate=="Diterima") {
        if ($type=="req-izin-pasien") {
          DB::table('jadwal_terapis')->where('id_jadwal',$idJ)->update(['status_pasien'=>'Izin']);
        }elseif ($type=="req-izin-terapis") {
          DB::table('jadwal_terapis')->where('id_jadwal',$idJ)->update(['status_terapis'=>'Izin']);
        }
        DB::table('request_jadwal')->where('id_requestjadwal',$id)->update(['deskripsi'=>'Diterima']);
    }elseif ($validate=="Ditolak") {
      DB::table('request_jadwal')->where('id_requestjadwal',$id)->update(['deskripsi'=>'Ditolak']);
    }
    return redirect('/jadwal-terapi');
  }
}
