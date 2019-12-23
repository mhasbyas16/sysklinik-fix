<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TransaksiKeuangan;
use App\Pemasukan;
use App\Pengeluaran;
use DB;

class transaksi_keuangan extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pemasukan_kategori = TransaksiKeuangan::getEnumColumnValues('pemasukan', 'kategori');
        $pengeluaran_kategori = TransaksiKeuangan::getEnumColumnValues('pengeluaran', 'kategori');
        $pemasukan = Pemasukan::select('pemasukan.*', 'nama')->join('d_pegawai', 'pemasukan.id_pegawai', '=', 'd_pegawai.id_pegawai')->get();
        $pengeluaran = Pengeluaran::select('pengeluaran.*', 'nama')->join('d_pegawai', 'pengeluaran.id_pegawai', '=', 'd_pegawai.id_pegawai')->get();
        $karyawan = DB::table('h_pegawai')->select('d_pegawai.*')->join('d_pegawai', 'h_pegawai.id_pegawai', '=', 'd_pegawai.id_pegawai')->get();
        return view('keuangan.transkeu', [
            'kategori_pengeluaran' => $pengeluaran_kategori,
            'kategori_pemasukan' => $pemasukan_kategori,
            'pemasukan_list' => $pemasukan,
            'pengeluaran_list' => $pengeluaran,
            'karyawan' => $karyawan
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
            'id_pegawai' => $r->id_karyawan,
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
        
        Alert::success('Data berhasil ditambahkan')->autoclose(3500);
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


        $pemasukan = Pemasukan::where('id_income', $id);
        $getPemasukan = $pemasukan->first();


        if (isset($getPemasukan->id_income)) {
            $hapusPemasukkan = $pemasukan->delete();
        }else{
            $pengeluaran = Pengeluaran::where('id_outcome', $id);
            $hapusPengeluaran = $pengeluaran->delete();
        }

        Alert::success('Data berhasil dihapus')->autoclose(3500);
        return redirect('transaksi_keuangan');
    }
}
