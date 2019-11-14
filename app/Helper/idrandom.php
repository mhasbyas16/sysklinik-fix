<?php
namespace App\Helper;

class idrandom{
  public static function id(){
    $angka=range(0,9);
    shuffle($angka);
    $id=array_rand($angka,3);
    $idstring=implode($id);
    $id_asses=$idstring;

    return $id_asses;
  }
}

 ?>
