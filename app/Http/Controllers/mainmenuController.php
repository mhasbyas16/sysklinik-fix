<?php

namespace App\Http\Controllers;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use MaddHatter\LaravelFullcalendar\Facades\Calendar;
use App\Http\Requests\StoreEventRequest;
use App\Helper\absensi;
use Carbon\Carbon;
use Mail;
use DB;
use File;
use App\RekamMedis;
use App\Event;

class mainmenuController extends Controller
{

  public function jterapiPasien(Request $req){
    $id=$req->id_assess;
    $j_terapi=DB::table('terapi_pasien')
    ->join('jenis_terapi','jenis_terapi.id_terapi','=','terapi_pasien.id_terapi')
    ->where('id_asses',$id)
    ->groupBy('terapi_pasien.id_terapi')
    ->get();
    return response()->json(['j_terapi'=>$j_terapi]);
  }

//AWAL ABSENSI
  public function absensi(){
    $Dawal=date('Y-m-1');
    $Dakhir=date('Y-m-31');
    //pasien
    $pasien=absensi::pasien()->whereBetween('tgl',[$Dawal,$Dakhir])->get();
    //terapis
    $terapis=absensi::terapis()->whereBetween('tgl',[$Dawal,$Dakhir])->get();
    //karyawan
    $karyawan=absensi::karyawan()->whereBetween('tgl',[$Dawal,$Dakhir])->get();
    return view('main_menu.absensi',[
      'pasien'=>$pasien,
      'terapis'=>$terapis,
      'karyawan'=>$karyawan,
      'Dawal'=>$Dawal,
      'Dakhir'=>$Dakhir
    ]);
  }

  public function absensifilter(Request $req, $id){
    $min=$req->min;
    $max=$req->max;
    $Dawal=$min;
    $Dakhir=$max;
    $awal=date('Y-m-1');
    $akhir=date('Y-m-31');

    if ($id=='pasien') {
      $pasien=absensi::pasien()->whereBetween('tgl',[$min,$max])->get();
      
      $terapis=absensi::terapis()->whereBetween('tgl',[$awal,$akhir])->get();
      
      $karyawan=absensi::karyawan()->whereBetween('tgl',[$awal,$akhir])->get();
      
    }elseif ($id=='terapis') {
      $pasien=absensi::pasien()->whereBetween('tgl',[$awal,$akhir])->get();
      
      $terapis=absensi::terapis()->whereBetween('tgl',[$min,$max])->get();
      
      $karyawan=absensi::karyawan()->whereBetween('tgl',[$awal,$akhir])->get();
      
    }elseif ($id=='karyawan') {
      $pasien=absensi::pasien()->whereBetween('tgl',[$awal,$akhir])->get();
      
      $terapis=absensi::terapis()->whereBetween('tgl',[$awal,$akhir])->get();
      
      $karyawan=absensi::karyawan()->whereBetween('tgl',[$min,$max])->get();
      
    }

    return view('main_menu.absensi',[
      'pasien'=>$pasien,
      'terapis'=>$terapis,
      'karyawan'=>$karyawan,
      'Dawal'=>$Dawal,
      'Dakhir'=>$Dakhir
    ]);
  }

