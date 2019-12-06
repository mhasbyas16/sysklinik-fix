<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = "payroll";
    protected $fillable = "*";
    public $timestamps = false;
}
