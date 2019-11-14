<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\transaksi_keuangan;
use App\pemasukan;
use App\pengeluaran;

class TransaksiKeuangan extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pemasukan_kategori = transaksi_keuangan::getEnumColumnValues('pemasukan', 'kategori');
        $pengeluaran_kategori = transaksi_keuangan::getEnumColumnValues('pengeluaran', 'kategori');
        $pemasukan = pemasukan::All();
        $pengeluaran = pengeluaran::All();
        return view('keuangan.transkeu', [
            'kategori_pengeluaran' => $pengeluaran_kategori,
            'kategori_pemasukan' => $pemasukan_kategori,
            'pemasukan_list' => $pemasukan,
            'pengeluaran_list' => $pengeluaran
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
    public function store(Request $r)
    {
        $val = [
            'id_karyawan' => 'AAA',
            'tgl' => date('Y-m-d', strtotime($r->tanggal)),
            'keterangan' => $r->keterangan,
            'jumlah' => str_replace('.', '', $r->jumlah),
            'kategori' => $r->kategori
        ];
        if($r->formName == 'pemasukan') {
            pemasukan::insert($val);
        }elseif($r->formName == 'pengeluaran') {
            pengeluaran::insert($val);
        }
        
        return redirect('transaksi_keuangan');
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
        //
    }
}
