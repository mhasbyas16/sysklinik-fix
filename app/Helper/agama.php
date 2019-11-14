<?php
namespace App\Helper;

class agama{
  public static function listagama(){
    $agama=[
      'Islam',
      'Kristen',
      'Katolik',
      'Protestan',
      'Hindu',
      'Buddha'
    ];

    return $agama;
  }
  public static function liststatus(){
    $agama=[
      'Daftar',
      'Cancel',
      'Asses',
      'Pasien'
    ];

    return $agama;
  }

}

 ?>
