<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Bill;
use DB;

class hitungDenda extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:hitungDenda';

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
        $h_billing = DB::table('h_billing')->select('*')->where('status_bayarbill', 'Belum Bayar')->get();

        foreach ($h_billing as $h) {
            $total_biaya = $h->biaya;
            $total_tagihan = $h->sisa_tagihan;

            $denda = (10 * $total_biaya) / 100;

            $data = [
                'denda' => $denda,
                'sisa_tagihan' => $total_tagihan + $denda
            ];

            Bill::where('id_bill', $h->id_bill)->update($data);
        }
    }
}