  public function exportabsensi($awal,$akhir,$validate){
    if ($validate=='pasien') {
      $pasien=absensi::pasien()->whereBetween('tgl',[$awal,$akhir])->get();
      $sumPasien=absensi::sumPasien()->whereBetween('tgl',[$awal,$akhir])->groupBy('d_pasien.nama')->get();
      return view ('main_menu.absensi-tab.exportPasien',[
      'pasien'=>$pasien,
      'sumPasien'=>$sumPasien,
      'awal'=>$awal,
      'akhir'=>$akhir]);
    } elseif($validate=='terapis') {
      $terapis=absensi::terapis()->whereBetween('tgl',[$awal,$akhir])->get();
      $sumTerapis=absensi::sumTerapis()->whereBetween('tgl',[$awal,$akhir])->groupBy('d_pegawai.nama')->get();
      return view ('main_menu.absensi-tab.exportTerapis',[
      'terapis'=>$terapis,
      'sumTerapis'=>$sumTerapis,
      'awal'=>$awal,
      'akhir'=>$akhir]);
    }elseif($validate=='karyawan'){
      $karyawan=absensi::karyawan()->whereBetween('tgl',[$awal,$akhir])->get();
      $sumKaryawanH=absensi::sumKaryawan()->where('status_hadir','hadir')
        ->whereBetween('tgl',[$awal,$akhir])
        ->groupBy('d_pegawai.nama')
        ->orderBy('d_pegawai.nama','asc')->get();
      $sumKaryawanT=absensi::sumKaryawan()->where('status_hadir','telat')
        ->whereBetween('tgl',[$awal,$akhir])
        ->groupBy('d_pegawai.nama')->get();
      return view ('main_menu.absensi-tab.exportKaryawan',[
      'karyawan'=>$karyawan,
      'sumKaryawanH'=>$sumKaryawanH,
      'sumKaryawanT'=>$sumKaryawanT,
      'awal'=>$awal,
      'akhir'=>$akhir]);
    }   
  }
//AKHIR ABSENSI

//AWAL TAMBAH JADWAL BARU, STATUS ASSES
  public function jadwalasses($id){
    $tabel = DB::table('jadwal_terapis')
    ->select('jadwal_terapis.*','d_pasien.nama as namaP','d_pegawai.nama','terapi_pasien.id_terapi')
    ->join('terapi_pasien','terapi_pasien.id_terapipasien','=','jadwal_terapis.id_terapipasien')
    ->join('d_pegawai','d_pegawai.id_pegawai','=','jadwal_terapis.id_pegawai')
    ->leftJoin('assessment','assessment.id_asses','=','jadwal_terapis.id_asses')
    ->leftJoin('d_pasien','d_pasien.id_pasien','=','assessment.id_pasien')
    ->where('jadwal_terapis.id_asses',$id)->get();
    
    $isi=DB::table('terapi_pasien')
    ->join('jenis_terapi','jenis_terapi.id_terapi','=','terapi_pasien.id_terapi')
    ->where('id_asses',$id)
    ->groupBy('terapi_pasien.id_terapi')
    ->get();

    $terapis=DB::table('d_pegawai')->where('id_pegawai','like','T%')->get();

    $x=DB::table('h_pasien')
    ->select('h_pasien.*','assessment.*', 'd_pasien.*', 'd_pasien.nama as namaPAS','d_pegawai.nama as namaPEG')
    ->leftJoin('assessment','h_pasien.id_pasien','=','assessment.id_pasien')
    ->leftJoin('d_pegawai','assessment.id_pegawai','=','d_pegawai.id_pegawai')
    ->join('d_pasien','d_pasien.id_pasien','=','h_pasien.id_pasien');

    $data=$x->get();
    $nama=$x->where('id_asses',$id)->first();

    $datat=DB::table('h_pegawai')
    ->join('d_pegawai','d_pegawai.id_pegawai','=','h_pegawai.id_pegawai')
    ->leftJoin('jabatan','jabatan.id_jabatan','=','d_pegawai.id_jabatan')
    ->leftJoin('jenis_terapi','jenis_terapi.id_terapi','=','d_pegawai.id_terapi')
    ->where('h_pegawai.id_pegawai','like','T%')->get();

    $ket=[
      'Terapi', 'Assesment', 'Evaluasi', 'Tambahan'
    ];

    $id_jenter=DB::table('jenis_terapi')->select('*')->get();

    return view('admin.events.create_onasses',[
      'isi'=>$isi,
      'nama'=>$nama,
      'id_asses'=>$id,
      'tabel'=>$tabel,
      'terapis'=>$terapis,
      'data'=>$data,
      'datat'=>$datat,
      'ket'=>$ket,
      'id_jenter'=>$id_jenter
    ]);
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
        'status_pasien'=>'Alpha'
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
    DB::table('h_rekam_medis')->insert($data);

    return redirect()->back();
  }

  public function hapusjadwal_asses($id_jadwal){
    $data=DB::table('jadwal_terapis')
      ->select('id_jadwal')
      ->where(['id_jadwal'=>$id_jadwal])->first();

      $cek=DB::table('jadwal_terapis')->where('id_jadwal',$id_jadwal)->count();
      if ($cek==0) {
          return redirect()->back()->with('alertwarn','Data tidak ditemukan');
      }else {
        DB::table('jadwal_terapis')->where('id_jadwal',$id_jadwal)->delete();
        return redirect()->back()->with('alertwarn','Berhasil Menghapus Data');
      }
  }

