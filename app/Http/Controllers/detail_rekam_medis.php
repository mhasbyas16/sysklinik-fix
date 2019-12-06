<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DetailRekamMedis;
use DB;

class detail_rekam_medis extends Controller
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
        $data = [
            'id_rm' => $request->id_rm,
            'id_jadwal' => $request->id_jadwal,
            'area_stimulasi' => $request->area_stimulasi,
            'keterangan' => $request->keterangan
        ];

        DetailRekamMedis::insert($data);

        return redirect('detail_rekam_medis/'.$request->id_rm);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $jadwal = DB::table('jadwal_terapis')->select('jadwal_terapis.*')->join('h_rekam_medis', 'jadwal_terapis.id_asses', '=', 'h_rekam_medis.id_asses')->where('h_rekam_medis.id_rm', $id)->whereNotIn('id_jadwal', DB::table('d_rekam_medis')->pluck('id_jadwal'))->where('status_terapis',  '=', 'Hadir')->get();
        $detail = DetailRekamMedis::join('jadwal_terapis', 'd_rekam_medis.id_jadwal', '=', 'jadwal_terapis.id_jadwal')->where('id_rm', $id)->get();
        return view('rekam_medis.detail_rekamedis', [
            'detail' => $detail,
            'id_rm' => $id,
            'jadwal' => $jadwal
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
    public function destroy(Request $r, $id)
    {
        $hapus = DetailRekamMedis::where('id_sesirm', $id);
        $hapus->delete();

        return redirect('detail_rekam_medis/'.$r->id_rm);
    }
}
