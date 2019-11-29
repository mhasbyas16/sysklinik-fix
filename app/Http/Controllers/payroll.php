<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use PDF;
use Mail;
use App\Payment;
use Carbon\Carbon;

class payroll extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DB::table('payroll')->select('payroll.*', 'd_pegawai.nama', 'd_pegawai.id_pegawai as id_p', 'jabatan.jabatan')->rightjoin('d_pegawai', 'payroll.id_pegawai', '=', 'd_pegawai.id_pegawai')->join('jabatan', 'd_pegawai.id_jabatan', '=', 'jabatan.id_jabatan')->groupBy('d_pegawai.id_pegawai')->get();
        return view('payroll.payroll',[
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
    public function store(Request $r)
    {   

        $payroll = DB::table('payroll')->select('payroll.*', 'd_pegawai.nama', 'jabatan.jabatan')->join('d_pegawai', 'payroll.id_pegawai', '=', 'd_pegawai.id_pegawai')->join('jabatan', 'd_pegawai.id_jabatan', '=', 'jabatan.id_jabatan')->whereMonth('tgl', $r->month)->whereYear('tgl', $r->year)->where('payroll.id_pegawai', $r->id_pegawai)->get();
        $a = new Carbon('1-'.$r->month.'-'.$r->year);
        $b = $a->format('F');
        $bulan = $r->month;
        $tahun = $r->year;

        return view('payroll.payroll_detail', [
            'payroll' => $payroll,
            'bulan' => $bulan,
            'tahun' => $tahun,
            'b' => $b,
            'id_pegawai' => $r->id_pegawai
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $payroll = DB::table('payroll')->select('payroll.*', 'd_pegawai.nama', 'jabatan.jabatan')->join('d_pegawai', 'payroll.id_pegawai', '=', 'd_pegawai.id_pegawai')->join('jabatan', 'd_pegawai.id_jabatan', '=', 'jabatan.id_jabatan')->where('payroll.id_payroll', $id)->get();
        
        return view('payroll.print_payroll', [
            'payroll' => $payroll
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id_pegawai)
    {   
        $payroll = DB::table('payroll')->select('payroll.*', 'd_pegawai.nama', 'jabatan.jabatan')->join('d_pegawai', 'payroll.id_pegawai', '=', 'd_pegawai.id_pegawai')->join('jabatan', 'd_pegawai.id_jabatan', '=', 'jabatan.id_jabatan')->where('payroll.id_pegawai', $id_pegawai)->get();
        

        return view('payroll.payroll_detail', [
            'data' => $payroll
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
        if ($r->submit == "Print") {
            $payroll = DB::table('payroll')->select('payroll.*', 'd_pegawai.nama', 'jabatan.jabatan')->join('d_pegawai', 'payroll.id_pegawai', '=', 'd_pegawai.id_pegawai')->join('jabatan', 'd_pegawai.id_jabatan', '=', 'jabatan.id_jabatan')->where('payroll.id_payroll', $id)->get();
        
            set_time_limit(300);

            $pdf = PDF::loadView('payroll.payroll_print',[
                'payroll' => $payroll
            ]);
            $pdf->setPaper('A4', 'potrait');

            return $pdf->download('a.pdf');
        }elseif($r->submit == "Send Email"){
            $payroll = DB::table('payroll')->select('payroll.*', 'd_pegawai.nama', 'email', 'jabatan.jabatan')->join('d_pegawai', 'payroll.id_pegawai', '=', 'd_pegawai.id_pegawai')->join('jabatan', 'd_pegawai.id_jabatan', '=', 'jabatan.id_jabatan')->where('payroll.id_payroll', $id);
            
            $py = $payroll->first();
            $payroll = $payroll->get();

            Mail::send('payroll.sendPayroll', compact('payroll'), function($message) use($py, $payroll){
            
                set_time_limit(300);

                $pdf = PDF::loadView('payroll.payroll_print',[
                    'payroll' => $payroll
                ]);
                $pdf->setPaper('A4', 'potrait');

                $output = $pdf->output();
                $message->priority('importance');

                $message->to($py->email)->subject('Your payslip data generated on '.date('F Y'));
                $message->attachData($output, 'Your Payslip '.date('d-m-Y').'.pdf');
            });
        }
        
        return view('payroll.payroll_print', [
            'payroll' => $payroll
        ]);
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
