<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\detail_rekam_medis;

class DetailRekamMedis extends Controller
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
            'id_sesirm' => $request->id_sesirm,
            'id_jadwal' => $request->id_jadwal,
            'area_stimulasi' => $request->area_stimulasi,
            'keterangan' => $request->keterangan
        ];

        detail_rekam_medis::insert($data);

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
        $detail = detail_rekam_medis::where('id_sesirm', $id)->get();
        return view('rekam_medis.detail_rekamedis', [
            'detail' => $detail,
            'id_sesirm' => $id
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
        $hapus = detail_rekam_medis::where('id_sesirm', $id);
        $hapus->delete();

        return redirect('detail_rekam_medis/'.$r->id_rm);
    }
}
