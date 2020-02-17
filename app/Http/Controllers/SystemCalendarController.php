<?php

namespace App\Http\Controllers;

use App\Http\Controllers;
use MaddHatter\LaravelFullcalendar\Facades\Calendar;
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
            'route'      => 'admin.events.show',
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

        $sql = Event::withCount('events')
        ->select('jadwal_terapis.*','d_pasien.nama as namaP','d_pegawai.nama','terapi_pasien.id_terapi')
        ->join('terapi_pasien','terapi_pasien.id_terapipasien','=','jadwal_terapis.id_terapipasien')
        ->join('d_pegawai','d_pegawai.id_pegawai','=','jadwal_terapis.id_pegawai')
        ->Join('assessment','assessment.id_asses','=','jadwal_terapis.id_asses')
        ->Join('d_pasien','d_pasien.id_pasien','=','assessment.id_pasien')
        ->get();
        
        /*$events = [];
        foreach ($sql as $value) {//
            $color = dechex(rand(0x000000, 0xFFFFFF));//
              $events[] = Calendar::event(
                  $value->nama.' - '.$value->namaP,
                  false,
                  $value->tgl,
                  false,
                  null,
                  // Add color and link on event
                [
                    'color' => '#'.$color,
                    'url' => '#',
                ]
              );
          }*/
        $events = [];
        //$users = Event::with('assesment', 'd_pasien', 'd_terapis')->get();

        foreach ($this->sources as $source) {
            foreach ($sql as $model) {
                $color = dechex(rand(0x000000, 0xFFFFFF));
                $crudFieldValue = $model->getOriginal($source['date_field']);

                if (!$crudFieldValue) {
                    continue;
                }
                /*$events[] = [
                    'title' => trim($source['prefix'] . " " . $model->{$source['field']} . " " . $source['suffix']),
                    'start' => $crudFieldValue,
                    'end'   => $model->{$source['end_field']},
                    'color' => '#'.$color,
                    'url'   => '#',
                    //'url'   => route($source['route'], $model->id),
                ];*/
                $events[] = Calendar::event(
                    $model->nama.' - '.$model->namaP,
                    false,
                    new \DateTime($crudFieldValue),
                    new \DateTime($model->{$source['end_field']}),
                    null,
                    // Add color
                    [
                        'color' => '#'.$color,
                        'url'   => route($source['route'], $model->id_jadwal),
                    ]
                );
            }
        }
        $calendar = Calendar::addEvents($events);

        return view('admin.calendar.calendar', compact('calendar'), [
            'events'=>$events,
            'events2'=>$events2,
            'coba'=>$coba
        ]);
    }
}
