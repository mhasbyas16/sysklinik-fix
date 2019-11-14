<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class transaksi_at extends Model
{
    //ambil data dr database tabel alat_in
    protected $table = "alat_in";
    protected $fillable = ['*'];
    public $timestamps = false;
}
