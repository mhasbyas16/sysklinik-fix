<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
use App\Payment;

class PayrollSch extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:payrollSchedule';

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
        $payroll = DB::table('d_pegawai')->select('*');


        //$insentif = DB::table('d_pegawai')->select('d_pegawai.id_pegawai', 'd_pegawai.gaji', 'd_pegawai.observasi', 'd_pegawai.asses', 'd_pegawai.evaluasi', 'd_pegawai.konsumsi', 'd_pegawai.transport', 'd_pegawai.bonus', DB::raw("count(case when jadwal_terapis.keterangan LIKE '%Terapi%' then 1 else 0 end) ttl_insentif"), DB::raw("count(case when jadwal_terapis.keterangan LIKE '%Assesment%' then 1 else 0 end) ttl_asses"), DB::raw("count(case when jadwal_terapis.keterangan LIKE '%Evaluasi%' then 1 else 0 end) ttl_eval"))->join('jadwal_terapis', 'd_pegawai.id_pegawai', '=', 'jadwal_terapis.id_pegawai')->WHERE('jadwal_terapis.status_pasien', 'Hadir')->groupBy('jadwal_terapis.id_pegawai')->get();

        // foreach ($insentif as $i) {

        //     $id_pegawai = $i->id_pegawai;
        //     $gaji = $i->gaji;
        //     $insentif = $i->ttl_insentif * $i->gaji;
        //     $asses = $i->ttl_asses * $i->asses;
        //     $observasi = $i->observasi;
        //     $evaluasi = $i->ttl_eval * $i->evaluasi;
        //     $konsumsi = $i->konsumsi;
        //     $transport = $i->transport;
        //     $bonus = $i->bonus;            
                
        // }



        $p = DB::table('d_pegawai')->select('*')->get();
        foreach ($p as $i) {


            if ($i->id_pegawai) {
                $insentif = DB::table('jadwal_terapis')->select('id_jadwal')->where('keterangan', 'Terapi')->WHERE('jadwal_terapis.status_pasien', 'Hadir')->where('jadwal_terapis.id_pegawai', $i->id_pegawai)->groupBy('jadwal_terapis.id_pegawai');
                $in = $insentif->first();

                $evaluasi = DB::table('jadwal_terapis')->select('id_jadwal')->where('keterangan', 'Evaluasi')->WHERE('jadwal_terapis.status_pasien', 'Hadir')->where('jadwal_terapis.id_pegawai', $i->id_pegawai)->groupBy('jadwal_terapis.id_pegawai');
                $e = $evaluasi->first();
                
                $asses = DB::table('jadwal_terapis')->select('id_jadwal')->where('keterangan', 'Assesment')->WHERE('jadwal_terapis.status_pasien', 'Hadir')->where('jadwal_terapis.id_pegawai', $i->id_pegawai)->groupBy('jadwal_terapis.id_pegawai');
                $a = $asses->first();

                $insentif = $insentif->count() * $i->gaji;
                $asses = $asses->count() * $i->asses;
                $evaluasi = $evaluasi->count() * $i->evaluasi;
                $gaji_kotor = $i->gaji + $insentif + $asses + $i->observasi + $evaluasi + $i->konsumsi + $i->transport + $i->bonus;
                
                DB::table('payroll')->insert([
                    'id_pegawai' => $i->id_pegawai,
                    'tgl' => now(),
                    'gaji' => $i->gaji,
                    'insentif' => $insentif,
                    'asses' => $asses,
                    'observasi' => $i->observasi,
                    'evaluasi' => $evaluasi,
                    'konsumsi' => $i->konsumsi,
                    'transport' => $i->transport,
                    'bonus' => $i->bonus,
                    'gaji_kotor' => $gaji_kotor,
                    'pph' => 0,
                    'asuransi' => 0,
                    'lainnya' => 0,
                    'total_pengeluaran' => 0,
                    'gaji_bersih' => $gaji_kotor
                ]);
            }
            
        }
        
    }
}
