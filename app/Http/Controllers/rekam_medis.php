<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\RekamMedis;
USE App\Login;
use DB;
use Alert;

class rekam_medis extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Session::get('login')) {
            
            $rekam_medis = DB::table('h_rekam_medis')->select('assessment.*', 'h_rekam_medis.id_rm', 'jenis_terapi.terapi', 'd_pasien.nama')->join('assessment', 'h_rekam_medis.id_asses', '=', 'assessment.id_asses')->join('d_pasien', 'h_rekam_medis.id_pasien', '=', 'd_pasien.id_pasien')->join('terapi_pasien', 'h_rekam_medis.id_asses', '=', 'terapi_pasien.id_asses')->join('jenis_terapi', 'terapi_pasien.id_terapi', '=', 'jenis_terapi.id_terapi')->groupBy('id_asses', 'd_pasien.id_pasien')->get();
            $update = DB::table('h_rekam_medis')->where('status', 'Baru')->update(['status' => 'Lama']);
            return view('rekam_medis.rekamedis', [
                'list_rekam_medis' => $rekam_medis
            ]);
        }else{
            Alert::error('Silahkan login terlebih dahulu!')->autoclose(3500);
            return redirect('/login');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Session::get('login')) {
            
            $pasien = DB::table('d_pasien')->select('d_pasien.*')->join('h_pasien', 'd_pasien.id_pasien', '=', 'h_pasien.id_pasien')->join('assessment', 'd_pasien.id_pasien', '=', 'assessment.id_pasien')->where('assessment.status_pasien', '=', 'Asses')->get();
            $terapis = DB::table('d_pegawai')->select('d_pegawai.*')->join('jabatan', 'd_pegawai.id_jabatan', '=', 'jabatan.id_jabatan')->where('d_pegawai.id_jabatan','=','5')->get();
            $asses = DB::table('assessment')->select('*')->get();
            return view('rekam_medis.form_rekamMedis', [
                'pasien' => $pasien,
                'terapis' => $terapis,
                'asses' => $asses
            ]);
        }else{
            Alert::error('Silahkan login terlebih dahulu!')->autoclose(3500);
            return redirect('/login');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $r)
    {
        if (Session::get('login')) {
            
            $data = [
                'id_asses' => $r->id_asses,
                'id_terapis' => $r->id_terapis,
                'diagnosa' => $r->diagnosa
            ];

            RekamMedis::insert($data);


            Alert::success('Data berhasil ditambahkan')->autoclose(3500);
            return redirect('rekam_medis');
        }else{
            Alert::error('Silahkan login terlebih dahulu!')->autoclose(3500);
            return redirect('/login');
        }
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

        if (Session::get('login')) {
            
            $data = DB::table('h_rekam_medis')->select('nama', 'id_asses', 'diagnosa', 'id_rm')->join('d_pasien', 'h_rekam_medis.id_pasien', '=', 'd_pasien.id_pasien')->where('id_rm', $id)->get();
            return view('rekam_medis.form_rekamMedis', [
                'data' => $data
            ]);
        }else{
            Alert::error('Silahkan login terlebih dahulu!')->autoclose(3500);
            return redirect('/login');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $r, $id)
    {
        if (Session::get('login')) {
            
            $id_asses = $r->id_asses;
            $data = [
                'diagnosa' => $r->diagnosa
            ];

            $update = RekamMedis::where('id_rm', $id);
            $update->update($data);


            Alert::success('Data berhasil diupdate')->autoclose(3500);
            return redirect('rekam_medis');
        }else{
            Alert::error('Silahkan login terlebih dahulu!')->autoclose(3500);
            return redirect('/login');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Session::get('login')) {
            
            $hapus = RekamMedis::where('id_rm', $id);
            $hapus->delete();

            Alert::success('Data berhasil dihapus')->autoclose(3500);
            return redirect('rekam_medis');
        }else{
            Alert::error('Silahkan login terlebih dahulu!')->autoclose(3500);
            return redirect('/login');
        }
    }
}
