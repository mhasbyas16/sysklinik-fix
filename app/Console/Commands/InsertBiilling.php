<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Bill;
use App\BillDetail;
use Mail;
use DB;


class InsertBiilling extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:insertbilling';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $last_month = date('m', strtotime(now())) - 1;
        $jadwal_header = DB::table('jadwal_terapis')->select('jadwal_terapis.id_asses as id_asses')->groupby('id_asses')->get();
        $jadwal_detail = DB::table('jadwal_terapis')->select('jadwal_terapis.*')->where('status_pasien', 'Hadir')->get();
        $sisaSesi = DB::table('jadwal_terapis')->select('jadwal_terapis.*')->whereMonth('tgl', $last_month)->where('status_pasien', 'Izin')->count();

        $bill_header = DB::table('h_billing')->select('id_asses')->get();
        $bill_header = DB::table('d_billing')->select('*')->get();
        foreach ($jadwal_header as $jh) {
            $id_bill = 'B'.date('YmdHis');

            $bill_headerCount = DB::table('h_billing')->select('id_asses')->where('id_asses', $jh->id_asses)->count();

            if ($bill_headerCount < 1) {
                $data = [
                    'tgl' => date('Y-m-d'),
                    'id_bill' => $id_bill,
                    'id_asses' => $jh->id_asses,
                    'biaya' => 0,
                    'sisa_tagihan' => 0,
                    'denda' => 0,
                    'sisa_sesi' => $sisaSesi,
                    'status_bayarbill' => 'Belum Bayar'
                ];
                $insert_hbilling = Bill::insert($data);

                $biaya = 0;
                foreach ($jadwal_detail as $jd) {
                    if ($jd->id_asses == $jh->id_asses) {
                        $data = [
                            'id_bill' => $id_bill,
                            'id_jadwal' => $jd->id_jadwal,
                            'biaya' => $jd->biaya,
                            'sesi' => 1
                        ];
                        $insert_detail_billing = BillDetail::insert($data);

                        $d_billing = DB::table('d_billing')->select('d_billing.*')->join('h_billing', 'd_billing.id_bill', '=', 'h_billing.id_bill')->where('d_billing.id_bill', $id_bill)->count();

                        $biaya = $jd->biaya * $d_billing;
                        
                        $bill = DB::table('h_billing')->select('id_bill')->where('id_bill', $id_bill)->get();

                        foreach ($bill as $b) {
                            $data = [
                                'biaya' => $biaya,
                                'sisa_tagihan' => $biaya
                            ];
                            $insert_hbilling = Bill::where('id_bill', $id_bill)->update($data);
                        }
                    }
                }

                $data = DB::table('d_pasien')->select('nama', 'id_bill', 'email')->join('assessment', 'd_pasien.id_pasien', '=', 'assessment.id_pasien')->join('h_billing', 'assessment.id_asses', '=', 'h_billing.id_asses')->join('h_pasien', 'd_pasien.id_pasien', '=', 'h_pasien.id_pasien')->where('id_bill', $id_bill)->where('assessment.id_asses', $jh->id_asses)->get();
                
                Mail::send('billing.sendBilling', compact('data'), function($message) use($data){
                    $message->priority('importance');

                    $message->to($data['email'])->subject('Your billing data generated on '.date('F Y'));
                });

            }


        }



    }
}
