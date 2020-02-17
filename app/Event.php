<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use SoftDeletes;

    protected $table = 'jadwal_terapis';
    protected $primaryKey = 'id_jadwal';

    protected $dates = [
        'jam_masuk',
        'tgl',
        
    ];

    const RECURRENCE_RADIO = [
        'none'    => 'None',
        'daily'   => 'Daily',
        'weekly'  => 'Weekly',
        'monthly' => 'Monthly',
        'three'   => '3 Months',
    ];

    protected $fillable = [
        'id_pegawai',
        'id_asses',
        'id_terapipasien',
        'keterangan',
        'jam_masuk',
        'jadwal_id',
        'tgl',
        'recurrence',
        'biaya',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function assesment()
    {
        return $this->hasMany('App\assesment');
    }

    public function d_pasien()
    {
        return $this->hasMany('App\d_pasien');
    }

    public function d_terapis()
    {
        return $this->hasMany('App\d_terapis');
    }    

    public function events()
    {
        return $this->hasMany(Event::class, 'jadwal_id', 'id_jadwal');
    }

    public function getStartTimeAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setStartTimeAttribute($value)
    {
        $this->attributes['tgl'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function getEndTimeAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setEndTimeAttribute($value)
    {
        $this->attributes['jam_masuk'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function event()
    {
        return $this->belongsTo(Event::class, 'jadwal_id');
    }

    public function saveQuietly()
    {
        return static::withoutEvents(function () {
            return $this->save();
        });
    }
}
