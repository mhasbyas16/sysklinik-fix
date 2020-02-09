<?php

namespace App\Http\Controllers;

use App\Http\Controllers;
use Carbon\Carbon;
use App\Event;
use DB;

class SystemCalendarController extends Controller
{
    public $sources = [
        [
            'model'      => '\\App\\Event',
            'date_field' => 'tgl',
            'end_field'  => 'jam_masuk',
            'field'      => 'id_asses',
            'prefix'     => '',
            'suffix'     => '',
            /*'route'      => 'admin.events.edit',*/
        ],
    ];

    public function index()
    {
        $coba = DB::table('jadwal_terapis')
        ->select('assessment.*','d_pasien.nama as namaP', 'd_pasien.id_pasien as idpasien','jadwal_terapis.*', 'd_pegawai.nama')
        ->join('assessment','assessment.id_asses','=','jadwal_terapis.id_asses')
        ->join('d_pasien','d_pasien.id_pasien','=','assessment.id_pasien')
        ->join('d_pegawai', 'd_pegawai.id_pegawai','=','jadwal_terapis.id_pegawai')
        ->get();

        $events2=Event::withCount('events')->get();

        $events = [];

        foreach ($this->sources as $source) {
            foreach ($source['model']::all() as $model) {
                $color = dechex(rand(0x000000, 0xFFFFFF));
                $crudFieldValue = $model->getOriginal($source['date_field']);

                if (!$crudFieldValue) {
                    continue;
                }

                $events[] = [
                    'title' => trim($source['prefix'] . " " . $model->{$source['field']} . " " . $source['suffix']),
                    'start' => $crudFieldValue,
                    'end'   => $model->{$source['end_field']},
                    'color' => '#'.$color,
                    /*'url'   => route($source['route'], $model->id),*/
                ];
            }
        }

        return view('admin.calendar.calendar', ['events'=>$events, 'events2'=>$events2, 'coba'=>$coba]);
    }
}
