<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class assesment extends Model
{
    protected fillable =[
      'id_asses',
      'id_daftar',
      'tgl_asses',
      'jenis_asses',
      'id_terapi',
      'assesor',
      'tgl_mulai_terapi',
      'tgl_selesai_terapi',
      'status'
    ];
}
