@extends('template.style')
@section('isi')

<div class="content-wrapper">
    <section class="content-header">
      <h1>
        Edit Jadwal
      </h1>
    </section>

    <section class="container-fluid">
        <br>
        <div class="row">
            <div class="col-md-11">
                <div class="box box-solid col-md-12">
                    <div class="card">
                        <a style="margin-top:20px;" class="btn btn-danger" href="{{ url()->previous() }}">
                        {{ trans('global.back_to_list') }}
                        </a>
                        <div class="card-body">
                            <br>
                            <form action="{{url('events/update')}}/{{$event->id_jadwal}}" 
                                method="POST" 
                                enctype="multipart/form-data" 
                                @if($event->events_count || $event->event) 
                                onsubmit="return confirm('Do you want to apply these changes to all future recurring events, too?');"
                                @endif>
                                @csrf
                                @method('POST')
                                @foreach($coba as $coba)
                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->has('id_asses') ? 'has-error' : '' }}">
                                        <label for="id_asses">ID Asses*</label>
                                        <input type="text" id="id_asses" name="id_asses" class="form-control" value="{{ old('id_asses', isset($event) ? $event->id_asses : '') }}" readonly>
                                        <input type="text" class="form-control" value="{{ $coba->namaP }}" readonly>
                                        @if($errors->has('id_asses'))
                                            <em class="invalid-feedback">
                                                {{ $errors->first('id_asses') }}
                                            </em>
                                        @endif
                                    </div>
                                    <div class="form-group {{ $errors->has('id_pegawai') ? 'has-error' : '' }}">
                                        <label for="id_pegawai">ID Pegawai*</label>
                                        <input type="text" id="id_pegawai" name="id_pegawai" class="form-control" value="{{ old('id_pegawai', isset($event) ? $event->id_pegawai : '') }}" required>
                                        <input type="text" class="form-control" value="{{ $coba->nama }}" readonly>
                                        @if($errors->has('id_pegawai'))
                                            <em class="invalid-feedback">
                                                {{ $errors->first('id_pegawai') }}
                                            </em>
                                        @endif
                                    </div>
                                    <div class="form-group {{ $errors->has('id_terapipasien') ? 'has-error' : '' }}">
                                        <label for="id_terapipasien">ID Terapipasien*</label>
                                        <input type="text" id="id_terapipasien" name="id_terapipasien" class="form-control" value="{{ old('id_terapipasien', isset($event) ? $event->id_terapipasien : '') }}" readonly>
                                        <input type="text" class="form-control" value="{{ $coba->id_terapi }}" readonly>
                                        @if($errors->has('id_terapipasien'))
                                            <em class="invalid-feedback">
                                                {{ $errors->first('id_terapipasien') }}
                                            </em>
                                        @endif
                                    </div>
                                    @endforeach
                                    <div class="form-group {{ $errors->has('keterangan') ? 'has-error' : '' }}">
                                        <label for="keterangan">keterangan*</label>
                                        <input type="text" id="keterangan" name="keterangan" class="form-control" value="{{ old('keterangan', isset($event) ? $event->keterangan : '') }}" required>
                                        @if($errors->has('keterangan'))
                                            <em class="invalid-feedback">
                                                {{ $errors->first('keterangan') }}
                                            </em>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->has('tgl') ? 'has-error' : '' }}">
                                        <label for="tgl">Tanggal & Jam Masuk*</label>
                                        <input type="text" id="tgl" name="tgl" class="form-control datetime" value="{{ old('tgl', isset($event) ? $event->tgl : '') }}" required>
                                        @if($errors->has('tgl'))
                                            <em class="invalid-feedback">
                                                {{ $errors->first('tgl') }}
                                            </em>
                                        @endif
                                    </div>
                                    <div class="form-group {{ $errors->has('jam_masuk') ? 'has-error' : '' }}">
                                        <label for="jam_masuk">Tanggal & Jam Keluar*</label>
                                        <input type="text" id="jam_masuk" name="jam_masuk" class="form-control datetime" value="{{ old('jam_masuk', isset($event) ? $event->jam_masuk : '') }}" required>
                                        @if($errors->has('jam_masuk'))
                                            <em class="invalid-feedback">
                                                {{ $errors->first('jam_masuk') }}
                                            </em>
                                        @endif
                                    </div>
                                    <div class="form-group {{ $errors->has('biaya') ? 'has-error' : '' }}">
                                        <label for="biaya">Biaya*</label>
                                        <input type="text" id="biaya" name="biaya" class="form-control" value="{{ old('biaya', isset($event) ? $event->biaya : '') }}" required>
                                        @if($errors->has('biaya'))
                                            <em class="invalid-feedback">
                                                {{ $errors->first('biaya') }}
                                            </em>
                                        @endif
                                    </div>
                                    @if(!$event->event && !$event->events_count)
                                        <div class="form-group {{ $errors->has('recurrence') ? 'has-error' : '' }}">
                                            <label>{{ trans('cruds.event.fields.recurrence') }}*</label>
                                            @foreach(App\Event::RECURRENCE_RADIO as $key => $label)
                                                <div>
                                                    <input id="recurrence_{{ $key }}" name="recurrence" type="radio" value="{{ $key }}" {{ old('recurrence', $event->recurrence) === (string)$key ? 'checked' : '' }} required>
                                                    <label for="recurrence_{{ $key }}">{{ $label }}</label>
                                                </div>
                                            @endforeach
                                            @if($errors->has('recurrence'))
                                                <em class="invalid-feedback">
                                                    {{ $errors->first('recurrence') }}
                                                </em>
                                            @endif
                                        </div>
                                    @else
                                        <input type="hidden" name="recurrence" value="{{ $event->recurrence }}">
                                    @endif
                                </div>
                                <div class="col-md-12" style="padding-top: 10pt;padding-bottom: 20pt">
                                    <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
                                </div>
                            </form>
                            <div class="col-md-12" style="padding-top: 10pt;padding-bottom: 10pt">
                                <hr>
                                <h4>Daftar Pasien dan Terapis</h4>
                            </div>
                                <br>
                                <br>
                                <ul class="nav nav-tabs" role="tablist">
                                    <li role="presentation" class="active">
                                    <a href="#masuk" aria-controls="Masuk" role="tab" data-toggle="tab">Data Pasien</a>
                                    </li>
                                    <li role="presentation">
                                    <a href="#keluar" aria-controls="keluar" role="tab" data-toggle="tab">Data Terapis</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane active" id="masuk">
                                        <div class="row">
                                            <div class="col-md-10 col-xs-offset-1 ">
                                              <br>
                                              <div class="panel panel-default pt-3">
                                                <div class="panel-heading">Pasien</div>
                                                <div class="panel-body">
                                                    <table id="tambah1" class="table table-bordered table-striped">
                                                            <thead>
                                                              <tr>
                                                                <th>No</th>
                                                                <th>ID Pasien</th>
                                                                <th>Nama</th>
                                                                <th>ID Asses</th>
                                                                <th>Assesor</th>
                                                                <th>Jenis Terapi</th>
                                                              </tr>
                                                            </thead>
                                                            <tbody>
                                                              @php
                                                                  $no=1;
                                                              @endphp
                                                              @foreach($data as $data)
                                                              <tr>
                                                                <td>{{$no}}</td>
                                                                <td>{{$data->id_pasien}}</td>
                                                                <td>{{$data->namaPAS}}</td>
                                                                <td>{{$data->id_asses}}</td>
                                                                <td>{{$data->namaPEG}}</td>
                                                                <td>{{$data->status_pasien}}</td>
                                                              </tr>
                                                              @php
                                                                  $no++;
                                                              @endphp    
                                                              @endforeach
                                                            </tbody>
                                                            <tfoot>
                                                              <tr>
                                                                  <th>No</th>
                                                                  <th>ID Pasien</th>
                                                                  <th>Nama</th>
                                                                  <th>ID Asses</th>
                                                                  <th>Assesor</th>
                                                                  <th>Jenis Terapi</th>
                                                              </tr>
                                                            </tfoot>
                                                    </table>
                                                </div>
                                              </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="keluar">
                                        <div class="row">
                                            <div class="col-md-10 col-xs-offset-1 ">
                                              <br>
                                              <div class="panel panel-default pt-3">
                                                <div class="panel-heading">Terapis</div>
                                                <div class="panel-body">
                                                    <table id="tambah2" class="table table-bordered table-striped text-center">
                                                        <thead>
                                                            <tr>
                                                              <th>No</th>
                                                              <th>ID Karyawan</th>
                                                              <th>Nama</th>
                                                              <th>Jenis Terapi</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @php
                                                              $no=1;
                                                            @endphp
                                                            @foreach($datat as $data)
                                                            <tr>
                                                              <td>{{$no}}</td>
                                                              <td>{{$data->id_pegawai}}</td>
                                                              <td>{{$data->nama}}</td>
                                                              <td>{{$data->id_terapi}}</td>
                                                            </tr>
                                                            @php
                                                              $no++;
                                                            @endphp
                                                            @endforeach
                                                        </tbody>
                                                        <tfoot>
                                                            <tr>
                                                                <th>No</th>
                                                                <th>ID Karyawan</th>
                                                                <th>Nama</th>
                                                                <th>Jenis Terapi</th>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                </div>
                                              </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

  <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
  <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

  <script>
      $(document).ready(function() {
          $('#tambah1,#tambah2').DataTable();
      });
  </script>
@endsection