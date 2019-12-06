<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Session;
use File;
use Str;

class datamasterController extends Controller
{


  public function logout(){
    Session::flush();
    return redirect("/login");
  }

  //pasien
  public function datapasien(){
    $data=DB::table('h_pasien')
    ->select('assessment.*','d_pasien.nama as namaPAS','d_pegawai.nama as namaPEG')
    ->leftJoin('assessment','h_pasien.id_pasien','=','assessment.id_pasien')
    ->leftJoin('d_pegawai','assessment.id_pegawai','=','d_pegawai.id_pegawai')
    ->join('d_pasien','d_pasien.id_pasien','=','h_pasien.id_pasien')->get();

    $agama=[
      'Islam',
      'Kristen',
      'Katolik',
      'Protestan',
      'Hindu',
      'Buddha'
    ];
    $kar=DB::table('d_pegawai')->orderBy('nama','asc')->get();
    $j_terapi=DB::table('jenis_terapi')->orderBY('terapi','asc')->get();
    $status=[
      'Daftar',
      'Cancel',
      'Asses',
      'Pasien'
    ];

    return view('data_master.pasien',[
      'data'=>$data,
      'agama'=>$agama,
      'kar'=>$kar,
      'j_terapi'=>$j_terapi,
      'status'=>$status
    ]);
  }

  public function recordpasien($id){
    $data=DB::table('record_status_pasien')->join('d_pasien','d_pasien.id_pasien','=','record_status_pasien.id_pasien')->where('record_status_pasien.id_pasien',$id)->orderBy('id_asses','asc')->get();

    return view('data_master.record-pasien',['data'=>$data]);
  }
/*
  public function datapasienview($id){
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
      $random=idrandom::id();
      $id_asses=$now.$random;


    $data_HP=['status'=>$status];
    $data_A=[
      'id_asses'=>$id_asses,
      'tgl_asses'=>$now,
      'id_pasien'=>$id_pasien,
      'id_terapi'=>$J_terapi,
      'assesor'=>$assesor,
      'tgl_mulai_terapi'=>$tgl_mulai_terapi,
      'tgl_selesai_terapi'=>$tgl_selesai_terapi];
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
      'tgl_daftar'=>$tanggal_daftar,
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
    $cariA=DB::table('assessment')->where('id_pasien',$id_pasien)->count();
    if ($cariA==0) {
      DB::table('assessment')->insert($data_A);
    }else{
      DB::table('assessment')->where('id_pasien',$id_pasien)->update($data_A);
    }
    DB::table('h_pasien')->where('id_pasien',$id_pasien)->update($data_HP);
    DB::table('d_pasien')->where('id_pasien',$id_pasien)->update($data_DP);
      return redirect ('/data-pasien');
  }
*/

//karyawan
  public function karyawan(){
    $data=DB::table('h_pegawai')
    ->join('d_pegawai','d_pegawai.id_pegawai','=','h_pegawai.id_pegawai')
    ->leftJoin('jabatan','jabatan.id_jabatan','=','d_pegawai.id_jabatan')
    ->where('h_pegawai.id_pegawai','like','K%')->get();

    return view('data_master.pegawai',[
      'data'=>$data
    ]);
  }

  public function karyawantambah($kt){
    $angka=range(0,9);
    shuffle($angka);
    $id=array_rand($angka,3);
    $idstring=implode($id);
    $random=$idstring;

    $date=date('ymd');
    $agama=[
      'Islam',
      'Kristen',
      'Katolik',
      'Protestan',
      'Hindu',
      'Buddha'
    ];
    $j_terapi=DB::table('jenis_terapi')->get();
    $jabatan=DB::table('jabatan')->get();
    if ($kt=='terapis') {
      $id='T'.$date.$random;
    }elseif ($kt=='karyawan') {
      $id='K'.$date.$random;
    }
    return view('data_master.pegawai_data',[
      'id'=>$id,
      'agama'=>$agama,
      'j_terapi'=>$j_terapi,
      'jabatan'=>$jabatan
    ]);
  }

  public function karyawaneditview($id){
    $sql=DB::table('h_pegawai')
    ->join('d_pegawai','h_pegawai.id_pegawai','=','d_pegawai.id_pegawai')
    ->leftJoin('jabatan','jabatan.id_jabatan','=','d_pegawai.id_jabatan')
    ->leftJoin('jenis_terapi','jenis_terapi.id_terapi','=','d_pegawai.id_terapi')
    ->where('h_pegawai.id_pegawai',$id);
    $agama=[
      'Islam',
      'Kristen',
      'Katolik',
      'Protestan',
      'Hindu',
      'Buddha'
    ];
    $j_terapi=DB::table('jenis_terapi')->get();
    $jabatan=DB::table('jabatan')->get();

    if ($sql->count()==0) {
      return redirect('/karyawan')->with('alert','gagal menemukan data!!');
    }else{
      $data=$sql->first();
      return view('data_master.pegawai_data',[
        'agama'=>$agama,
        'j_terapi'=>$j_terapi,
        'jabatan'=>$jabatan,
        'data'=>$data
      ]);
    }
  }