  public function jadwalterapi(){
    $sql = DB::table('jadwal_terapis')
    ->select('jadwal_terapis.*','d_pasien.nama as namaP','d_pegawai.nama','terapi_pasien.id_terapi')
    ->join('terapi_pasien','terapi_pasien.id_terapipasien','=','jadwal_terapis.id_terapipasien')
    ->join('d_pegawai','d_pegawai.id_pegawai','=','jadwal_terapis.id_pegawai')
    ->Join('assessment','assessment.id_asses','=','jadwal_terapis.id_asses')
    ->Join('d_pasien','d_pasien.id_pasien','=','assessment.id_pasien');
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
    //endfullcalendar

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
         //jadwalkeseluruhan->where('jadwal_terapis.tgl',date('Y-m-d'))
         $data2=$sql->orderBY('jadwal_terapis.tgl','asc')->orderBY('jadwal_terapis.jam_masuk','asc')->get();
         //assessment
         $sqlassessment=DB::table('assessment')
                      ->select('assessment.*','d_pasien.nama as namaP', 'd_pegawai.nama as namaA')
                      ->join('d_pasien','d_pasien.id_pasien','=','assessment.id_pasien')
                      ->join('d_pegawai','d_pegawai.id_pegawai','=','assessment.id_pegawai')
                      ->where('status_pasien','Asses');
         $assessment=$sqlassessment->get();
         $countassessment=$sqlassessment->count();

        $update = DB::table('jadwal_terapis')->where('status', 'Baru')->update(['status' => 'Lama']);

        return view('main_menu.jadwalterapi', compact('events'),[
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
    return redirect('/register-list');
  }
//AWAL TAMBAH JADWAL BARU, STATUS ASSES

//AWAL TAMBAH JADWAL BARU, STATUS PASIEN
  public function tambah_jadwal(){
    $tabel = DB::table('jadwal_terapis')
    ->select('jadwal_terapis.*','d_pasien.nama as namaP','d_pegawai.nama','terapi_pasien.id_terapi')
    ->join('terapi_pasien','terapi_pasien.id_terapipasien','=','jadwal_terapis.id_terapipasien')
    ->join('d_pegawai','d_pegawai.id_pegawai','=','jadwal_terapis.id_pegawai')
    ->leftJoin('assessment','assessment.id_asses','=','jadwal_terapis.id_asses')
    ->leftJoin('d_pasien','d_pasien.id_pasien','=','assessment.id_pasien')
    //->where('jadwal_terapis.id_asses',$id)
    ->get();
    
    $terapis=DB::table('d_pegawai')->where('id_pegawai','like','T%')->get();

    $isi=DB::table('terapi_pasien')
    ->join('jenis_terapi','jenis_terapi.id_terapi','=','terapi_pasien.id_terapi')
    ->groupBy('terapi_pasien.id_terapi')
    ->get();

    $j_terapi=DB::table('terapi_pasien')
    ->join('jenis_terapi','jenis_terapi.id_terapi','=','terapi_pasien.id_terapi')
    ->join('assessment','assessment.id_asses','=','terapi_pasien.id_asses')
    ->join('d_pasien','d_pasien.id_pasien','=','assessment.id_pasien')
    ->where('keterangan','Pasien')
    ->groupBy('d_pasien.id_pasien')
    ->get();

    $pasien=DB::table('record_status_pasien')
    ->join('d_pasien','d_pasien.id_pasien','=','record_status_pasien.id_pasien')
    ->where('record_status_pasien.keterangan','Pasien')
    ->groupBy('d_pasien.id_pasien')
    ->get();

    $ket=[
      'Terapi', 'Assesment', 'Evaluasi', 'Tambahan'
    ];

    return view('main_menu.jadwal_tambah',[
      'terapis'=>$terapis,
      'j_terapi'=>$j_terapi,
      'pasien'=>$pasien,
      'tabel'=>$tabel,
      'isi'=>$isi,
      'ket'=>$ket
    ]);
  }

  public function tambah_jadwal_store(Request $req){
    $id_pasien = $req->pasien;
    $Jterapi = $req->Jterapi;
    $tgl = $req->tgl;
    $jam_masuk = $req->jam_masuk;
    $jam_keluar = $req->jam_keluar;
    $terapis = $req->terapis;
    $biaya = $req->biaya;
    $ket = $req->keterangan;

    $in=[
      'id_pegawai'=>$terapis,
      'id_asses'=>$id_pasien,
      'id_terapipasien'=>$Jterapi,
      'tgl'=>$tgl,
      'jam_masuk'=>$jam_masuk,
      'jam_keluar'=>$jam_keluar,
      'keterangan'=>$ket,
      'biaya'=>$biaya,
      'status_pasien'=>'Alpha',
      'status_terapis'=>'Alpha',
      'status'=>'Baru'
    ];
    DB::table('jadwal_terapis')->insert($in);
    return redirect()->back()->with('alert-success','Success');
  }

  public function edit_jadwal($id_jadwal){
    $tabel = DB::table('jadwal_terapis')
    ->select('jadwal_terapis.*','jadwal_terapis.tgl as tglterapi','d_pasien.nama as namaP','d_pegawai.nama','terapi_pasien.id_terapi')
    ->join('d_pegawai','d_pegawai.id_pegawai','=','jadwal_terapis.id_pegawai')
    ->join('terapi_pasien','terapi_pasien.id_terapipasien','=','jadwal_terapis.id_terapipasien')
    ->leftJoin('assessment','assessment.id_asses','=','jadwal_terapis.id_asses')
    ->leftJoin('d_pasien','d_pasien.id_pasien','=','assessment.id_pasien')
    ->where('jadwal_terapis.id_jadwal',$id_jadwal)
    ->first();

    $terapis=DB::table('d_pegawai')->where('id_pegawai','like','T%')->get();

    $isi=DB::table('terapi_pasien')
    ->join('jenis_terapi','jenis_terapi.id_terapi','=','terapi_pasien.id_terapi')
    ->groupBy('terapi_pasien.id_terapi')
    ->get();

    $j_terapi=DB::table('terapi_pasien')
    ->join('jenis_terapi','jenis_terapi.id_terapi','=','terapi_pasien.id_terapi')
    ->join('assessment','assessment.id_asses','=','terapi_pasien.id_asses')
    ->join('d_pasien','d_pasien.id_pasien','=','assessment.id_pasien')
    ->where('keterangan','Pasien')
    ->groupBy('d_pasien.id_pasien')
    ->get();

    $pasien=DB::table('record_status_pasien')
    ->join('d_pasien','d_pasien.id_pasien','=','record_status_pasien.id_pasien')
    ->where('record_status_pasien.keterangan','Pasien')
    ->groupBy('d_pasien.id_pasien')
    ->get();

    $ket=[
      'Terapi', 'Assesment', 'Evaluasi', 'Tambahan'
    ];

    return view('main_menu.jadwal_edit',[
      'terapis'=>$terapis,
      'j_terapi'=>$j_terapi,
      'pasien'=>$pasien,
      'tabel'=>$tabel,
      'isi'=>$isi,
      'ket'=>$ket
    ]);
  }

  public function edit_jadwal_store(Request $req){
    $id_jadwal = $req->jdid;
    $id_pasien = $req->pasien;
    $Jterapi = $req->Jterapi;
    $tgl = $req->tgl;
    $jam_masuk = $req->jam_masuk;
    $jam_keluar = $req->jam_keluar;
    $terapis = $req->terapis;
    $biaya = $req->biaya;
    $ket = $req->keterangan;

    $in=[
      'id_pegawai'=>$terapis,
      'id_asses'=>$id_pasien,
      'id_terapipasien'=>$Jterapi,
      'tgl'=>$tgl,
      'jam_masuk'=>$jam_masuk,
      'jam_keluar'=>$jam_keluar,
      'keterangan'=>$ket,
      'biaya'=>$biaya,
      'status_pasien'=>'Alpha',
      'status_terapis'=>'Alpha',
      'status'=>'Baru'
    ];
    DB::table('jadwal_terapis')->where('id_jadwal',$id_jadwal)->update($in);
    return redirect('/register-list')->with('alert-success','Success');
  }
//AKHIR TAMBAH JADWAL BARU, STATUS PASIEN
  
//AWAL TAMBAH ASSES BARU, STATUS PASIEN
  public function tambah_asses(){
    $pasien=DB::table('assessment')
    ->join('d_pasien','d_pasien.id_pasien','=','assessment.id_pasien')
    ->join('record_status_pasien','record_status_pasien.id_pasien','=','assessment.id_pasien')
    ->where('status_pasien','Pasien')
    ->where('status_pasien','Lulus')
    ->get();
    $kar=DB::table('d_pegawai')->orderBy('nama','asc')->get();
    $j_terapi=DB::table('jenis_terapi')->orderBY('terapi','asc')->get();
    $status=[
      'Asses'
    ];
    return view('main_menu.asses_tambah',[
      'kar'=>$kar,
      'j_terapi'=>$j_terapi,
      'status'=>$status,
      'pasien'=>$pasien
    ]);
  }

  public function store_asses(Request $req){
    $id_pasien=$req->pasien;
    $assesor=$req->assesor;
    $j_terapi=$req->J_terapi;
    $tgl_mulai_terapi=$req->tgl_mulai_terapi;
    $tgl_selesai_terapi=$req->tgl_selesai_terapi;
    $status=$req->status;
    $diagnosa='';

    $angka=range(0,9);
    shuffle($angka);
    $id=array_rand($angka,3);
    $idstring=implode($id);
    $random=$idstring;
    $date=date('ymd');
    $id=$date.$random;


    $data_A=[
      'id_asses'=>$id,
      'id_pasien'=>$id_pasien,
      'id_pegawai'=>$assesor,
      'tgl_mulai_terapi'=>$tgl_mulai_terapi,
      'tgl_selesai_terapi'=>$tgl_selesai_terapi,
      'diagnosa'=>$diagnosa,
      'status_pasien'=>$status];

      $record=[
        'id_asses'=>$id,
        'id_pasien'=>$id_pasien,
        'keterangan'=>$status,
        'tgl'=>$date
      ];

    DB::table('assessment')->insert($data_A);
    DB::table('record_status_pasien')->insert($record);
    foreach ($j_terapi as $J_terapi) {
      $T_pasien=[
        'id_asses'=>$id,
        'id_terapi'=>$J_terapi,
        'status'=>'0',
        'keterangan'=>'Asses'
      ];
      DB::table('terapi_pasien')->insert($T_pasien);
    }

    return redirect('/register-list');
  }
//AKHIR TAMBAH ASSES BARU, STATUS PASIEN
  
//AWAL JADWAL EVALUASI
  public function jadwalevaluasi(){
    $x=DB::table('h_pasien')
    ->select('assessment.*','assessment.status_pasien','d_pasien.nama','h_pasien.id_pasien as idpasien','jadwal_terapis.*'
    ,DB::raw('DATE_ADD(assessment.tgl_mulai_terapi, INTERVAL 3 MONTH) as tgl_eval1')
    ,DB::raw('DATE_ADD(assessment.tgl_mulai_terapi, INTERVAL 6 MONTH) as tgl_eval2')
    ,DB::raw('DATE_ADD(assessment.tgl_mulai_terapi, INTERVAL 9 MONTH) as tgl_eval3')
    ,DB::raw('DATE_ADD(assessment.tgl_mulai_terapi, INTERVAL 1 YEAR) as tgl_eval4')
    ,DB::raw('DATE_ADD(assessment.tgl_mulai_terapi, INTERVAL 1-3 YEAR_MONTH) as tgl_eval5')
    ,DB::raw('DATE_ADD(assessment.tgl_mulai_terapi, INTERVAL 1-5 YEAR_MONTH) as tgl_eval6')
    ,DB::raw('jadwal_terapis.tgl as tgl'))
    ->leftJoin('assessment','assessment.id_pasien','=','h_pasien.id_pasien')
    ->join('jadwal_terapis','assessment.id_asses','=','jadwal_terapis.id_asses')
    ->join('d_pasien','d_pasien.id_pasien','=','h_pasien.id_pasien')
    ->groupBy('h_pasien.id_pasien');
    
    $isi=$x->get();/*
    $hef=$x->first();*/

    $ambil=DB::table('jadwal_terapis')
    ->select('assessment.*','d_pasien.nama as namaP', 'd_pasien.id_pasien as idpasien','jadwal_terapis.*', 'd_pegawai.nama')
    ->join('assessment','assessment.id_asses','=','jadwal_terapis.id_asses')
    ->join('d_pasien','d_pasien.id_pasien','=','assessment.id_pasien')
    ->join('d_pegawai', 'd_pegawai.id_pegawai','=','jadwal_terapis.id_pegawai')
    ->where('jadwal_terapis.keterangan','Evaluasi')
    ->get();

    $events = Event::withCount('events')->where('keterangan','Evaluasi')->get();

    $coba = DB::table('jadwal_terapis')
    ->select('jadwal_terapis.*', 'assessment.id_asses', 'd_pasien.nama')
    ->join('assessment', 'assessment.id_asses','=','jadwal_terapis.id_asses')
    ->join('d_pasien', 'd_pasien.id_pasien','=','assessment.id_pasien')
    ->where('jadwal_terapis.keterangan','Evaluasi')
    ->get();

    return view ('main_menu.jadwaleval',[
      'isi'=>$isi,
      'ambil'=>$ambil,
      'events'=>$events,
      'coba'=>$coba
    ]);
  }

  public function editeval(Event $event){

    $event->load('event')->loadCount('events');

    return view('main_menu.edit_jadwaleval', compact('event'));

    /*return view ('main_menu.edit_jadwaleval',['ambil'=>$ambil]); */
  }

  public function jadwalevaluasifilter(Request $req){
    $min=$req->min;
    $max=$req->max;
    $pilih=$req->pilih;
    $isi=DB::table('h_pasien')
    ->select('h_pasien.id_pasien as idpasien','assessment.*','assessment.status_pasien','d_pasien.nama'
   ,DB::raw('DATE_ADD(assessment.tgl_mulai_terapi, INTERVAL 3 MONTH) as tgl_eval1')
   ,DB::raw('DATE_ADD(assessment.tgl_mulai_terapi, INTERVAL 6 MONTH) as tgl_eval2')
   ,DB::raw('DATE_ADD(assessment.tgl_mulai_terapi, INTERVAL 9 MONTH) as tgl_eval3')
   ,DB::raw('DATE_ADD(assessment.tgl_mulai_terapi, INTERVAL 1 YEAR) as tgl_eval4')
   ,DB::raw('DATE_ADD(assessment.tgl_mulai_terapi, INTERVAL 1-3 YEAR_MONTH) as tgl_eval5')
   ,DB::raw('DATE_ADD(assessment.tgl_mulai_terapi, INTERVAL 1-5 YEAR_MONTH) as tgl_eval6')
   ,DB::raw('jadwal_terapis.tgl as tgl'))
    ->leftJoin('assessment','h_pasien.id_pasien','=','assessment.id_pasien')
    ->join('d_pasien','d_pasien.id_pasien','=','h_pasien.id_pasien')
    ->join('jadwal_terapis', 'jadwal_terapis.id_asses','=','assessment.id_asses')
    ->where('jadwal_terapis.keterangan','Evaluasi')
    ->whereBetween($pilih,[$min,$max])
    ->get();

    return view ('main_menu.jadwaleval',[
      'isi'=>$isi]);
  }

  public function jadwalevaluasiupdate(Request $req){

      $id_terapi=$req->id_pegawai;
      $id_asses=$req->id_asses;
      $id_terapipasien=$req->id_terapipasien;
      $tgl1=$req->tgl1;
      $tgl2=$req->tgl2;
      $tgl3=$req->tgl3;
      $tgl4=$req->tgl4;
      $tgl5=$req->tgl5;
      $tgl6=$req->tgl6;
      $jam_masuk=$req->jam_masuk;
      $jam_keluar=$req->jam_keluar;
      $terapis=$req->terapis;
      $biaya=$req->biaya;
      $recur=$req->recurrence;

      $data_tanggal = array($tgl1, $tgl2, $tgl3, $tgl4, $tgl5, $tgl6);

      for ($i=0; $i<count($data_tanggal); $i++) { 
        echo $data_tanggal[$i].'<br>';
          $data = [
            'id_pegawai'=>$id_terapi,
            'id_asses'=>$id_asses,
            'id_terapipasien'=>$id_terapipasien,
            'tgl'=>$data_tanggal[$i],
            'biaya'=>$biaya,
            'jam_masuk'=>$jam_masuk,
            'jam_keluar'=>$jam_keluar,
            'keterangan'=>'Evaluasi',
            'status_pasien'=>'Alpha',
            'status_terapis'=>'Alpha',
            'status'=>'Baru',
            'recurrence'=>'none'
          ];
          $insert_data = DB::table('jadwal_terapis')->insert($data);
      }

      return redirect()->back();
  }
//AKHIR JADWAL EVALUASI

//AWAL DETAIL EDIT DATA PASIEN & UPDATE, STATUS ASSES
  public function registerlist(){
    //TAB REGISTER LIST
    $awal=date('Y-m-01');
    $akhir=date('Y-m-31');
    $isi=DB::table('h_pasien')
    ->select('h_pasien.id_pasien','d_pasien.nama','assessment.*')
    ->leftJoin('d_pasien','d_pasien.id_pasien','=','h_pasien.id_pasien')
    ->leftJoin('assessment','assessment.id_pasien','=','h_pasien.id_pasien')
    //->whereBetween('record_status_pasien.tgl',[$awal,$akhir])
    ->where('assessment.status_pasien','Daftar')->get();

    $update = DB::table('assessment')->where('status', 'Baru')->update(['status' => 'Lama']);

    //TAB ASSESSMENT DAN LAINNYA
    $sql = DB::table('jadwal_terapis')
    ->select('jadwal_terapis.*','d_pasien.nama as namaP','d_pegawai.nama','terapi_pasien.id_terapi')
    ->join('terapi_pasien','terapi_pasien.id_terapipasien','=','jadwal_terapis.id_terapipasien')
    ->join('d_pegawai','d_pegawai.id_pegawai','=','jadwal_terapis.id_pegawai')
    ->Join('assessment','assessment.id_asses','=','jadwal_terapis.id_asses')
    ->Join('d_pasien','d_pasien.id_pasien','=','assessment.id_pasien');

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
         //jadwalkeseluruhan->where('jadwal_terapis.tgl',date('Y-m-d'))
         $data2=$sql->orderBY('jadwal_terapis.tgl','asc')->orderBY('jadwal_terapis.jam_masuk','asc')->get();
         //assessment
         $sqlassessment=DB::table('assessment')
                      ->select('assessment.*','d_pasien.nama as namaP', 'd_pegawai.nama as namaA')
                      ->join('d_pasien','d_pasien.id_pasien','=','assessment.id_pasien')
                      ->join('d_pegawai','d_pegawai.id_pegawai','=','assessment.id_pegawai')
                      ->where('status_pasien','Asses');
         $assessment=$sqlassessment->get();
         $countassessment=$sqlassessment->count();

        $update = DB::table('jadwal_terapis')->where('status', 'Baru')->update(['status' => 'Lama']);

        /*return view('main_menu.jadwalterapi', compact('events'),[]);*/
    return view ('main_menu.registerlist',[
      'isi'=>$isi,
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
    ->leftJoin('h_pasien','h_pasien.id_pasien','=','d_pasien.id_pasien')
    ->leftJoin('record_status_pasien','record_status_pasien.id_pasien','=','h_pasien.id_pasien')
    ->leftJoin('assessment','assessment.id_pasien','=','d_pasien.id_pasien')
    ->where('d_pasien.id_pasien',$id)->orderBY('record_status_pasien.id_status','desc')->first();
    $assessment=DB::table('assessment');
    $count=$assessment->where('id_pasien',$id)->count();
    //lahir
    $tgl_lahir=explode('-',$data->tgl_lahir);
    $tahun=$tgl_lahir[0];
    $bulan=$tgl_lahir[1];
    $tahun_now=date('Y');
    $bulan_now=date('m');
    $agama=[
      'Islam',
      'Kristen',
      'Katolik',
      'Protestan',
      'Hindu',
      'Buddha'
    ];
    $status=[
      'Daftar',
      'Cancel',
      'Asses',
      'Pasien',
      'Lulus'
    ];
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
    $uang_pangkal=$req->b_pangkal;
    $uang_asses=$req->b_asses;
    $uang_eval=$req->b_eval;
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
      'status_pasien'=>$status,
      'evaluasi'=>$uang_eval,
      'asses'=>$uang_asses,
      'uang_pangkal'=>$uang_pangkal
    ];
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
      'email_ibu'=>$email_I
    ];

    //update data assessment
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

    //update data
    DB::table('d_pasien')->where('id_pasien',$id_pasien)->update($data_DP);
    DB::table('daftar')->where('id_pasien',$id_pasien)->orderBY('id_daftar','desc')->limit('1')->update(['status'=>'1']);
    DB::table('record_status_pasien')->insert($record);

    $cek=DB::table('terapi_pasien')->where('id_asses',$id_asses->id_asses)->where('id_terapi',$req->J_terapi)->count();
      if ($cek==0) {
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
      }else {
        DB::table('terapi_pasien')->where('id_asses',$id_asses->id_asses)->where('id_terapi',$req->J_terapi)->delete();
      }
      
    return redirect('/register-list');
  }

  public function toregist(){
    return view('main_menu.registerlist_new');
  }

  public function simpantoregist(request $req){
    //pasien
    $id_pasien=$req->id_pasien;
    $nama_P=$req->nama_P;
    $jk=$req->jk;
    $alamat_P=$req->alamat_P;
    $alamatsekolah_P=$req->alamatsekolah_P;
    $tempat_lahir=$req->tempat_lahir;
    $tanggal_lahir=$req->tanggal_lahir;
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
    //pelengkap
    $iq=$req->iq;
    $mapel=$req->mapel;
    $ulang=$req->ulang;
    //PENGISI KUESIONER
    $isinama=$req->isinama;
    $isiselaku=$req->isiselaku;
    $isipendidikan=$req->isipendidikan;
    $isipekerjaan=$req->isipekerjaan;
    $isialamat=$req->isialamat;

    $now=date('ymd');
    
    $data_DP=[
      'id_pasien'=>$,
      'nama'=>$nama_P,
      'tempat_lahir'=>$tempat_lahir,
      'tgl_lahir'=>$tanggal_lahir,
      $tanggal_daftar,
      'jk'=>$jk,
      'agama'=>$agama,
      'alamat'=>$alamat_P,
      'alamatsekolah'=>$alamatsekolah_P,
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

      'total_iq'=>$iq,
      'mapel'=>$mapel,
      'kelas'=>$ulang,

      'namapengisi'=>$isinama,
      'selaku'=>$isiselaku,
      'pendidikan'=>$isipendidikan,
      'kerja'=>$isipekerjaan,
      'alamatpengisi'=>$isialamat,
    ];

    //simpan data
    $now = date('ymd');
    $dataakhir = \App\m_daftarpasien::max('id_pasien');
    $no = $dataakhir;
    $noo = $no++;
    $lama = substr($no, 0, 6);
    $rplc = str_replace($lama, $now, $noo);
    $idasses=$rplc;

    $header_pasien=[      
      'id_pasien'=>,
      'email'=>,
      'username'=>,
      'password'=>,
      'konfirmasi'=>'Belum',
    ];
    $asses=[
      'id_pasien'=> $id,
      'id_asses'=> $idasses,
      'status_pasien'=> 'Daftar'
    ];

    $recstatus=[       
      'id_pasien'=> $id,
      'id_asses'=> $idasses,
      'keterangan' => 'Daftar',
      'tgl' => $now
    ];

    DB::table('h_pasien')->insert($header_pasien);
    DB::table('d_pasien')->insert($data_DP);
    DB::table('assessment')->insert($asses);
    DB::table('record_status_pasien')->insert($recstatus);
    
    return redirect('/register-list');
  }
//AKHIR DETAIL EDIT DATA PASIEN & UPDATE, STATUS ASSES

//AWAL DETAIL EDIT DATA PASIEN & UPDATE, STATUS PASIEN
  public function datapasiendata($id){
    $data=DB::table('d_pasien')
    ->leftJoin('h_pasien','h_pasien.id_pasien','=','d_pasien.id_pasien')
    ->leftJoin('record_status_pasien','record_status_pasien.id_pasien','=','h_pasien.id_pasien')
    ->leftJoin('assessment','assessment.id_pasien','=','d_pasien.id_pasien')
    ->where('d_pasien.id_pasien',$id)->orderBY('record_status_pasien.id_status','desc')->first();

    $dataa=DB::table('d_pasien')
    ->leftJoin('h_pasien','h_pasien.id_pasien','=','d_pasien.id_pasien')
    ->leftJoin('record_status_pasien','record_status_pasien.id_pasien','=','h_pasien.id_pasien')
    ->leftJoin('assessment','assessment.id_pasien','=','d_pasien.id_pasien')
    ->join('terapi_pasien', 'terapi_pasien.id_asses','=','assessment.id_asses')
    ->where('d_pasien.id_pasien',$id)
    ->orderBY('record_status_pasien.id_status','desc')
    ->orderBY('terapi_pasien.id_asses')
    ->first();

    //$dataasses=$data->orderBY('terapi_pasien.id_asses')->first();

    $assessment=DB::table('assessment');
    $count=$assessment->where('id_pasien',$id)->count();
    //lahir
    $tgl_lahir=explode('-',$data->tgl_lahir);
    $tahun=$tgl_lahir[0];
    $bulan=$tgl_lahir[1];
    $tahun_now=date('Y');
    $bulan_now=date('m');
    $agama=[
      'Islam',
      'Kristen',
      'Katolik',
      'Protestan',
      'Hindu',
      'Buddha'
    ];
    $status=[
      'Daftar',
      'Cancel',
      'Asses',
      'Pasien',
      'Lulus'
    ];
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
    return view ('data_master.data_pasien',[
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

  public function datapasienupdate(request $req){
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
    $uang_pangkal=$req->b_pangkal;
    $uang_asses=$req->b_asses;
    $uang_eval=$req->b_eval;
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
      'status_pasien'=>$status,
      'evaluasi'=>$uang_eval,
      'asses'=>$uang_asses,
      'uang_pangkal'=>$uang_pangkal
    ];
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

      $cek=DB::table('terapi_pasien')->where('id_asses',$id_asses->id_asses)->where('id_terapi',$req->J_terapi)->count();
      if ($cek==0) {
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
      }else {
        DB::table('terapi_pasien')->where('id_asses',$id_asses->id_asses)->where('id_terapi',$req->J_terapi)->delete();
      }

      return redirect ('/data-pasien');
  }
//AKHIR DETAIL EDIT DATA PASIEN & UPDATE, STATUS PASIEN

}
