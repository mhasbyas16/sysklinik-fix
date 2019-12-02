<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Acc extends Model
{
	protected $table = "d_pegawai";
	protected $fillable = ['*'];
    public $timestamps = false;
}
