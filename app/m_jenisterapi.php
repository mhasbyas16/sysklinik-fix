<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class m_jenisterapi extends Model
{
    protected $table = "jenis_terapi";
    protected $fillable = ['*'];
    public $timestamps = false;
}