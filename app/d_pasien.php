<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class d_pasien extends Model
{
    protected $table = 'd_pasien';
    
    public function Event()
    {
        return $this->belongsTo('App\Event');
    }
}
