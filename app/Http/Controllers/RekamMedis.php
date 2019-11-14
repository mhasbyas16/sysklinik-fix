<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Session;
use App\users;
use App\jabatan;
use App\Helper\record;
use App\rekam_medis;

class RekamMedis extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rekam_medis = DB::table('h_rekam_medis')->select('h_rekam_medis.id_rm', 'h_rekam_medis.id_asses', 'h_rekam_medis.diagnosa', 'd_pasien.nama as nama_pasien')->join('d_pasien', 'h_rekam_medis.id_pasien', '=', 'd_pasien.id_pasien')->get();
        return view('rekam_medis.rekamedis', [
            'list_rekam_medis' => $rekam_medis
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $rekam_medis = DB::table('h_rekam_medis')->select('h_rekam_medis.id_rm', 'h_rekam_medis.id_asses', 'd_pasien.nama as nama_pasien')->join('d_pasien', 'h_rekam_medis.id_pasien', '=', 'd_pasien.id_pasien')->get();
        $pasien = DB::table('d_pasien')->select('d_pasien.id_pasien', 'd_pasien.nama')->join('assessment', 'd_pasien.id_pasien', '=', 'assessment.id_pasien')->get();
        $terapis = DB::table('d_pegawai')->select('d_pegawai.*')->join('jabatan', 'd_pegawai.id_jabatan', '=', 'jabatan.id_jabatan')->where('d_pegawai.id_jabatan','=','5')->get();
        $terapi = DB::table('jenis_terapi')->select('*')->get();
        return view('rekam_medis.form_rekamMedis', [
            'list_rekam_medis' => $rekam_medis,
            'pasien' => $pasien,
            'terapis' => $terapis,
            'terapi' => $terapi
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $r)
    {
        $data = [
            'id_rm' => $r->id_pasien,
            'id_asses' => $r->id_terapis,
            'diagnosa' => $r->diagnosa
        ];

        rekam_medis::insert($data);

        return redirect('rekam_medis');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $hapus = rekam_medis::where('id_rm', $id);
        $hapus->delete();

        return redirect('rekam_medis');
    }
}
