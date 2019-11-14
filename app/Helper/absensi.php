<?php
namespace App\Helper;
use DB;

class absensi{
  public static function pasien() {
    $pasien=DB::table('absen_terapi')
    ->select('jadwal.*','absen_terapi.status','d_pasien.nama')
    ->leftJoin('jadwal','absen_terapi.id','=','jadwal.id_pasien')
    ->join('d_pasien','d_pasien.id_pasien','=','jadwal.id_pasien');
        return $pasien;
    }
  public static function terapis(){
    $terapis=DB::table('absen_terapi')
    ->select('jadwal.*','absen_terapi.status','d_pegawai.nama')
    ->leftJoin('jadwal','absen_terapi.id','=','jadwal.id_pegawai')
    ->join('d_pegawai','d_pegawai.id_pegawai','=','jadwal.id_pegawai');
      return $terapis;
  }

  public static function karyawan(){
    $karyawan=DB::table('absen_karyawan')
    ->select('absen_karyawan.*','d_pegawai.nama')
    ->join('d_pegawai','d_pegawai.id_pegawai','=','absen_karyawan.id_karyawan');
    return $karyawan;
  }
}
 ?>
