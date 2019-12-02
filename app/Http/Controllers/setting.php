<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Settings;
use App\Acc;
use DB;

class setting extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $account = DB::table('d_pegawai')->select('d_pegawai.*', 'jabatan', 'password')->where('d_pegawai.id_pegawai', Session::get('id_pegawai'))->join('jabatan', 'd_pegawai.id_jabatan', 'jabatan.id_jabatan')->join('h_pegawai', 'd_pegawai.id_pegawai', 'h_pegawai.id_pegawai')->first();
        $status = "";
        $jabatan = DB::table('jabatan')->select('*')->get();
        return view('setting.setting', [
            'data' => $account,
            'status' => $status,
            'jabatan' => $jabatan
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
        $getPegawai = DB::table('h_pegawai')->select('d_pegawai.*', 'password', 'jabatan.jabatan')->where('h_pegawai.id_pegawai', $id)->join('d_pegawai', 'h_pegawai.id_pegawai', '=', 'd_pegawai.id_pegawai')->join('jabatan', 'd_pegawai.id_jabatan', '=', 'jabatan.id_jabatan')->first();
        $status = "edit";
        $jabatan = DB::table('jabatan')->select('*')->get();
        return view('setting.setting', [
            'data' => $getPegawai,
            'status' => $status,
            'jabatan' => $jabatan
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
        $data = [
            'nama' => $r->nama_P,
            'id_jabatan' => $r->id_jabatan
        ];

        $data2 = [
            'password' => md5($r->password)
        ];

        $update1 = Acc::where('id_pegawai', $id)->update($data);
        $update2 = Settings::where('id_pegawai', $id)->update($data2);

        if ($update1 == TRUE && $update2 == TRUE) {
            return redirect('/setting/'.$id.'/edit');
        }else{
            return redirect('/setting');
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
