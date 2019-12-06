<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\transaksi_at;
use App\transaksi_out;
use App\alat_terapi;
use DB;

class transaksiat extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all = alat_terapi::all();
        $masuk = transaksi_at::all();
        $keluar = transaksi_out::all();
        return view('alat_terapi.transalat', [
            'at'=>$masuk,
            'out'=>$keluar,
            'alll'=>$all
        ]);
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
        $tglat = $request->tglat;
        $noat = $request->noat;
        $idat = $request->input('idat');
        $jmlat = $request->jmlat;

        $datatrans=[
            'tgl' => $tglat,
            'no_kwitansi' => $noat,
            'id_barang' => $idat,
            'jml_barang' => $jmlat
        ];

        if($request->formName == 'masukan') {
            transaksi_at::insert($datatrans);
            DB::table('alat_terapi')->where('id_barang', $request->input('idat'))->increment('stok', $request->input('jmlat'));

        }elseif($request->formName == 'keluaran') {
            transaksi_out::insert($datatrans);
            DB::table('alat_terapi')->where('id_barang', $request->input('idat'))->decrement('stok', $request->input('jmlat'));
        }
        return redirect('transalat');
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
        $masuk = transaksi_at::all();
        $keluar = transaksi_out::all();
        $atin=transaksi_at::where('id_barang', '=', $id_barang)->get();
        $atout=transaksi_out::where('id_barang', '=', $id_barang)->get();
        $edit=1;
        
        if($id_barang->formName == 'masukan') {
            return view ('alat_terapi.transalat', [
            'idat'=>$atin,
            'id_barang'=>$id_barang, 
            'edit'=>$edit,
            'at'=>$masuk
            ]);
        }elseif($id_barang->formName == 'keluaran') {
            return view ('alat_terapi.transalat', [
            'idat'=>$atout,
            'id_barang'=>$id_barang, 
            'edit'=>$edit,
            'out'=>$keluar
            ]);
        }
        
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
        $datatrans=[
            'tgl' => $request->tglat,
            'no_kwitansi' => $request->noat,
            'id_barang' => $request->idat,
            'jml_barang' => $request->jmlat
        ];

        if($id_barang->formName == 'masukan') {
            $apa=transaksi_at::where('id_barang', $id_barang);
            $apa->update($datatrans);
        }elseif($id_barang->formName == 'keluaran') {
            $apaa=transaksi_out::where('id_barang', $id_barang);
            $apaa->update($datatrans);
        }
        return redirect('transalat');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_barang)
    {
        if($id_barang->formName == 'masukan') {
            $masuk=transaksi_at::where('id_barang', '=', $id_barang);
            $atin->delete();
        }elseif($id_barang->formName == 'keluaran') {
            $keluar=transaksi_out::where('id_barang', '=', $id_barang);
            $atout->delete();
        }
        return redirect('transalat');
    }
}
