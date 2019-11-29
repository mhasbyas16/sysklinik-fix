<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BuktiBilling extends Model
{
    //
    protected $table = "bukti_billing";
    protected $fillable = ["*"];
    public $timestamps = false;
}
