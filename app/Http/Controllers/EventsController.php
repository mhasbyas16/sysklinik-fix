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

        /*$events = Event::withCount('events')->get();

            DB::table('assessment')->where('id_asses',$events->id_asses)->update(['status_pasien'=>'Pasien']);
            DB::table('terapi_pasien')->where('id_asses',$events->id_asses)->update(['keterangan'=>'Pasien']);

            $now=date('ymd');
            $id_pasien=DB::table('assessment')->where('id_asses',$events->id_asses)->first();
            $record=[
              'id_asses'=>$events->id_asses,
              'id_pasien'=>$id_pasien->id_pasien,
              'keterangan'=>'Pasien',
              'tgl'=>$now
            ];
            DB::table('record_status_pasien')->insert($record);

            $data = [
              'id_rm' => 'RM'.date('YmdHis'),
              'id_pasien' => $id_pasien->id_pasien,
              'id_asses' => $events->id_asses,
              'diagnosa' => $id_pasien->diagnosa
            ];
            DB::table('h_rekam_medis')->insert($data);*/

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

        $events = Event::withCount('events')
        ->select('jadwal_terapis.*','d_pasien.nama as namaP','d_pegawai.nama','terapi_pasien.id_terapi')
        ->join('terapi_pasien','terapi_pasien.id_terapipasien','=','jadwal_terapis.id_terapipasien')
        ->join('d_pegawai','d_pegawai.id_pegawai','=','jadwal_terapis.id_pegawai')
        ->join('assessment','assessment.id_asses','=','jadwal_terapis.id_asses')
        ->join('d_pasien','d_pasien.id_pasien','=','assessment.id_pasien')
        ->get();
        
        $event->load('events');

        return view('admin.events.show', compact('event'));
    }

    public function destroy(Event $event)
    {
        /*abort_if(Gate::denies('event_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');*/

        $event->delete();

        return back();
    }

    public function massDestroy(MassDestroyEventRequest $request)
    {
        Event::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    /*public function storee(Request $req)
    {
        $id_terapi=$req->id_terapi;
        $jam_masuk=$req->jam_masuk;
        $jam_keluar=$req->jam_keluar;
        $id_asses=$req->id_asses;
        $tgl=$req->tgl;
        $terapis=$req->terapis;
        $id_terapipasien=$req->id_terapipasien;
        $biaya=$req->biaya;
        $id_asses=$req->id_asses;
        $recur=$req->recurrence;
        $no=-1;
        foreach ($id_terapi as $id_terapi) {
          $no++;
          $id=$id_terapi;
          $masuk=$jam_masuk[$no];
          $keluar=$jam_keluar[$no];
          $tgls=$tgl[$no];
          $terps=$terapis[$no];
          $id_terapiP=$id_terapipasien[$no];
          $cost=$biaya[$no];
          $sql=[
            'id_pegawai'=>$terps,
            'id_asses'=>$id_asses,
            'id_terapipasien'=>$id_terapiP,
            'biaya'=>$cost,
            'tgl'=>$tgls,
            'jam_masuk'=>$masuk,
            'jam_keluar'=>$keluar,
            'keterangan'=>'Terapi',
            'status_pasien'=>'Alpha',
            'status_terapis'=>'Alpha',
            'status'=>'Baru',
            'recurrence'=>$recur
          ];

          DB::table('assessment')->where('id_asses',$id_asses)->update(['status_pasien'=>'Pasien']);
          DB::table('terapi_pasien')->where('id_asses',$id_asses)->update(['keterangan'=>'Pasien']);
          DB::table('jadwal_terapis')->insert($sql);
        }
        $now=date('ymd');
        $id_pasien=DB::table('assessment')->where('id_asses',$id_asses)->first();
        $record=[
          'id_asses'=>$id_asses,
          'id_pasien'=>$id_pasien->id_pasien,
          'keterangan'=>'Pasien',
          'tgl'=>$now
        ];
        DB::table('record_status_pasien')->insert($record);
        $data = [
          'id_rm' => 'RM'.date('YmdHis'),
          'id_pasien' => $id_pasien->id_pasien,
          'id_asses' => $id_asses,
          'diagnosa' => $id_pasien->diagnosa
        ];
        DB::table('h_rekam_medis')->insert($data);

        //return redirect()->back();
        return redirect('/admin.systemCalendar');
    }
*/
}
