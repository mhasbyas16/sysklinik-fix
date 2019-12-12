<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\alat_terapi;
use App\m_jenisterapi;
use App\Helper\idrandom;
use DB;

class alatterapi extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $alatterapi = alat_terapi::all();
        $max = alat_terapi::max('id_barang');
        $jenis=DB::table('jenis_terapi')->get();
        $merks = m_jenisterapi::pluck('id_terapi');
        $merkk = alat_terapi::pluck('id_barang');
        return view('alat_terapi.alatterapi', [
            'at'=>$alatterapi,
            'jenis'=>$jenis,
            'jt'=>$max,
            'merks'=>$merks,
            'merkk'=>$merks
        ]);
    }

    public function merkAjax($id){
        if($id==0){
            $motors = m_jenisterapi::all();
        }else{
            $motors = m_jenisterapi::where('id_terapi','=',$id)->get();
        }
        return $motors;
    }

    public function ambil($id){
        if($id==0){
            $barangs = alat_terapi::all();
        }else{
            $barangs = alat_terapi::where('id_barang','=',$id)->get();
        }
        return $barangs;
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
        $idat = $request->idat;
        $renamaat = $request->namaat;
        $stokawal = $request->stokawal;

        $dataat=[
            'id_barang' => $idat,
            'nama_barang' => $renamaat,
            'stok_awal' => $stokawal,
            'stok' => $stokawal
        ];

        alat_terapi::insert($dataat);
        return redirect('alatterapi');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id_barang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id_barang)
    {
        $alatterapi=alat_terapi::where('id_barang', '=', $id_barang)->get();
        $jenis=DB::table('jenis_terapi')->get();
        $edit=1;
        $alat = alat_terapi::all();
               
        return view ('alat_terapi.alatterapi', [
            'namaat'=>$alatterapi,
            'id_barang'=>$id_barang, 
            'jenis'=>$jenis,
            'edit'=>$edit,
            'at'=>$alat
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_barang)
    {
        $dataat=[
            'id_barang' => $request->idat,
            'nama_barang' => $request->namaat
        ];

        $apa=alat_terapi::where('id_barang', $id_barang);
        $apa->update($dataat);
        return redirect('alatterapi');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_barang)
    {
        $alatterapi=alat_terapi::where('id_barang', '=', $id_barang);
        $alatterapi->delete();

        return redirect('alatterapi');
    }

}
