<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class transaksi_keuangan extends Model
{
    protected $fillable=['*'];
 
    public static function getEnumColumnValues($table, $column) {
 
      $type = DB::select(DB::raw("SHOW COLUMNS FROM $table WHERE Field = '{$column}'"))[0]->Type ;
 
      preg_match('/^enum\((.*)\)$/', $type, $matches);
 
      $enum_values = array();
      foreach( explode(',', $matches[1]) as $value )
      {
        $v = trim( $value, "'" );
        $enum_values = array_add($enum_values, $v, $v);
      }
      return $enum_values;
    }


}
