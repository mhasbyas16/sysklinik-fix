<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class d_terapis extends Model
{
    protected $table = 'd_pegawai';

    public function Event()
    {
        return $this->belongsTo('App\Event');
    }
}
