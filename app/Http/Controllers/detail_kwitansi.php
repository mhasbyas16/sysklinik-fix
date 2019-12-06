<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use PDF;

class detail_kwitansi extends Controller
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
        $data = DB::table('kwitansi')->select('kwitansi.*', 'h_billing.id_bill', 'h_billing.sisa_tagihan', 'd_pasien.nama')->leftJoin('bukti_billing', 'kwitansi.id_bukti', '=', 'bukti_billing.id_bukti')->leftJoin('h_billing', 'bukti_billing.id_bill', '=', 'h_billing.id_bill')->join('assessment', 'h_billing.id_asses', '=', 'assessment.id_asses')->join('d_pasien', 'assessment.id_pasien', '=', 'd_pasien.id_pasien')->where('kwitansi.id_bukti', $id)->get();

        return view('billing.list_kwitansi', [
            'kwitansi' => $data
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
        $data = DB::table('kwitansi')->select('kwitansi.*', 'h_billing.id_bill', 'h_billing.sisa_tagihan', 'd_pasien.nama')->leftJoin('bukti_billing', 'kwitansi.id_bukti', '=', 'bukti_billing.id_bukti')->leftJoin('h_billing', 'bukti_billing.id_bill', '=', 'h_billing.id_bill')->join('assessment', 'h_billing.id_asses', '=', 'assessment.id_asses')->join('d_pasien', 'assessment.id_pasien', '=', 'd_pasien.id_pasien')->where('kwitansi.id_kwitansi', $id)->get();

        set_time_limit(300);

        $pdf = PDF::loadView('billing.detail_kwitansi',[
            'kwitansi' => $data
        ]);
        $pdf->setPaper('A5', 'landscape');

        return $pdf->download('Bukti Pembayaran '.date('dmY').'.pdf');


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
