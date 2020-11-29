<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Session;
use DB;
use Alert;
use Khill\Lavacharts\Lavacharts;
use App\m_jenisterapi;

class Controller extends BaseController
{
	public function index(){

        if (Session::get('login')) {
            
	    	$terapis = DB::table('h_pegawai')->select('id_pegawai')->where('h_pegawai.id_pegawai','like','T%')->count();
	    	$pegawai = DB::table('h_pegawai')->select('id_pegawai')->where('h_pegawai.id_pegawai','like','K%')->count();
	        $all=DB::table('h_pasien')->count();
	        $pasien=DB::table('h_pasien')
	        ->join('assessment', 'assessment.id_pasien','=','h_pasien.id_pasien')
	        ->join('terapi_pasien', 'terapi_pasien.id_asses','=','assessment.id_asses')
	        ->count();
	        $jenis = m_jenisterapi::all()->count();
	        $r=DB::table('request_dash')->select('*')->where('keterangan','Asses')->get();
	        $kue=DB::table('request_dash')->select('*')->where('keterangan','Kuesioner')->get();
	        $data=DB::table('request_dash')->select('id_pasien')->first();

	        $notif_rm = DB::table('h_rekam_medis')->where('status', 'Baru')->count();

	        $dataa = DB::select('select count(id_pasien) as Total, terapi as jenis_terapi from assessment right join terapi_pasien on assessment.id_asses = terapi_pasien.id_asses right join jenis_terapi on terapi_pasien.id_terapi = jenis_terapi.id_terapi where assessment.status_pasien = "Asses" group by terapi_pasien.id_terapi');
	        

			$lava = new Lavacharts; // See note below for Laravel

			$votes  = $lava->DataTable();

			$votes->addStringColumn('Jenis Terapi')
			      ->addNumberColumn('Total');
			foreach ($dataa as $d) {
				$votes->addRow([$d->jenis_terapi, $d->Total]);
			}

			\Lava::BarChart('Votes', $votes, [
	                'orientation' => 'horizontal',
	                'colors' => [
	                    '#c3db2f'
	                ],
	                'height' => 250,
	                'hAxis'=> [
	                    'gridlines'=> 9,
	                    'textStyle' => [
	                        'color' => '#000'
	                    ]
	                ],
	                'vAxis'=> [
	                    'gridlines'=> 9,
	                    'textStyle' => [
	                        'color' => '#000'
	                    ]
	                ],
	                'textColor' => 'white'
	            ]);
	     



	        return view('index', [
	            'terapis'=>$terapis,
	            'pegawai'=>$pegawai,
	            'all'=>$all,
	            'pasien'=>$pasien,
	            'jenis'=>$jenis,
	            'r'=>$r,
	            'kue'=>$kue,
	            'data'=>$data,
	            'notif_rm' => $notif_rm
	        ]);
        }else{
            Alert::error('Silahkan login terlebih dahulu!')->autoclose(1400);
            return redirect('/login');
        }
	}

	public function ubahstatusterima($id_pasien){

		$data=DB::table('request_dash')
        ->select('id_pasien')
        ->where('id_pasien', $id_pasien)->first();

        $cek=DB::table('request_dash')->where('id_pasien',$id_pasien)->count();
	    if ($cek==0) {
	        return redirect('/')->with('alertwarn','Data tidak ditemukan');
	    }else {
	      DB::table('request_dash')->where('id_pasien',$id_pasien)->update(['status' =>'Terima']);
	      return redirect('/')->with('alertwarn','Berhasil diubah');
	    }

	}

	public function ubahstatustolak($id){

		$data=DB::table('request_dash')
        ->select('id_pasien')
        ->where('id_pasien', $id)->first();

        $cek=DB::table('request_dash')->where('id_pasien',$id)->count();
	    if ($cek==0) {
	        return redirect('/')->with('alertwarn','Data tidak ditemukan');
	    }else {
	      DB::table('request_dash')->where('id_pasien',$id)->update(['status' =>'Tolak']);
	      return redirect('/')->with('alertwarn','Berhasil diubah');
	    }

	}

