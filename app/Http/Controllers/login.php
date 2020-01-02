<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use DB;
use Alert;


class login extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        return view('signin');
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
        $id_pegawai = $r->id_pegawai;
        $password = md5($r->password);

        $cek_log = DB::table('h_pegawai')->select('h_pegawai.*', 'nama', 'jabatan')->where('h_pegawai.id_pegawai', $id_pegawai)->join('d_pegawai', 'h_pegawai.id_pegawai', '=', 'd_pegawai.id_pegawai')->join('jabatan', 'd_pegawai.id_jabatan', '=', 'jabatan.id_jabatan')->first();

        if (isset($cek_log)) {
            if ($password == $cek_log->password && $cek_log->hakakses == "admin") {
                Session::put('id_pegawai',$cek_log->id_pegawai);
                Session::put('uname',$cek_log->nama);
                Session::put('jabatan',$cek_log->jabatan);
                Session::put('role',$cek_log->hakakses);
                Session::put('login',TRUE);

                Alert::success('Selamat datang, '.$cek_log->nama.'!')->autoclose(1400);
                return redirect('/');
            }elseif ($cek_log->hakakses != "admin") {
                Alert::warning('Anda tidak memiliki hak untuk mengakses halaman ini!')->autoclose(1400);
                return redirect('/login');
            }else{
                
                Alert::warning('Password yang anda masukkan salah!')->autoclose(1400);
                return redirect('/login');
            }
        }else{
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
