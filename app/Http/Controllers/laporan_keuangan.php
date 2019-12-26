<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use DB;
use Alert;
use Carbon\Carbon;

class laporan_keuangan extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Session::get('login')) {
            
            return view('keuangan.lapkeu');
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
        
        if (Session::get('login')) {
            
            $data = DB::table('saldo')->select('*')->whereMonth('tgl', $r->month)->whereYear('tgl', $r->year)->count();
            if ($data <= 0) {
                Alert::warning('Data laporan keuangan tidak ditemukan.')->autoclose(3500);
            }

            $data = DB::table('saldo')->select('*')->whereMonth('tgl', $r->month)->whereYear('tgl', $r->year)->get();
            $a = new Carbon('1-'.$r->month.'-'.$r->year);
            $b = $a->format('F');
            $bulan = $r->month;
            $tahun = $r->year;

            return view('keuangan.lapkeu', [
                'data' => $data,
                'bulan' => $bulan,
                'tahun' => $tahun,
                'b' => $b
            ]);
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


    public function search($month, $year){

    }
}
