<?php

namespace App\Http\Controllers/*\Admin*/;

use App\Event;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyEventRequest;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use DB;

class EventsController extends Controller
{
    
    public function index()
    {
        /*abort_if(Gate::denies('event_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');*/

        /*$events = Event::withCount('events')->get();

        return view('admin.events.index', compact('events'));*/
    }

    public function create()
    {
        $tabel = DB::table('jadwal_terapis')
        ->select('jadwal_terapis.*','d_pasien.nama as namaP','d_pegawai.nama','terapi_pasien.id_terapi')
        ->join('terapi_pasien','terapi_pasien.id_terapipasien','=','jadwal_terapis.id_terapipasien')
        ->join('d_pegawai','d_pegawai.id_pegawai','=','jadwal_terapis.id_pegawai')
        ->leftJoin('assessment','assessment.id_asses','=','jadwal_terapis.id_asses')
        ->leftJoin('d_pasien','d_pasien.id_pasien','=','assessment.id_pasien')
        //->where('jadwal_terapis.id_asses',$id)
        ->get();
        
        $terapis=DB::table('d_pegawai')->where('id_pegawai','like','T%')->orderBy('nama','asc')->get();

        $j_terapi=DB::table('terapi_pasien')
        ->join('jenis_terapi','jenis_terapi.id_terapi','=','terapi_pasien.id_terapi')
        ->join('assessment','assessment.id_asses','=','terapi_pasien.id_asses')
        ->join('d_pasien','d_pasien.id_pasien','=','assessment.id_pasien')
        ->where('keterangan','Pasien')
        ->groupBy('d_pasien.id_pasien')
        ->get();

        $pasien=DB::table('record_status_pasien')
        ->join('d_pasien','d_pasien.id_pasien','=','record_status_pasien.id_pasien')
        ->where('record_status_pasien.keterangan','Pasien')
        ->groupBy('d_pasien.id_pasien')
        ->get();

        $data=DB::table('h_pasien')
        ->select('h_pasien.*','assessment.*', 'd_pasien.*', 'd_pasien.nama as namaPAS','d_pegawai.nama as namaPEG')
        ->leftJoin('assessment','h_pasien.id_pasien','=','assessment.id_pasien')
        ->leftJoin('d_pegawai','assessment.id_pegawai','=','d_pegawai.id_pegawai')
        ->join('d_pasien','d_pasien.id_pasien','=','h_pasien.id_pasien')->get();

        $datat=DB::table('h_pegawai')
        ->join('d_pegawai','d_pegawai.id_pegawai','=','h_pegawai.id_pegawai')
        ->leftJoin('jabatan','jabatan.id_jabatan','=','d_pegawai.id_jabatan')
        ->leftJoin('jenis_terapi','jenis_terapi.id_terapi','=','d_pegawai.id_terapi')
        ->where('h_pegawai.id_pegawai','like','T%')->get();

        $ket=[
          'Terapi', 'Assesment', 'Evaluasi', 'Tambahan'
        ];

        $terapis=DB::table('d_pegawai')->where('id_pegawai','like','T%')->get();

        $isi=DB::table('terapi_pasien')
        ->join('jenis_terapi','jenis_terapi.id_terapi','=','terapi_pasien.id_terapi')
        /*->where('id_asses',$id)
        */->groupBy('terapi_pasien.id_terapi')
        ->get();

        return view('admin.events.create',[
            'data'=>$data,
            'datat'=>$datat,
            'ket'=>$ket,
            'terapis'=>$terapis,
            'j_terapi'=>$j_terapi,
            'pasien'=>$pasien,
            'tabel'=>$tabel,
            'isi'=>$isi
        ]);
    }

    public function store(StoreEventRequest $request)
    {
        
        Event::create($request->all());
        

        return redirect()->route('admin.systemCalendar');
    }

