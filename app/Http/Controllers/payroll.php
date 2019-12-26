<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use DB;
use PDF;
use Mail;
use Alert;
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
        if (Session::get('login')) {
            $data = DB::table('payroll')->select('payroll.*', 'd_pegawai.nama', 'd_pegawai.id_pegawai as id_p', 'jabatan.jabatan')->rightjoin('d_pegawai', 'payroll.id_pegawai', '=', 'd_pegawai.id_pegawai')->join('jabatan', 'd_pegawai.id_jabatan', '=', 'jabatan.id_jabatan')->groupBy('d_pegawai.id_pegawai')->get();
            return view('payroll.payroll',[
                'data' => $data
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
        if (Session::get('login')) {
            
            $payroll = DB::table('payroll')->select('payroll.*', 'd_pegawai.nama', 'jabatan.jabatan')->join('d_pegawai', 'payroll.id_pegawai', '=', 'd_pegawai.id_pegawai')->join('jabatan', 'd_pegawai.id_jabatan', '=', 'jabatan.id_jabatan')->where('payroll.id_payroll', $id)->get();
            
            return view('payroll.print_payroll', [
                'payroll' => $payroll
            ]);
        }else{
            Alert::error('Silahkan login terlebih dahulu!')->autoclose(3500);
            return redirect('/login');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id_pegawai)
    {   
        if (Session::get('login')) {
            
            $payroll = DB::table('payroll')->select('payroll.*', 'd_pegawai.nama', 'jabatan.jabatan')->join('d_pegawai', 'payroll.id_pegawai', '=', 'd_pegawai.id_pegawai')->join('jabatan', 'd_pegawai.id_jabatan', '=', 'jabatan.id_jabatan')->where('payroll.id_pegawai', $id_pegawai)->get();
            

            return view('payroll.payroll_detail', [
                'data' => $payroll
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
            
            if ($r->submit == "Print") {

                $data = [
                    'insentif' => $r->insentif,
                    'gaji' => $r->gaji,
                    'eval_disc' => $r->eval_disc,
                    'asses' => $r->asses,
                    'evaluasi' => $r->evaluasi,
                    'jabatan' => $r->jabatan,
                    'transport' => $r->transport,
                    'bonus' => $r->bonus,
                    'overtime' => $r->overtime,
                    'overtime_sabtu' => $r->overtime_sabtu,
                    'tempat_tinggal' => $r->tempat_tinggal,
                    'gaji_kotor' => $r->gaji_kotor,
                    'pph' => $r->pph,
                    'asuransi' => $r->asuransi,
                    'lainnya' => $r->lainnya,
                    'total_pengeluaran' => $r->ttl_pengeluaran,
                    'gaji_bersih' => $r->gaji_bersih
                ];

                $update = DB::table('payroll')->where('id_payroll', $id)->update($data);

                set_time_limit(300);

                $pdf = PDF::loadView('payroll.payroll_print',[
                    'insentif' => $r->insentif,
                    'gaji' => $r->gaji,
                    'eval_disc' => $r->eval_disc,
                    'asses' => $r->asses,
                    'evaluasi' => $r->evaluasi,
                    'jabatan' => $r->jabatan,
                    'transport' => $r->transport,
                    'bonus' => $r->bonus,
                    'overtime' => $r->overtime,
                    'overtime_sabtu' => $r->overtime_sabtu,
                    'tempat_tinggal' => $r->tempat_tinggal,
                    'gaji_kotor' => $r->gaji_kotor,
                    'pph' => $r->pph,
                    'asuransi' => $r->asuransi,
                    'lainnya' => $r->lainnya,
                    'total_pengeluaran' => $r->ttl_pengeluaran,
                    'gaji_bersih' => $r->gaji_bersih,
                    'id_pegawai' => $id
                ]);
                $pdf->setPaper('A4', 'potrait');

                return $pdf->download('a.pdf');
            }elseif($r->submit == "Send Email"){
                $data = [
                    'insentif' => $r->insentif,
                    'gaji' => $r->gaji,
                    'eval_disc' => $r->eval_disc,
                    'asses' => $r->asses,
                    'evaluasi' => $r->evaluasi,
                    'jabatan' => $r->jabatan,
                    'transport' => $r->transport,
                    'bonus' => $r->bonus,
                    'overtime' => $r->overtime,
                    'overtime_sabtu' => $r->overtime_sabtu,
                    'tempat_tinggal' => $r->tempat_tinggal,
                    'gaji_kotor' => $r->gaji_kotor,
                    'pph' => $r->pph,
                    'asuransi' => $r->asuransi,
                    'lainnya' => $r->lainnya,
                    'total_pengeluaran' => $r->ttl_pengeluaran,
                    'gaji_bersih' => $r->gaji_bersih
                ];

                $update = DB::table('payroll')->where('id_payroll', $id)->update($data);

                $payroll = DB::table('payroll')->select('payroll.*', 'd_pegawai.nama', 'email', 'jabatan.jabatan')->join('d_pegawai', 'payroll.id_pegawai', '=', 'd_pegawai.id_pegawai')->join('jabatan', 'd_pegawai.id_jabatan', '=', 'jabatan.id_jabatan')->where('payroll.id_payroll', $id);
                
                $py = $payroll->first();

                Mail::send('payroll.sendPayroll', compact('data'), function($message) use($py, $data, $r){
                
                    set_time_limit(300);

                    $pdf = PDF::loadView('payroll.payroll_print',[
                        'insentif' => $r->insentif,
                        'gaji' => $r->gaji,
                        'eval_disc' => $r->eval_disc,
                        'asses' => $r->asses,
                        'evaluasi' => $r->evaluasi,
                        'jabatan' => $r->jabatan,
                        'transport' => $r->transport,
                        'bonus' => $r->bonus,
                        'overtime' => $r->overtime,
                        'overtime_sabtu' => $r->overtime_sabtu,
                        'tempat_tinggal' => $r->tempat_tinggal,
                        'gaji_kotor' => $r->gaji_kotor,
                        'pph' => $r->pph,
                        'asuransi' => $r->asuransi,
                        'lainnya' => $r->lainnya,
                        'total_pengeluaran' => $r->ttl_pengeluaran,
                        'gaji_bersih' => $r->gaji_bersih,
                        'id_pegawai' => $py->id_pegawai
                    ]);
                    $pdf->setPaper('A4', 'potrait');

                    $output = $pdf->output();
                    $message->priority('importance');

                    $message->to($py->email)->subject('Your payslip data generated on '.date('F Y'));
                    $message->attachData($output, 'Your Payslip '.date('d-m-Y').'.pdf');
                });


                Alert::success('Payroll berhasil dikirim')->autoclose(3500);
            }

            return redirect('payroll/'.$id);
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
        //
    }
}
