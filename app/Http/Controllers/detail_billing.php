<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use MaddHatter\LaravelFullcalendar\Facades\Calendar;
use DB;
use DateTime;

class detail_billing extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sql = DB::table('d_billing')->select('h_billing.biaya as total', 'd_billing.id_bill_detail', 'd_pasien.nama', 'd_pasien.nama_ayah', 'd_pasien.nama_ibu', 'd_pasien.tempat_lahir', 'd_pasien.tgl_lahir', 'd_pasien.tlp', 'd_pasien.tlp_ayah', 'd_pasien.tlp_ibu', 'jadwal_terapis.*', 'jenis_terapi.terapi', 'd_billing.sesi', 'jenis_terapi.id_terapi', 'd_billing.biaya', 'h_billing.sisa_sesi', 'jadwal_terapis.biaya as bps')->join('h_billing', 'd_billing.id_bill', '=', 'h_billing.id_bill')->join('assessment', 'h_billing.id_asses', '=', 'assessment.id_asses')->join('d_pasien', 'assessment.id_pasien', '=', 'd_pasien.id_pasien')->join('jadwal_terapis', 'd_billing.id_jadwal', '=', 'jadwal_terapis.id_jadwal')->join('terapi_pasien', 'jadwal_terapis.id_terapipasien', '=', 'terapi_pasien.id_terapipasien')->join('jenis_terapi', 'terapi_pasien.id_terapi', '=', 'jenis_terapi.id_terapi')->where('d_billing.id_bill', $id);
        //fullcalendar
            $events = [];
            $data=$sql->get();
            if($data->count()) {
            foreach ($data as $value) {
            $color = dechex(rand(0x000000, 0xFFFFFF));
            $events[] = Calendar::event(
                $value->id_terapi,
                false,
                $value->tgl.'T'.$value->jam_masuk,
                $value->tgl.'T'.$value->jam_keluar,
                null,
                // Add color and link on event
                [   
                'backgroundColor' => 'red',
                'url' => '#',
                ]
            );

            }
        }
        $a = $sql->first();
        $calendar = Calendar::addEvents($events)->setOptions([ //set fullcalendar options
            'defaultDate'=> $a->tgl,
            'editable'=> true,
            'locale'=> 'id',
            'firstDay'=> 1,
            'eventLimit'=> false, // allow "more" link when too many events
            'fixedWeekCount'=> false,
            'showNonCurrentDates'=> false,
            'header'=>[
                    'left'=> '',
                    'center'=>'title',
                    'right'=>''
                  ],
            'overlap' =>false,
            'color'=> 'yellow',
            'aspectRatio' => 1
         ]);

        $data2 = DB::table('h_billing')->select('d_pasien.nama', 'd_pasien.nama_ayah', 'd_pasien.nama_ibu', 'd_pasien.tempat_lahir', 'd_pasien.tgl_lahir', 'd_pasien.tlp', 'd_pasien.tlp_ayah', 'd_pasien.tlp_ibu', 'h_billing.id_asses')->join('assessment', 'h_billing.id_asses', '=', 'assessment.id_asses')->join('d_pasien', 'assessment.id_pasien', '=', 'd_pasien.id_pasien')->where('h_billing.id_bill', $id)->get();
        $b = date('F Y', strtotime($a->tgl));
        $jadwal = DB::table('jadwal_terapis')->select(DB::raw('SUM(d_billing.sesi) jml_sesi'), DB::raw('Month(jadwal_terapis.tgl) month'), DB::raw('DATE(jadwal_terapis.tgl) day'), 'jenis_terapi.id_terapi', 'jadwal_terapis.jam_masuk', 'jadwal_terapis.jam_keluar', 'nama')->join('h_billing', 'jadwal_terapis.id_asses', '=', 'h_billing.id_asses')->join('d_pegawai', 'jadwal_terapis.id_pegawai', '=', 'd_pegawai.id_pegawai')->join('jenis_terapi', 'd_pegawai.id_terapi', '=', 'jenis_terapi.id_terapi')->join('d_billing', 'h_billing.id_bill', '=', 'd_billing.id_bill')->where('h_billing.id_bill', $id)->groupBy('month', 'd_billing.id_bill', 'jadwal_terapis.id_asses', 'h_billing.id_bill');
        
        $jadwal_all = $jadwal->get();
        $jml = $jadwal->first();
        return view('billing.view_detail_billing', compact('calendar'), [
            'data' => $data,
            'dp' => $data2,
            'jadwal' => $jadwal_all,
            'tgl' => $b,
            'total' => $a->total,
            'sisa_sesi' => $a->sisa_sesi,
            'bps' => $a->bps,
            'jml_sesi' => $jml->jml_sesi,
            'id' => $id
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
