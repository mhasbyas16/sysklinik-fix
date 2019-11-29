<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LogIn extends Model
{
    protected $table = "assessment";
    protected $fillable = ['*'];
    public $timestamps = false;
}
