<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class register_list extends Model
{
    protected fillable =[
      'id_registerlist',
      'id_daftar',
      'id_asses',
      'tgl_mulai_terapi',
      'tgl_selesai_terapi',
      'status'
    ];
}
