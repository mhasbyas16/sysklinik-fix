<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bill;
use App\BuktiBilling;
use DB;
use App\Kwitansi;
use App\Pemasukan;

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

        $buktiBilling = DB::table('bukti_billing')->select('*')->where('id_bill', $r->id_bill)->first();

        $validasi = $r->validasi;
        $jml_bayar = $r->jml_bayar;


        if($billing->sisa_tagihan > 0){
            if ($r->validasi == "Valid") {
                
                $sbilling = DB::table('kwitansi')->select(DB::raw('sum(jumlah) jml'), 'kategori', 'status')->where('keterangan', 'like', '%'.$r->id_bill.'%')->where('kategori', 'Billing')->first();

                $sup = DB::table('kwitansi')->select(DB::raw('sum(jumlah) jml'), 'kategori', 'status')->where('keterangan', 'like', '%'.$r->id_bill.'%')->where('kategori', 'Uang Pangkal')->first();

                $sasses = DB::table('kwitansi')->select(DB::raw('sum(jumlah) jml'), 'kategori', 'status')->where('keterangan', 'like', '%'.$r->id_bill.'%')->where('kategori', 'Assessment')->first();

                $seval = DB::table('kwitansi')->select(DB::raw('sum(jumlah) jml'), 'kategori', 'status')->where('keterangan', 'like', '%'.$r->id_bill.'%')->where('kategori', 'Evaluasi')->first();
                
                $sdenda = DB::table('kwitansi')->select(DB::raw('sum(jumlah) jml'), 'kategori', 'status')->where('keterangan', 'like', '%'.$r->id_bill.'%')->where('kategori', 'Denda')->first();


                if($sbilling->status == "Belum Lunas" || $sup->status == "Belum Lunas" || $sasses->status == "Belum Lunas" || $seval->status == "Belum Lunas" || $sdenda->status == "Belum Lunas"){
                    if ($sbilling->status == "Belum Lunas") {
                        if ($sbilling->jml > 0) {
                            $sisa =  $billing->sisa_tagihan - $jml_bayar;
                            echo $sisa.'1sisa<br>';
                        }
                    }
                    if ($sup->status == "Belum Lunas") {
                        if ($sup->jml > 0) {
                            $sisa = $billing->sisa_tagihan - ($jml_bayar - $sbilling->jml) + $billing->sisa_sesi;
                            echo $sisa.'2sisa<br>';
                        }
                    }
                    if ($sbilling->status == "Belum Lunas") {
                        if ($sasses->jml > 0) {
                            $sisa = $billing->sisa_tagihan - ($jml_bayar - $sbilling->jml - $sup->jml) + $billing->sisa_sesi;
                            echo $sisa.' '.$sbilling->jml.'3sisa<br>';
                        }
                    }
                    if ($sbilling->status == "Belum Lunas") {
                        if ($seval->jml > 0) {
                            $sisa = $billing->sisa_tagihan - ($jml_bayar - $sbilling->jml - $sup->jml - $sasses->jml) + $billing->sisa_sesi;
                            echo $sisa.'4sisa<br>';
                        }
                    }
                    if ($sbilling->status == "Belum Lunas") {
                        if ($sdenda->jml > 0) {
                            $sisa = $billing->sisa_tagihan - ($jml_bayar - $sbilling->jml - $sup->jml - $sasses->jml - $seval->jml) + $billing->sisa_sesi;
                            echo $sisa.'5sisa<br>';
                        }
                    }                 
                }else{
                    $sisa = $billing->sisa_tagihan - $jml_bayar;
                }

                if ($sisa != 0) {
                    $sisa = $sisa * -1;
                }

                if ($sisa < 0) {
                    echo $sisa.'sisa<br>';

                    if ($sbilling->jml > 0) {
                        $biaya = $billing->biaya - $billing->sisa_sesi - $sbilling->jml;
                    }else{
                        $biaya = $billing->biaya - $billing->sisa_sesi;
                    }
                    $bill = $jml_bayar - $biaya;


                    echo $bill .' '.$sbilling->jml.'<br>';
                    if ($bill >= 0) {
                        if ($billing->biaya != 0 && $sbilling->jml != ($billing->biaya - $billing->sisa_sesi)) {
                            echo "billing terbayar : Rp. ".$biaya."<br>";
                            $jml_sesi = ($biaya + $billing->sisa_sesi)/$billing->biaya;

                            $kUpdate = [
                                'id_bukti' => $id,
                                'keterangan' => 'Untuk pembayaran billing '.$r->id_bill.' lunas.',
                                'jumlah' => $biaya,
                                'tgl' => $buktiBilling->tgl_bayar,
                                'kategori' => 'Billing',
                                'status' => 'Lunas'
                            ];
                            Kwitansi::insert($kUpdate);

                            $pUpdate = [
                                'id_pegawai' => 'K190828357',
                                'tgl' => $buktiBilling->tgl_bayar,
                                'keterangan' => $r->id_bill,
                                'jumlah' => $biaya,
                                'kategori' => 'Billing'
                            ];

                            Pemasukan::insert($pUpdate);
                        }

                        $sisa = $billing->sisa_tagihan - $jml_bayar;
                        $bUpdate = [
                            'sisa_tagihan' => $sisa,
                            'status_bayarbill' => 'Belum Lunas'
                        ];

                        $updateBill = Bill::where('id_bill', $r->id_bill)->update($bUpdate);

                        if ($sup->jml > 0) {
                            $up = $bill - ($billing->uang_pangkal - $sup->jml);
                        }else{
                            $up = $bill - $billing->uang_pangkal;
                        }
                        
                        if ($up >= 0) {
                            if ($up == 0) {
                                $tup = $billing->uang_pangkal;
                            }else{
                                $tup = $billing->uang_pangkal - $sup->jml;
                            }

                            if ($billing->uang_pangkal != 0 && $sup->jml != $billing->uang_pangkal) {
                                echo "up terbayar : Rp. ".$billing->uang_pangkal."<br>";

                                $kUpdate = [
                                    'id_bukti' => $id,
                                    'keterangan' => 'Untuk pembayaran uang pangkal billing '.$r->id_bill.' lunas.',
                                    'jumlah' => $tup,
                                    'tgl' => $buktiBilling->tgl_bayar,
                                    'kategori' => 'Uang Pangkal',
                                    'status' => 'Lunas'
                                ];
                                Kwitansi::insert($kUpdate);

                                $pUpdate = [
                                    'id_pegawai' => 'K190828357',
                                    'tgl' => $buktiBilling->tgl_bayar,
                                    'keterangan' => $r->id_bill,
                                    'jumlah' => $tup,
                                    'kategori' => 'Uang Pangkal'
                                ];

                                Pemasukan::insert($pUpdate);
                            }

                            if ($sasses->jml > 0) {
                                $asses = $up - ($billing->assessment - $sasses->jml);
                            }else{
                                $asses = $up - $billing->assessment;
                            }

                            if ($asses >= 0) {
                                if ($asses == 0) {
                                    $tasses = $billing->assessment;
                                }else{
                                    $tasses = $billing->assessment - $sasses->jml;
                                }
                                if ($billing->assessment != 0 && $sasses->jml != $billing->assessment) {
                                    echo "asses terbayar : Rp. ".$billing->assessment."<br>";

                                    $kUpdate = [
                                        'id_bukti' => $id,
                                        'keterangan' => 'Untuk pembayaran uang assessment billing '.$r->id_bill.' lunas.',
                                        'jumlah' => $tasses,
                                        'tgl' => $buktiBilling->tgl_bayar,
                                        'kategori' => 'Assessment',
                                        'status' => 'Lunas'
                                    ];
                                    Kwitansi::insert($kUpdate);


                                    $pUpdate = [
                                        'id_pegawai' => 'K190828357',
                                        'tgl' => $buktiBilling->tgl_bayar,
                                        'keterangan' => $r->id_bill,
                                        'jumlah' => $tasses,
                                        'kategori' => 'Assessment'
                                    ];

                                    Pemasukan::insert($pUpdate);
                                }

                                if ($seval->jml > 0) {
                                    $eval = $asses - ($billing->evaluasi - $seval->jml);
                                }else{
                                    $eval = $asses - $billing->evaluasi;
                                }

                                if ($eval >= 0) {
                                    if ($eval == 0) {
                                        $teval = $billing->evaluasi;
                                    }else{
                                        $teval = $billing->uang_pangkal - $seval->jml;
                                    }
                                    if ($billing->evaluasi != 0 && $seval->jml != $billing->evaluasi) {
                                        echo "eval terbayar : Rp. ".$billing->evaluasi."<br>";

                                        $kUpdate = [
                                            'id_bukti' => $id,
                                            'keterangan' => 'Untuk pembayaran uang evaluasi billing '.$r->id_bill.' lunas.',
                                            'jumlah' => $teval,
                                            'tgl' => $buktiBilling->tgl_bayar,
                                            'kategori' => 'Evaluasi',
                                            'status' => 'Lunas'
                                        ];
                                        Kwitansi::insert($kUpdate);

                                        $pUpdate = [
                                            'id_pegawai' => 'K190828357',
                                            'tgl' => $buktiBilling->tgl_bayar,
                                            'keterangan' => $r->id_bill,
                                            'jumlah' => $teval,
                                            'kategori' => 'Assessment'
                                        ];

                                        Pemasukan::insert($pUpdate);
                                    }

                                    if ($sdenda->jml > 0) {
                                        $denda = $eval - ($billing->denda - $sdenda->jml);
                                    }else{
                                        $denda = $eval - $billing->denda;
                                    }

                                    if ($eval > 0) {

                                        if (($sdenda->jml + $eval) == $billing->denda) {
                                            
                                            $kUpdate = [
                                                'id_bukti' => $id,
                                                'keterangan' => 'Untuk pembayaran uang denda billing '.$r->id_bill.' lunas.',
                                                'jumlah' => $eval,
                                                'tgl' => $buktiBilling->tgl_bayar,
                                                'kategori' => 'Denda',
                                                'status' => 'Lunas'
                                            ];
                                            Kwitansi::insert($kUpdate);

                                            $pUpdate = [
                                                'id_pegawai' => 'K190828357',
                                                'tgl' => $buktiBilling->tgl_bayar,
                                                'keterangan' => $r->id_bill,
                                                'jumlah' => $eval,
                                                'kategori' => 'BB/Cashbon'
                                            ];

                                            Pemasukan::insert($pUpdate);

                                            echo "denda terbayar : Rp. ".$eval." sisa Rp. ".$denda."<br>";

                                            $bUpdate = [
                                                'status_bayarbill' => 'Lunas'
                                            ];

                                            $updateBill = Bill::where('id_bill', $r->id_bill)->update($bUpdate);

                                        }else{
                                            $kUpdate = [
                                                'id_bukti' => $id,
                                                'keterangan' => 'Untuk pembayaran uang denda billing '.$r->id_bill.' kurang Rp. '.$denda.'.',
                                                'jumlah' => $eval,
                                                'tgl' => $buktiBilling->tgl_bayar,
                                                'kategori' => 'Denda',
                                                'status' => 'Belum Lunas'
                                            ];
                                            Kwitansi::insert($kUpdate);

                                            $pUpdate = [
                                                'id_pegawai' => 'K190828357',
                                                'tgl' => $buktiBilling->tgl_bayar,
                                                'keterangan' => $r->id_bill,
                                                'jumlah' => $eval,
                                                'kategori' => 'BB/Cashbon'
                                            ];

                                            Pemasukan::insert($pUpdate);
                                        
                                            echo "denda terbayar : Rp. ".$eval." sisa Rp. ".$denda."<br>";
                                        }
                                    }

                                }else{
                                    $eval = $eval * -1;
                                    $kUpdate = [
                                        'id_bukti' => $id,
                                        'keterangan' => 'Untuk pembayaran uang evaluasi billing '.$r->id_bill.' kurang Rp. '.$eval,
                                        'jumlah' => $asses,
                                        'tgl' => $buktiBilling->tgl_bayar,
                                        'kategori' => 'Evaluasi',
                                        'status' => 'Belum Lunas'
                                    ];
                                    Kwitansi::insert($kUpdate);
                                    $pUpdate = [
                                        'id_pegawai' => 'K190828357',
                                        'tgl' => $buktiBilling->tgl_bayar,
                                        'keterangan' => $r->id_bill,
                                        'jumlah' => $asses,
                                        'kategori' => 'Assessment'
                                    ];

                                    Pemasukan::insert($pUpdate);
                                    echo "eval terbayar : Rp. ".$asses." sisa Rp. ".$eval."<br>";
                                }
                            }else{
                                $asses = $asses * -1;
                                $kUpdate = [
                                    'id_bukti' => $id,
                                    'keterangan' => 'Untuk pembayaran uang assessment billing '.$r->id_bill.' kurang Rp. '.$asses,
                                    'jumlah' => $up,
                                    'tgl' => $buktiBilling->tgl_bayar,
                                    'kategori' => 'Assessment',
                                    'status' => 'Belum Lunas'
                                ];
                                Kwitansi::insert($kUpdate);
                                $pUpdate = [
                                    'id_pegawai' => 'K190828357',
                                    'tgl' => $buktiBilling->tgl_bayar,
                                    'keterangan' => $r->id_bill,
                                    'jumlah' => $up,
                                    'kategori' => 'Assessment'
                                ];

                                Pemasukan::insert($pUpdate);
                                echo "asses terbayar : Rp. ".$up." sisa Rp. ".$asses."<br>";
                            }
                        }else{
                            $up = $up * -1;
                            $kUpdate = [
                                'id_bukti' => $id,
                                'keterangan' => 'Untuk pembayaran uang pangkal billing '.$r->id_bill.' kurang Rp. '.$up,
                                'jumlah' => $bill,
                                'tgl' => $buktiBilling->tgl_bayar,
                                'kategori' => 'Uang Pangkal',
                                'status' => 'Belum Lunas'
                            ];
                            Kwitansi::insert($kUpdate);
                            $pUpdate = [
                                'id_pegawai' => 'K190828357',
                                'tgl' => $buktiBilling->tgl_bayar,
                                'keterangan' => $r->id_bill,
                                'jumlah' => $bill,
                                'kategori' => 'Uang Pangkal'
                            ];

                            Pemasukan::insert($pUpdate);
                            echo "up terbayar : Rp. ".$bill." sisa Rp. ".$up."<br>";
                        }
                    }else{
                        $bill = $bill * -1;
                        $kUpdate = [
                            'id_bukti' => $id,
                            'keterangan' => 'Untuk pembayaran billing '.$r->id_bill.' kurang Rp. '.$bill,
                            'jumlah' => $jml_bayar,
                            'tgl' => $buktiBilling->tgl_bayar,
                            'kategori' => 'Billing',
                            'status' => 'Belum Lunas'
                        ];
                        Kwitansi::insert($kUpdate);
                        $pUpdate = [
                            'id_pegawai' => 'K190828357',
                            'tgl' => $buktiBilling->tgl_bayar,
                            'keterangan' => $r->id_bill,
                            'jumlah' => $jml_bayar,
                            'kategori' => 'Billing'
                        ];

                        Pemasukan::insert($pUpdate);
                        echo "billing terbayar : Rp. ".$jml_bayar." sisa Rp. ".$bill."<br>";

                    }

                }else{
                    echo $sisa.'lunas';

                    $kUpdate = [
                        'id_bukti' => $id,
                        'keterangan' => 'Untuk pembayaran tagihan billing '.$r->id_bill.' lunas.',
                        'jumlah' => $jml_bayar,
                        'tgl' => $buktiBilling->tgl_bayar,
                        'kategori' => 'Full',
                        'status' => 'Lunas'
                    ];

                    Kwitansi::insert($kUpdate);

                    $pUpdate = [
                        'id_pegawai' => 'K190828357',
                        'tgl' => $buktiBilling->tgl_bayar,
                        'keterangan' => $r->id_bill,
                        'jumlah' => $billing->biaya,
                        'kategori' => 'Billing'
                    ];

                    Pemasukan::insert($pUpdate);

                    if ($billing->uang_pangkal > 0) {
                        $pUpdate = [
                            'id_pegawai' => 'K190828357',
                            'tgl' => $buktiBilling->tgl_bayar,
                            'keterangan' => $r->id_bill,
                            'jumlah' => $billing->uang_pangkal,
                            'kategori' => 'Uang Pangkal'
                        ];

                        Pemasukan::insert($pUpdate);
                    }

                    if ($billing->assessment > 0) {
                        $pUpdate = [
                            'id_pegawai' => 'K190828357',
                            'tgl' => $buktiBilling->tgl_bayar,
                            'keterangan' => $r->id_bill,
                            'jumlah' => $billing->assessment,
                            'kategori' => 'Assessment'
                        ];

                        Pemasukan::insert($pUpdate);
                    }

                    if ($billing->evaluasi > 0) {
                        $pUpdate = [
                            'id_pegawai' => 'K190828357',
                            'tgl' => $buktiBilling->tgl_bayar,
                            'keterangan' => $r->id_bill,
                            'jumlah' => $billing->evaluasi,
                            'kategori' => 'Assessment'
                        ];

                        Pemasukan::insert($pUpdate);
                    }

                    if ($billing->denda > 0) {
                        $pUpdate = [
                            'id_pegawai' => 'K190828357',
                            'tgl' => $buktiBilling->tgl_bayar,
                            'keterangan' => $r->id_bill,
                            'jumlah' => $billing->denda,
                            'kategori' => 'BB/Cashbon'
                        ];

                        Pemasukan::insert($pUpdate);
                    }


                    $bUpdate = [
                        'sisa_tagihan' => $sisa,
                        'status_bayarbill' => 'Lunas'
                    ];

                    $updateBill = Bill::where('id_bill', $r->id_bill)->update($bUpdate);
                }

                $data = [
                    'validasi' => 'Valid'
                ];
                BuktiBilling::where('id_bukti', $id)->update($data);
                
            }
        }else{
            echo "tagihan sudah lunas.";
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