  public function pegawaisave(Request $req, $save){
    //data pegawai
    $id=$req->id;
    $pend_akhir=$req->pend_terakhir;
    $nama=$req->nama;
    $jabatan=$req->jabatan;
    $nik=$req->nik;
    $tanggal_masuk=$req->tanggal_masuk;
    $tanggal_lahir=$req->tanggal_lahir;
    $bpjs=$req->bpjs;
    $jk=$req->jk;
    $npwp=$req->npwp;
    $agama=$req->agama;
    $j_terapi=$req->j_terapi;
    $alamat=$req->alamat;
    $no_tlp=$req->no_tlp;
    $hakakses=$req->hakakses;
    //Foto
    $foto=$req->file('foto');
    $size=$foto->getSize();
    $tipe=$foto->getClientOriginalExtension();
    if ($size>=10) {
      return redirect('/karyawan/edit-data'.'/'.$id)->with('alert','file foto tidak boleh melebihi dari 1MB');
    }
    $fotoo=$req->Nfoto;
    $Nfoto=$id;

    if ($save=='add') {
      $pict=$req->file('foto');
      $pict->move(public_path().'/foto/pegawai',$id);
    }elseif ($save=='edit') {
      if ($fotoo==$id) {

      }elseif($fotoo!=$id) {
          $data=DB::table('d_pegawai')->select('foto')->where('id_pegawai',$id)->first();
          File::delete('foto/pegawai/'.$data->foto);
          $pict=$req->file('foto');
          $pict->move(public_path().'/foto/pegawai',$id);
        }
    }

    //Fasilitas
    $gaji=implode(explode(".",$req->gaji));
    $observasi=implode(explode(".",$req->observasi));
    $Asses=implode(explode(".",$req->Asses));
    $konsumsi=implode(explode(".",$req->konsumsi));
    $transport=implode(explode(".",$req->transport));
    $bonus=implode(explode(".",$req->bonus));
    $lembur=implode(explode(".",$req->lembur));
    $password=md5($id);

    $h_pegawai=[
      'id_pegawai'=>$id,
      'password'=>$password,
      'hakakses'=>$hakakses
    ];
    $d_pegawai=[
      'id_pegawai'=>$id,
      'id_jabatan'=>$jabatan,
      'id_terapi'=>$j_terapi,
      'nama'=>$nama,
      'nik'=>$nik,
      'tgl_lahir'=>$tanggal_lahir,
      'jk'=>$jk,
      'agama'=>$agama,
      'alamat'=>$alamat,
      'tlp'=>$no_tlp,
      'pend_akhir'=>$pend_akhir,
      'foto'=>$Nfoto,
      'tgl_masuk'=>$tanggal_masuk,
      'gaji'=>$gaji,
      'observasi'=>$observasi,
      'asses'=>$Asses,
      'konsumsi'=>$konsumsi,
      'bpjs'=>$bpjs,
      'npwp'=>$npwp,
      'transport'=>$transport,
      'bonus'=>$bonus,
      'lembur'=>$lembur
    ];
    if ($save=='add') {
      DB::table('h_pegawai')->insert($h_pegawai);
      DB::table('d_pegawai')->insert($d_pegawai);
      $idp=Str::substr($id,0,1);
      if ($idp=='K') {
        return redirect('/karyawan')->with('alert','Berhasil Menambahkan Data'." ".$nama);
      }else {
        return redirect('/data-terapis')->with('alert','Berhasil Menambahkan Data'." ".$nama);
      }
    }elseif ($save=='edit') {
      DB::table('h_pegawai')->where('id_pegawai',$id)->update($h_pegawai);
      DB::table('d_pegawai')->where('id_pegawai',$id)->update($d_pegawai);
      $idp=Str::substr($id,0,1);
      if ($idp=='K') {
        return redirect('/karyawan')->with('alert','Berhasil Mengubah Data'." ".$nama);
      }else {
        return redirect('/data-terapis')->with('alert','Berhasil Mengubah Data'." ".$nama);
      }
    }
  }

  public function karyawandelete($id){
    $cek=DB::table('h_pegawai')->where('id_pegawai',$id)->count();
    if ($cek==0) {
      $idp=Str::substr($id,0,1);
      if ($idp=='K') {
        return redirect('/karyawan')->with('alertwarn','Data tidak ditemukan');
      }else {
        return redirect('/data-terapis')->with('alertwarn','Data tidak ditemukan');
      }
    }else {
      $data=DB::table('d_pegawai')->select('foto')->where('id_pegawai',$id)->first();
      File::delete('foto/pegawai/'.$data->foto);
      DB::table('h_pegawai')->where('id_pegawai',$id)->delete();
      $idp=Str::substr($id,0,1);
      if ($idp=='K') {
        return redirect('/karyawan')->with('alertwarn','Berhasil Menghapus Data');
      }else {
        return redirect('/data-terapis')->with('alertwarn','Berhasil Menghapus Data');
      }
    }
  }
  //terapis
  public function dataterapis(){
    $data=DB::table('h_pegawai')
    ->join('d_pegawai','d_pegawai.id_pegawai','=','h_pegawai.id_pegawai')
    ->leftJoin('jabatan','jabatan.id_jabatan','=','d_pegawai.id_jabatan')
    ->leftJoin('jenis_terapi','jenis_terapi.id_terapi','=','d_pegawai.id_terapi')
    ->where('h_pegawai.id_pegawai','like','T%')->get();

    return view('data_master.terapis',[
      'data'=>$data
    ]);
  }

  //Terapi
  public function dataterapi(){
    $data=DB::table('jenis_terapi')->orderBY('id_terapi','asc')->get();

    return view('data_master.terapi',[
      'data'=>$data
    ]);
  }
  public function dataterapiadd(Request $req){
    $kode=$req->kode_jenis;
    $nama=$req->nama_jenis;
    $isi=['id_terapi'=>$kode,'terapi'=>$nama];
    DB::table('jenis_terapi')->insert($isi);
    return redirect('/data-terapi');
  }

  public function dataterapidelete($id){
    $id_terapi=$id;
    $sql=DB::table('jenis_terapi')->where('id_terapi',$id_terapi)->delete();
    return redirect('/data-terapi');
  }
}
