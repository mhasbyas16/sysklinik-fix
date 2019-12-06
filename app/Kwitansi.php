<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kwitansi extends Model
{
    protected $table = "kwitansi";
    protected $fillable = ['*'];
    public $timestamps = false;
}
