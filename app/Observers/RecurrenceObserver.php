<?php

namespace App\Observers;

use App\Event;
use Carbon\Carbon;
use DB;

class RecurrenceObserver
{
    /**
     * Handle the event "created" event.
     *
     * @param  \App\Event  $event
     * @return void
     */
    public static function created(Event $event)
    {

        if(!$event->event()->exists())
        {
            $recurrences = [
                'daily'     => [
                    'times'     => 365,
                    'function'  => 'addDay'
                ],
                'weekly'    => [
                    'times'     => 52,
                    'function'  => 'addWeek'
                ],
                'monthly'    => [
                    'times'     => 12,
                    'function'  => 'addMonth'
                ],
                'three'    => [
                    'times'     => 3,
                    'function'  => 'add3Month'
                ]
            ];

            $startTime = Carbon::parse($event->tgl);
            $endTime = Carbon::parse($event->jam_masuk);
            $recurrence = $recurrences[$event->recurrence] ?? null;

            if($recurrence)
                for($i = 0; $i < $recurrence['times']; $i++)
                {
                    $startTime->{$recurrence['function']}();
                    $endTime->{$recurrence['function']}();
                    $event->events()->create([
                        'id_pegawai'        => $event->id_pegawai,
                        'id_asses'          => $event->id_asses,
                        'id_terapipasien'   => $event->id_terapipasien,
                        'keterangan'        => $event->keterangan,
                        'tgl'               => $startTime,
                        'jam_masuk'         => $endTime,
                        'recurrence'        => $event->recurrence,
                        'biaya'             => $event->biaya,
                    ]);
                }
        }

            DB::table('assessment')->where('id_asses',$event->id_asses)->update(['status_pasien'=>'Pasien']);
            DB::table('terapi_pasien')->where('id_asses',$event->id_asses)->update(['keterangan'=>'Pasien']);

            $now=date('ymd');
            $id_pasien=DB::table('assessment')->where('id_asses',$event->id_asses)->first();
            $record=[
              'id_asses'=>$event->id_asses,
              'id_pasien'=>$id_pasien->id_pasien,
              'keterangan'=>'Pasien',
              'tgl'=>$now
            ];
            DB::table('record_status_pasien')->insert($record);

            $cek=DB::table('h_rekam_medis')->where('id_rm','RM'.date('YmdHis'))->count();
            if($cek==0){
                $data = [
                  'id_rm' => 'RM'.date('YmdHis'),
                  'id_pasien' => $id_pasien->id_pasien,
                  'id_asses' => $event->id_asses,
                  'diagnosa' => $id_pasien->diagnosa
                ];
                DB::table('h_rekam_medis')->insert($data);
            }
            
    }

    /**
     * Handle the event "updated" event.
     *
     * @param  \App\Event  $event
     * @return void
     */
    public function updated(Event $event)
    {
        if($event->events()->exists() || $event->event)
        {
            $startTime = Carbon::parse($event->getOriginal('tgl'))->diffInSeconds($event->tgl, false);
            $endTime = Carbon::parse($event->getOriginal('jam_masuk'))->diffInSeconds($event->jam_masuk, false);
            if($event->event)
                $childEvents = $event->event->events()->whereDate('tgl', '>', $event->getOriginal('tgl'))->get();
            else
                $childEvents = $event->events;

            foreach($childEvents as $childEvent)
            {
                if($startTime)
                    $childEvent->tgl = Carbon::parse($childEvent->tgl)->addSeconds($startTime);
                if($endTime)
                    $childEvent->jam_masuk = Carbon::parse($childEvent->jam_masuk)->addSeconds($endTime);
                if($event->isDirty('keterangan') && $childEvent->keterangan == $event->getOriginal('keterangan'))
                    $childEvent->keterangan = $event->keterangan;
                $childEvent->saveQuietly();
            }
        }

        if($event->isDirty('recurrence') && $event->recurrence != 'none')
            self::created($event);
    }

    /**
     * Handle the event "deleted" event.
     *
     * @param  \App\Event  $event
     * @return void
     */
    public function deleted(Event $event)
    {
        if($event->events()->exists())
            $events = $event->events()->pluck('id_jadwal');
        else if($event->event)
            $events = $event->event->events()->whereDate('tgl', '>', $event->tgl)->pluck('id_jadwal');
        else
            $events = [];
        
            Event::whereIn('id_jadwal', $events)->delete();
    }
}
