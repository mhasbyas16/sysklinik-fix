<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
	protected $table = "h_pegawai";
	protected $fillable = ['*'];
    public $timestamps = false;
}
