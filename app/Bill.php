<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    protected $table = "h_billing";
    protected $fillable = ["*"];
    public $timestamps = false;

}
