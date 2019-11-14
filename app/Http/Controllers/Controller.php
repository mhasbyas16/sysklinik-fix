<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
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

}