    public function edit(Event $event)
    {
        /*abort_if(Gate::denies('event_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');*/

        $data=DB::table('h_pasien')
        ->select('h_pasien.*','assessment.*', 'd_pasien.*', 'd_pasien.nama as namaPAS','d_pegawai.nama as namaPEG')
        ->leftJoin('assessment','h_pasien.id_pasien','=','assessment.id_pasien')
        ->leftJoin('d_pegawai','assessment.id_pegawai','=','d_pegawai.id_pegawai')
        ->join('d_pasien','d_pasien.id_pasien','=','h_pasien.id_pasien')->get();

        $datat=DB::table('h_pegawai')
        ->join('d_pegawai','d_pegawai.id_pegawai','=','h_pegawai.id_pegawai')
        ->leftJoin('jabatan','jabatan.id_jabatan','=','d_pegawai.id_jabatan')
        ->leftJoin('jenis_terapi','jenis_terapi.id_terapi','=','d_pegawai.id_terapi')
        ->where('h_pegawai.id_pegawai','like','T%')->get();

        $event->load('event')->loadCount('events');

        $coba = Event::withCount('events')
        ->select('assessment.*','d_pasien.nama as namaP', 'd_pasien.id_pasien as idpasien','jadwal_terapis.*', 'd_pegawai.nama', 'terapi_pasien.*')
        ->join('assessment','assessment.id_asses','=','jadwal_terapis.id_asses')
        ->join('d_pasien','d_pasien.id_pasien','=','assessment.id_pasien')
        ->join('d_pegawai', 'd_pegawai.id_pegawai','=','jadwal_terapis.id_pegawai')
        ->join('terapi_pasien','terapi_pasien.id_terapipasien','=','jadwal_terapis.id_terapipasien')
        ->join('jenis_terapi','jenis_terapi.id_terapi','=','terapi_pasien.id_terapi')
        ->where('jadwal_terapis.id_pegawai',$event->id_pegawai)
        ->where('jadwal_terapis.id_asses',$event->id_asses)
        ->where('jadwal_terapis.id_terapipasien',$event->id_terapipasien)
        ->get();

        return view('admin.events.edit',[
            'data'=>$data,
            'datat'=>$datat,
            'event'=>$event,
            'coba'=>$coba
        ]);
    }

    public function update(UpdateEventRequest $request, Event $event)
    {
        $event->update($request->all());

        return redirect()->route('admin.systemCalendar');
    }

    public function show(Event $event)
    {
        /*abort_if(Gate::denies('event_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');*/
        
        $event->load('events');

        $sqll = DB::table('jadwal_terapis')
        ->select('jadwal_terapis.*','d_pasien.nama as namaP','d_pegawai.nama','terapi_pasien.id_terapi')
        ->join('terapi_pasien','terapi_pasien.id_terapipasien','=','jadwal_terapis.id_terapipasien')
        ->join('d_pegawai','d_pegawai.id_pegawai','=','jadwal_terapis.id_pegawai')
        ->join('assessment','assessment.id_asses','=','jadwal_terapis.id_asses')
        ->join('d_pasien','d_pasien.id_pasien','=','assessment.id_pasien')
        ->where('jadwal_terapis.id_jadwal',$event->id_jadwal)
        ->first();

        return view('admin.events.show', compact('event','sqll'));
    }

    public function destroy(Event $event)
    {
        /*abort_if(Gate::denies('event_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');*/
        //$res=Event::where('id_jadwal',$event->id_jadwal)->delete();
        $event->delete();
        return back();
    }

    public function massDestroy(Event $event)
    {
        //$event->event()->find($event->id_jadwal)->each(function($event){
        //$blog = DB::table('jadwal_terapis')->where('id_jadwal', $event->id_jadwal || 'jadwal_id', $event->id_jadwal)->delete();
        //});
        $blog = DB::table('jadwal_terapis')->where('id_jadwal',$event->id_jadwal)->delete();
        return redirect()->back();
    }

    
}