	public function hapus($id){
		$data=DB::table('request_dash')
	    ->select('id','keterangan')
	    ->where(['id'=>$id])->first();

	    $cek=DB::table('request_dash')->where('id',$id)->count();
	    if ($cek==0) {
	        return redirect('/')->with('alertwarn','Data tidak ditemukan');
	    }else {
	      DB::table('request_dash')->where('id',$id)->delete();
	      return redirect('/')->with('alertwarn','Berhasil Menghapus Data');
	    }

	}

	public function hapusreqkue($id){
		$data=DB::table('request_dash')
	    ->select('id')
	    ->where(['id'=>$id, 'keterangan'=>'Kuesioner'])->first();

	    $cek=DB::table('request_dash')->where('id',$id)->count();
	    if ($cek==0) {
	        return redirect('/')->with('alertwarn','Data tidak ditemukan');
	    }else {
	      DB::table('request_dash')->where('id',$id)->delete();
	      return redirect('/')->with('alertwarn','Berhasil Menghapus Data');
	    }

	}

	public function emails(){

	        $id_pasien = $request->input('id_pasien');
	        $email = $request->input('email');
	        $username = $request->input('username');
	        $password = md5($request->input('password'));

	        $ambil=DB::table('h_pasien')->select('email')
	        ->where(['email'=>$email])->first();

	        $data1=[
	            'id_pasien' => $id_pasien,
	            'email' => $email,
	            'username' => $username,
	            'password' => $password,
	            'konfirmasi' => 'Belum'
	        ];

	        $data2=DB::table('h_pasien')
	        ->select('email')
	        ->where(['email'=>$email])->first();

	       
	            Mail::send('maill', compact('id_pasien'), function($message) use($data1, $id_pasien){
	            set_time_limit(300);
	            $message->priority('importance');
	            $message->to($data1['email'])->subject('Kuesioner Terapi');
	            //$message->attachData($output, 'Your Payroll '.date('d-m-Y').'.pdf');
	            });

	            m_daftarpasien::insert($data1); //simpan ke tabel h_pasien
	            m_daftar::insert($data3); // simpan ke tabel daftar
	            return redirect('reg')->with('alert-success','Registration Success');
	}
	
    public function Registerlist(){
		return view('main_menu.registerlist');
	}

	public function Absensi(){
		return view('main_menu.absensi');
	}

	public function Jadwalterapi(){
		return view('main_menu.jadwalterapi');
	}

	public function Jadwaleval(){
		return view('main_menu.jadwaleval');
	}

	public function Pegawai(){
		return view('data_master.pegawai');
	}

	public function Terapis(){
		return view('data_master.terapis');
	}

	public function Terapi(){
		return view('data_master.terapi');
	}

	public function Pasien(){
		return view('data_master.pasien');
	}

	public function Billing(){
		return view('billing.billing');
	}

	public function Detail_Billing(){
		return view('billing.detail_billing');
	}

	public function Rekamedis(){
		$pasien = DB::table('h_pasien')->select('h_pasien.*')->join('d_pasien', 'h_pasien.id_pasien', '=', 'd_pasien.id_pasien')->get();
		$terapis = DB::table('h_pegawai')->select('d_pegawai.*')->join('d_pegawai', 'h_pegawai.id_pegawai', '=', 'd_pegawai.id_pegawai')->join('jabatan', 'd_pegawai.id_jabatan', '=', 'jabatan.id_jabatan')->where('d_pegawai.id_jabatan','=','5')->get();
		$terapi = DB::table('jenis_terapi')->select('*')->get();
		return view('rekam_medis.rekamedis', [
			'pasien' => $pasien,
			'terapis' => $terapis,
			'terapi' => $terapi
		]);
	}

	public function Detail_Rekamedis(){
		return view('rekam_medis.detail_rekamedis');
	}

	public function Transkeu(){
		return view('keuangan.transkeu');
	}

	public function Keuangan(){
		return view('keuangan.lapkeu');
	}

	public function Payroll(){
		return view('payroll.payroll');
	}

	public function Alatterapi(){
		return view('alat_terapi.alatterapi');
	}

	public function Transalat(){
		return view('alat_terapi.transalat');
	}

	public function Persediaan(){
		return view('alat_terapi.persediaan');
	}

	public function Setting(){
		return view('setting.setting');
	}

	
    public function create()
    {
        return view('admin.events.create');
    }
}
