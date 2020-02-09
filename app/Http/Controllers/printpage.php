<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use MaddHatter\LaravelFullcalendar\Facades\Calendar;
use DB;
use PDF;
use Mail;
use DateTime;
use Alert;

class printpage extends Controller
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
    public function printBilling($id){

        if (Session::get('login')) {
                
            $sql = DB::table('d_billing')->select('h_billing.sisa_tagihan as total', 'h_billing.uang_pangkal', 'h_billing.assessment', 'h_billing.evaluasi', 'h_billing.denda', 'd_billing.id_bill_detail', 'd_pasien.nama', 'd_pasien.nama_ayah', 'd_pasien.nama_ibu', 'd_pasien.tempat_lahir', 'd_pasien.tgl_lahir', 'd_pasien.tlp', 'd_pasien.tlp_ayah', 'd_pasien.tlp_ibu', 'jadwal_terapis.*', 'jenis_terapi.terapi', 'd_billing.sesi', 'jenis_terapi.id_terapi', 'd_billing.biaya', 'h_billing.sisa_sesi', 'jadwal_terapis.biaya as bps')->join('h_billing', 'd_billing.id_bill', '=', 'h_billing.id_bill')->join('assessment', 'h_billing.id_asses', '=', 'assessment.id_asses')->join('d_pasien', 'assessment.id_pasien', '=', 'd_pasien.id_pasien')->join('jadwal_terapis', 'd_billing.id_jadwal', '=', 'jadwal_terapis.id_jadwal')->join('terapi_pasien', 'jadwal_terapis.id_terapipasien', '=', 'terapi_pasien.id_terapipasien')->join('jenis_terapi', 'terapi_pasien.id_terapi', '=', 'jenis_terapi.id_terapi')->where('d_billing.id_bill', $id);
            //fullcalendar
                $events = [];
                $data=$sql->get();
                if($data->count()) {
                foreach ($data as $value) {
                $color = dechex(rand(0x000000, 0xFFFFFF));
                $events[] = Calendar::event(
                    $value->id_terapi,
                    false,
                    $value->tgl.'T'.$value->jam_masuk,
                    $value->tgl.'T'.$value->jam_keluar,
                    null,
                    // Add color and link on event
                    [   
                    'backgroundColor' => 'red',
                    'url' => '#',
                    ]
                );

                }
            }
            $a = $sql->first();
            $clndr = Calendar::addEvents($events)->setOptions([ //set fullcalendar options
                'defaultDate'=> $a->tgl,
                'editable'=> true,
                'locale'=> 'id',
                'firstDay'=> 1,
                'eventLimit'=> false, // allow "more" link when too many events
                'fixedWeekCount'=> false,
                'showNonCurrentDates'=> false,
                'header'=>[
                        'left'=> '',
                        'center'=>'title',
                        'right'=>''
                      ],
                'overlap' =>false,
                'color'=> 'yellow',
                'aspectRatio' => 1
             ]);

            $data2 = DB::table('h_billing')->select('d_pasien.nama', 'd_pasien.nama_ayah', 'd_pasien.nama_ibu', 'd_pasien.tempat_lahir', 'd_pasien.tgl_lahir', 'd_pasien.tlp', 'd_pasien.tlp_ayah', 'd_pasien.tlp_ibu', 'h_billing.id_asses')->join('assessment', 'h_billing.id_asses', '=', 'assessment.id_asses')->join('d_pasien', 'assessment.id_pasien', '=', 'd_pasien.id_pasien')->where('h_billing.id_bill', $id)->get();
            $b = date('F Y', strtotime($a->tgl));
            $jadwal = DB::table('jadwal_terapis')->select(DB::raw('SUM(d_billing.sesi) jml_sesi'), DB::raw('Month(jadwal_terapis.tgl) month'), DB::raw('DATE(jadwal_terapis.tgl) day'), 'jenis_terapi.id_terapi', 'jadwal_terapis.jam_masuk', 'jadwal_terapis.jam_keluar', 'nama')->join('h_billing', 'jadwal_terapis.id_asses', '=', 'h_billing.id_asses')->join('d_pegawai', 'jadwal_terapis.id_pegawai', '=', 'd_pegawai.id_pegawai')->join('jenis_terapi', 'd_pegawai.id_terapi', '=', 'jenis_terapi.id_terapi')->join('d_billing', 'h_billing.id_bill', '=', 'd_billing.id_bill')->where('h_billing.id_bill', $id)->groupBy('month', 'd_billing.id_bill', 'jadwal_terapis.id_asses', 'h_billing.id_bill');
            
            $jadwal_all = $jadwal->get();
            $jml = $jadwal->first();

            $sisa_sesi = $a->sisa_sesi / $a->bps;
            return view('billing.print_billing', compact('clndr'), [
                'data' => $data,
                'dp' => $data2,
                'jadwal' => $jadwal_all,
                'tgl' => $b,
                'total' => $a->total,
                'uang_pangkal' => $a->uang_pangkal,
                'assessment' => $a->assessment,
                'evaluasi' => $a->evaluasi,
                'denda' => $a->denda,
                'sisa_sesi' => $sisa_sesi,
                'ttl_sisaSesi' => $a->sisa_sesi,
                'bps' => $a->bps,
                'jml_sesi' => $jml->jml_sesi,
                'id' => $id
            ]);
        }else{
            Alert::error('Silahkan login terlebih dahulu!')->autoclose(1500);
            return redirect('/login');
        }

        
    }

    public function sendBilling($id){
        if (Session::get('login')) {
            
            $data = DB::table('d_pasien')->select('email', 'nama', 'id_bill')->join('assessment', 'd_pasien.id_pasien', '=', 'assessment.id_pasien')->join('h_billing', 'assessment.id_asses', '=', 'h_billing.id_asses')->join('h_pasien', 'd_pasien.id_pasien', '=', 'h_pasien.id_pasien')->where('id_bill', $id)->where('assessment.id_asses', $jh->id_asses);
            $dt = $data->first();
            $data = $data->get();

            Mail::send('billing.sendBilling', compact('data'), function($message) use($dt){
                $message->priority('importance');

                $message->to($dt->email)->subject('Your billing data generated on '.date('F Y'));
            });
        }else{
            Alert::error('Silahkan login terlebih dahulu!')->autoclose(1500);
            return redirect('/login');
        }
    }

    public function sendEmail($id){
        if (Session::get('login')) {
            
            $data = DB::table('request_dash')
            ->select('request_dash.*')
            ->where('keterangan','Kuesioner')
            ->where('status','Request')
            ->where('request_dash.id', $id)
            ->groupBy('id_pasien', 'tgl');

            $dt = $data->first();
            $data = $data->get();

            Mail::send('sendemail', compact('data'), function($message) use($dt){
                $message->priority('importance');

                $message->to($dt->email)->subject('File Kuesioner Klinik Liliput');
                
                if ($dt->jenis_terapi == 'OT') {
                    $message->attachData(asset('/kuisioner/KUISIONER_FISIOTERAPI.pdf'), 'KUISIONER_FISIOTERAPI.pdf');
                }
                if ($dt->jenis_terapi == 'TW') {
                    $message->attachData(asset('/kuisioner/KUISIONER_OP.pdf'), 'KUISIONER_OP.pdf');
                }
                if ($dt->jenis_terapi == 'FT') {
                    $message->attachData(asset('/kuisioner/KUISIONER_OTSI.pdf'), 'KUISIONER_OTSI.pdf');
                }
                if ($dt->jenis_terapi == 'OP') {
                    $message->attachData(asset('/kuisioner/KUISIONER_WICARA.pdf'), 'KUISIONER_WICARA.pdf');
                }
            });

            DB::table('request_dash')->where('id', $id)->update(['status' =>'Terkirim']);
            Alert::success('Kuisioner sudah terkirim!')->autoclose(1500);
            return redirect('/');
        }else{
            Alert::error('Silahkan login terlebih dahulu!')->autoclose(2000);
            return redirect('/login');
        }
    }

    public function sendEmail_tolakasses($id){
        if (Session::get('login')) {
            
            $data = DB::table('request_dash')
            ->select('request_dash.*')
            ->where('keterangan','Asses')
            ->where('status','Request')
            ->where('request_dash.id', $id)
            ->groupBy('id_pasien', 'tgl');

            $dt = $data->first();
            $data = $data->get();

            Mail::send('emailtolak_asses', compact('data'), function($message) use($dt){
                $message->priority('importance');

                $message->to($dt->email)->subject('Assessment Request Responses');
            });

            DB::table('request_dash')->where('id', $id)->update(['status' =>'Terkirim']);
            Alert::success('Kuisioner sudah terkirim!')->autoclose(1500);
            return redirect('/');
        }else{
            Alert::error('Silahkan login terlebih dahulu!')->autoclose(2000);
            return redirect('/login');
        }
    }

    public function sendEmail_terimaasses($id){
        if (Session::get('login')) {
            
            $data = DB::table('request_dash')
            ->select('request_dash.*')
            ->where('keterangan','Asses')
            ->where('status','Request')
            ->where('request_dash.id', $id)
            ->groupBy('id_pasien', 'tgl');

            $dt = $data->first();
            $data = $data->get();

            Mail::send('emailterima_asses', compact('data'), function($message) use($dt){
                $message->priority('importance');

                $message->to($dt->email)->subject('Assessment Request Responses');
            });

            DB::table('request_dash')->where('id', $id)->update(['status' =>'Terkirim']);
            Alert::success('Kuisioner sudah terkirim!')->autoclose(1500);
            return redirect('/');
        }else{
            Alert::error('Silahkan login terlebih dahulu!')->autoclose(2000);
            return redirect('/login');
        }
    }

    public function printLaporanKeuangan($id){

        if (Session::get('login')) {
            
            $data = DB::table('saldo')->select('*')->where('id_saldo', $id)->get();
            return view ('keuangan.print_laporan',[
                'data' => $data  
                ]);
        }else{
            Alert::error('Silahkan login terlebih dahulu!')->autoclose(1500);
            return redirect('/login');
        }
    }
}
