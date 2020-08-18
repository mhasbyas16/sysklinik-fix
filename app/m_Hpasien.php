<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class m_Hpasien extends Model
{
    protected $table = "h_pasien";
    protected $fillable = ['*'];
    public $timestamps = false;
}
