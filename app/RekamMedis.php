<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RekamMedis extends Model
{
    protected $table = "h_rekam_medis";
    protected $fillable = ['*'];
    public $timestamps = false;
}
