<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bill;
use App\BuktiBilling;
use DB;

class billing extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DB::table('h_billing')->select('h_billing.*', 'd_pasien.nama')->join('assessment', 'h_billing.id_asses', '=', 'assessment.id_asses')->join('d_pasien', 'assessment.id_pasien', '=', 'd_pasien.id_pasien')->get();
        return view('billing.billing',[
            'data' => $data
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
        $data = DB::table('bukti_billing')->select('bukti_billing.*')->join('h_billing', 'bukti_billing.id_bill', '=', 'h_billing.id_bill')->where('bukti_billing.id_bill', $id)->get();
        

        return view('billing.detail_billing', [
            'data' => $data
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
        $data = DB::table('bukti_billing')->select('bukti_billing.*')->join('h_billing', 'bukti_billing.id_bill', '=', 'h_billing.id_bill')->where('bukti_billing.id_bukti', $id);
        
        $getData = $data->first();

        $id_bill = $getData->id_bill;

        $data = $data->get();
        return view('billing.billing_detail', [
            'data' => $data
        ]);
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
        $validasi = $r->validasi;

        $data = [
            'validasi' => $validasi
        ];

        $update = BuktiBilling::where('id_bukti', $id)->update($data);

        return redirect('billing/'.$r->id_bill);
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
