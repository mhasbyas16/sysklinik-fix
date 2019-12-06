<?php
namespace App\Helper;
use DB;

class absensi{
  public static function pasien() {
    $pasien=DB::table('jadwal_terapis')
    ->select('jadwal_terapis.*','d_pasien.nama')
    ->leftJoin('assessment','assessment.id_asses','=','jadwal_terapis.id_asses')
    ->leftJoin('d_pasien','d_pasien.id_pasien','=','assessment.id_pasien');
    return $pasien;
    }
  public static function sumPasien(){
    $pasien=DB::table('jadwal_terapis')
    ->select('jadwal_terapis.*','d_pasien.nama','d_pasien.id_pasien',DB::raw('count(*)as total'))
    ->leftJoin('assessment','assessment.id_asses','=','jadwal_terapis.id_asses')
    ->leftJoin('d_pasien','d_pasien.id_pasien','=','assessment.id_pasien');
    return $pasien;
  }
  public static function terapis(){
    $terapis=DB::table('jadwal_terapis')
    ->select('jadwal_terapis.*','d_pegawai.nama')
    ->leftJoin('d_pegawai','d_pegawai.id_pegawai','=','jadwal_terapis.id_pegawai');
      return $terapis;
  }

  public static function sumTerapis(){
    $terapis=DB::table('jadwal_terapis')
    ->select('jadwal_terapis.*','d_pegawai.nama','d_pegawai.id_pegawai',DB::raw('count(*)as total'))
    ->leftJoin('d_pegawai','d_pegawai.id_pegawai','=','jadwal_terapis.id_pegawai');
      return $terapis;
  }

  public static function karyawan(){
    $karyawan=DB::table('absen_karyawan')
    ->select('absen_karyawan.*','d_pegawai.nama')
    ->join('d_pegawai','d_pegawai.id_pegawai','=','absen_karyawan.id_pegawai');
    return $karyawan;
  }

  public static function sumKaryawan(){
    $karyawan=DB::table('absen_karyawan')
    ->select('absen_karyawan.*','d_pegawai.nama','d_pegawai.id_pegawai',DB::raw('count(*)as total'))
    ->join('d_pegawai','d_pegawai.id_pegawai','=','absen_karyawan.id_pegawai');
    return $karyawan;
  }
}
 ?>
