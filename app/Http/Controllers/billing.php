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
        $billing = DB::table('h_billing')->select('*')->where('id_bill', $r->id_bill)->first();

        $bukti_billing = DB::table('bukti_billing')->select('*')->where('id_bukti', $id)->first();
        $keterangan = $bukti_billing->keterangan;

        $validasi = $r->validasi;
        $jml_bayar = $r->jml_bayar;

        if ($keterangan == "Billing") {
            $a = $billing->biaya;
        }elseif ($keterangan == "Uang Pangkal") {
            $a = $billing->uang_pangkal;
        }elseif ($keterangan == "Assessment") {
            $a = $billing->assessment;
        }elseif ($keterangan == "Evaluasi") {
            $a = $billing->evaluasi;
        }elseif ($keterangan == "Denda") {
            $a = $billing->denda;
        }

        if ($r->validasi == "Valid") {
            $sisa = $billing->sisa_tagihan - $jml_bayar;
            $ket = $a - $jml_bayar;

            if ($sisa == 0) {
                $bUpdate = [
                    'sisa_tagihan' => $sisa,
                    'status_bayarbill' => 'Lunas'
                ];

                $updateBill = Bill::where('id_bill', $r->id_bill)->date($bUpdate);

            }else{
                $bUpdate = [
                    'sisa_tagihan' => $sisa,
                    'status_bayarbill' => 'Belum Lunas'
                ];

                $updateBill = Bill::where('id_bill', $r->id_bill)->date($bUpdate);

                if ($ket == 0) {
                    $buktiUpdate = [
                        'status_bayarbill' => 'Lunas'
                    ];

                    $updateBukti = BuktiBilling::where('id_bukti', $id)->update($buktiUpdate);
                }
            }
        }
        $data = [
            'validasi' => $validasi,

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
