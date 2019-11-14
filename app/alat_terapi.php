<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class alat_terapi extends Model
{
    protected $table = "alat_terapi";
    protected $fillable = ['*'];
    public $timestamps = false;
}
