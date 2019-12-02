<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Pemasukan;
use App\Pengeluaran;
use App\LaporanKeuangan;
use DB;

class saldo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:saldo';

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
        $pemasukkan = Pemasukan::select('*')->get();
        $pengeluaran = Pengeluaran::select('*')->get();


        $saldo = Pemasukan::select(DB::RAW('SUM(jumlah) jumlah'))->whereMonth('tgl', date('m', strtotime(now())))->whereYear('tgl', date('Y', strtotime(now())))->where('kategori', 'Saldo')->first();
        $billing = Pemasukan::select(DB::RAW('SUM(jumlah) jumlah'))->whereMonth('tgl', date('m', strtotime(now())))->whereYear('tgl', date('Y', strtotime(now())))->where('kategori', 'Billing')->first();
        $uang_pangkal = Pemasukan::select(DB::RAW('SUM(jumlah) jumlah'))->whereMonth('tgl', date('m', strtotime(now())))->whereYear('tgl', date('Y', strtotime(now())))->where('kategori', 'Uang Pangkal')->first();
        $assessment = Pemasukan::select(DB::RAW('SUM(jumlah) jumlah'))->whereMonth('tgl', date('m', strtotime(now())))->whereYear('tgl', date('Y', strtotime(now())))->where('kategori', 'Assessment')->first();
        $piutang = Pemasukan::select(DB::RAW('SUM(jumlah) jumlah'))->whereMonth('tgl', date('m', strtotime(now())))->whereYear('tgl', date('Y', strtotime(now())))->where('kategori', 'BB/Cashbon')->first();

        $listrik = Pengeluaran::select(DB::RAW('SUM(jumlah) jumlah'))->whereMonth('tgl', date('m', strtotime(now())))->whereYear('tgl', date('Y', strtotime(now())))->where('kategori', 'Listrik')->first();
        $telkom = Pengeluaran::select(DB::RAW('SUM(jumlah) jumlah'))->whereMonth('tgl', date('m', strtotime(now())))->whereYear('tgl', date('Y', strtotime(now())))->where('kategori', 'Telkom')->first();
        $pajak = Pengeluaran::select(DB::RAW('SUM(jumlah) jumlah'))->whereMonth('tgl', date('m', strtotime(now())))->whereYear('tgl', date('Y', strtotime(now())))->where('kategori', 'Pajak')->first();
        $insentif_terapis = Pengeluaran::select(DB::RAW('SUM(jumlah) jumlah'))->whereMonth('tgl', date('m', strtotime(now())))->whereYear('tgl', date('Y', strtotime(now())))->where('kategori', 'Insentif Terapi')->first();
        $fee = Pengeluaran::select(DB::RAW('SUM(jumlah) jumlah'))->whereMonth('tgl', date('m', strtotime(now())))->whereYear('tgl', date('Y', strtotime(now())))->where('kategori', 'Fee Staf')->first();
        $bonus = Pengeluaran::select(DB::RAW('SUM(jumlah) jumlah'))->whereMonth('tgl', date('m', strtotime(now())))->whereYear('tgl', date('Y', strtotime(now())))->where('kategori', 'Bonus')->first();
        $lainnya = Pengeluaran::select(DB::RAW('SUM(jumlah) jumlah'))->whereMonth('tgl', date('m', strtotime(now())))->whereYear('tgl', date('Y', strtotime(now())))->where('kategori', 'Beban Lainnya')->first();
        
        if ($saldo->jumlah == NULL){
            $saldo->jumlah = 0;
        } 

        if($billing->jumlah == NULL){
            $billing->jumlah = 0;
        } 

        if($uang_pangkal->jumlah == NULL){
            $uang_pangkal->jumlah = 0;
        } 

        if($assessment->jumlah == NULL){
            $assessment->jumlah = 0;
        } 

        if($piutang->jumlah == NULL){
            $piutang->jumlah =0;
        } 

        if($listrik->jumlah == NULL){
            $listrik->jumlah = 0;
        } 

        if($telkom->jumlah == NULL){
            $telkom->jumlah = 0;
        } 

        if($pajak->jumlah == NULL){
            $pajak->jumlah = 0;
        } 

        if($insentif_terapis->jumlah == NULL){
            $insentif_terapis->jumlah = 0;
        } 

        if($fee->jumlah == NULL){
            $fee->jumlah = 0;
        } 

        if($bonus->jumlah == NULL){
            $bonus->jumlah = 0;
        } 

        if($lainnya->jumlah == NULL) {
            $lainnya->jumlah = 0;
        }

        $total_pemasukkan = $saldo->jumlah + $billing->jumlah + $uang_pangkal->jumlah + $assessment->jumlah + $piutang->jumlah;
        $total_pengeluaran = $listrik->jumlah + $telkom->jumlah + $pajak->jumlah + $insentif_terapis->jumlah + $fee->jumlah + $bonus->jumlah + $lainnya->jumlah;

        $saldo_akhir = $total_pemasukkan - $total_pengeluaran;

        $data = [
            'tgl' => now(),
            'saldo_awal' => $saldo->jumlah,
            'billing' => $billing->jumlah,
            'uang_pangkal' => $uang_pangkal->jumlah,
            'assesment' => $assessment->jumlah,
            'piutang' => $piutang->jumlah,
            'listrik' => $listrik->jumlah,
            'telkom' => $telkom->jumlah,
            'pajak' => $pajak->jumlah,
            'insentif_terapis' => $insentif_terapis->jumlah,
            'fee' => $fee->jumlah,
            'bonus' => $bonus->jumlah,
            'lainnya' => $lainnya->jumlah,
            'total_pemasukan' => $total_pemasukkan,
            'total_pengeluaran' => $total_pengeluaran,
            'saldo_akhir' => $saldo_akhir
        ];

        LaporanKeuangan::insert($data);

        $bln = date('m', strtotime(now())) + 1;
        $awal = date('Y').'-'.$bln.'-1';
        $data = [
            'id_pegawai' => 'K190828357',
            'tgl' => $awal,
            'keterangan' => 'Saldo akhir bulan sebelumnya',
            'jumlah' => $saldo_akhir,
            'kategori' => 'Saldo'
        ];

        Pemasukan::insert($data);

    }
}
