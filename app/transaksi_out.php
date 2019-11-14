<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class transaksi_out extends Model
{
    //ambil data dr database tabel alat_out
    protected $table = "alat_out";
    protected $fillable = ['*'];
    public $timestamps = false;
}
