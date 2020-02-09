@extends('template.style')
@section('isi')

<div class="content-wrapper">
    <section class="content-header">
      <h1>
        Detail Jadwal
      </h1>
    </section>

    <section class="container-fluid">
        <div class="card">
            <br>
            <br>
            <div class="card-body">
                <div class="mb-2">
                    <table class="table table-bordered table-striped">
                        <tbody>
                            <tr>
                                <th>ID Jadwal</th>
                                <td>{{ $event->id_jadwal }}</td>
                            </tr>
                            <tr>
                                <th>ID Asses</th>
                                <td>{{ $event->id_asses }}</td>
                            </tr>
                            <tr>
                                <th>ID Terapis</th>
                                <td>{{ $event->id_pegawai }}</td>
                            </tr>
                            <tr>
                                <th>Tanggal & Jam Masuk</th>
                                <td>{{ $event->tgl }}</td>
                            </tr>
                            <tr>
                                <th>Tanggal & Jam Keluar</th>
                                <td>{{ $event->jam_masuk }}</td>
                            </tr>
                            <tr>
                                <th>Keterangan</th>
                                <td>{{ $event->keterangan }}</td>
                            </tr>
                            <tr>
                                <th>Perulangan</th>
                                <td>{{ App\Event::RECURRENCE_RADIO[$event->recurrence] ?? '' }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <a style="margin-top:20px;" class="btn btn-default" href="{{ url()->previous() }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection