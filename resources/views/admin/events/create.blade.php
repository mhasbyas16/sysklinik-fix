@extends('template.style')
@section('isi')

<div class="content-wrapper">
    <section class="content-header">
      <h1>
        Tambah Jadwal
      <small>Patient Based</small>
      </h1>
    </section>

    <section class="container-fluid">
        <br>
        <div class="row">
            <div class="col-md-11">
                <div class="box box-solid col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{url('events/store')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <br>
                                <div class="col-md-4">
                                    <div class="form-group {{ $errors->has('id_asses') ? 'has-error' : '' }}">
                                        <label for="id_asses">ID Asses*</label>
                                        <!-- <input type="text" id="id_asses" name="id_asses" class="form-control" value="{{ old('id_asses', isset($event) ? $event->id_asses : '') }}" required>
                                        @if($errors->has('id_asses'))
                                            <em class="invalid-feedback">
                                                {{ $errors->first('id_asses') }}
                                            </em>
                                        @endif -->
                                        <select class = "form-control" style="width: 100%;" name="id_asses" value=" " id="id_asses" value="{{ old('id_asses', isset($event) ? $event->id_asses : '') }}" required>
                                            <option value = "null">-- Pilih --</option>
                                            @foreach ($pasien as $P)
                                            <option value = "{{$P->id_asses}}">{{$P->nama}}</option>    
                                            @endforeach
                                        </select>
                                        <p id="demo"></p>
                                        <script>
                                            jQuery(document).ready(function(){
                                              $("#id_asses").change(function(e){
                                                e.preventDefault();
                                                var id_assess=$(this).val();
                                                
                                                jQuery.ajax({
                                                url: "{{ url('/jterapi_pasien') }}",
                                                method: 'post',
                                                dataType:'json',
                                                data: {"_token": "{{ csrf_token() }}","id_assess": id_assess},
                                                success: function(result){
                                                  $('#id_terapipasien').empty();
                                                  $('#id_terapipasien').append("<option value = 'null'>-- Pilih --</option>");
                                                  $.each(result.j_terapi,function(key,value){
                                                  $('#id_terapipasien').append("<option value = "+value.id_terapipasien+">"+value.id_terapi+"</option>");
                                                  });
                                                }});
                                              });
                                            });
                                        </script>
                                    </div>
                                    <div class="form-group {{ $errors->has('id_terapipasien') ? 'has-error' : '' }}">
                                        <label for="id_terapipasien">ID Jenis Terapi*</label>
                                        <select class="form-control" style="width: 100%;" name="id_terapipasien" id="id_terapipasien" value="{{ old('id_terapipasien', isset($event) ? $event->id_terapipasien : '') }}" required>
                                          <option value = "null">-- Pilih --</option>
                                          @foreach($isi as $id_jenter)
                                          <option value = "{{$id_jenter->id_terapi}}">{{$id_jenter->id_terapi}}</option>
                                          @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group {{ $errors->has('id_pegawai') ? 'has-error' : '' }}">
                                        <label for="id_pegawai">ID Pegawai*</label>
                                        <select class="form-control" style="width: 100%;" name="id_pegawai" id="id_pegawai" value="{{ old('id_pegawai', isset($event) ? $event->id_pegawai : '') }}" required>
                                          <option value = "null">-- Pilih --</option>
                                          @foreach($terapis as $isi)
                                            <option value = "{{$isi->id_pegawai}}">{{$isi->nama}}</option>
                                          @endforeach
                                        </select>
                                        <!-- <input type="text" id="id_pegawai" name="id_pegawai" class="form-control" value="{{ old('id_pegawai', isset($event) ? $event->id_pegawai : '') }}" required>
                                        @if($errors->has('id_pegawai'))
                                            <em class="invalid-feedback">
                                                {{ $errors->first('id_pegawai') }}
                                            </em>
                                        @endif -->
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group {{ $errors->has('keterangan') ? 'has-error' : '' }}">
                                        <!-- <label for="keterangan">keterangan*</label>
                                        <input type="text" id="keterangan" name="keterangan" class="form-control" value="{{ old('keterangan', isset($event) ? $event->keterangan : '') }}" required>
                                        @if($errors->has('keterangan'))
                                            <em class="invalid-feedback">
                                                {{ $errors->first('keterangan') }}
                                            </em>
                                        @endif -->
                                        <label for="keterangan">keterangan*</label>
                                        <select class="form-control" style="width: 100%;" name="keterangan" id="keterangan" value="{{ old('keterangan', isset($event) ? $event->keterangan : '') }}" required>
                                          <option value = "null">-- Pilih --</option>
                                          @foreach($ket as $ket)
                                          <option value = "{{$ket}}">{{$ket}}</option>
                                          @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group {{ $errors->has('tgl') ? 'has-error' : '' }}">
                                        <label for="tgl">Tanggal & Jam Masuk*</label>
                                        <input type="text" id="tgl" name="tgl" class="form-control datetime" value="{{ old('tgl', isset($event) ? $event->tgl : '') }}" required>
                                        @if($errors->has('tgl'))
                                            <em class="invalid-feedback">
                                                {{ $errors->first('tgl') }}
                                            </em>
                                        @endif
                                        <!-- <p class="helper-block">
                                            {{ trans('cruds.event.fields.tgl_helper') }}
                                        </p> -->
                                    </div>
                                    <div class="form-group {{ $errors->has('jam_masuk') ? 'has-error' : '' }}">
                                        <label for="jam_masuk">Tanggal & Jam Keluar*</label>
                                        <input type="text" id="jam_masuk" name="jam_masuk" class="form-control datetime" value="{{ old('jam_masuk', isset($event) ? $event->jam_masuk : '') }}" required>
                                        @if($errors->has('jam_masuk'))
                                            <em class="invalid-feedback">
                                                {{ $errors->first('jam_masuk') }}
                                            </em>
                                        @endif
                                        <!-- <p class="helper-block">
                                            {{ trans('cruds.event.fields.jam_masuk_helper') }}
                                        </p> -->
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group {{ $errors->has('biaya') ? 'has-error' : '' }}">
                                        <label for="biaya">Biaya*</label>
                                        <input type="text" id="biaya" name="biaya" class="form-control" value="{{ old('biaya', isset($event) ? $event->biaya : '') }}" required>
                                        @if($errors->has('biaya'))
                                            <em class="invalid-feedback">
                                                {{ $errors->first('biaya') }}
                                            </em>
                                        @endif
                                    </div>
                                    <div class="form-group {{ $errors->has('recurrence') ? 'has-error' : '' }}">
                                        <label>Perulangan Jadwal*</label>
                                        @foreach(App\Event::RECURRENCE_RADIO as $key => $label)
                                            <div>
                                                <input id="recurrence_{{ $key }}" name="recurrence" type="radio" value="{{ $key }}" {{ old('recurrence', 'none') === (string)$key ? 'checked' : '' }} required>
                                                <label for="recurrence_{{ $key }}">{{ $label }}</label>
                                            </div>
                                        @endforeach
                                        @if($errors->has('recurrence'))
                                            <em class="invalid-feedback">
                                                {{ $errors->first('recurrence') }}
                                            </em>
                                        @endif
                                    </div>
                                </div>
                                <div class="row col-md-12" style="padding-bottom: 30pt; padding-top: 20pt">
                                    <div class="col-md-6">
                                        <input class="btn btn-success col-md-12" type="submit" value="Simpan">
                                    </div>
                                    <div class="col-md-6">
                                        <a href="{{url('/system-calendar')}}" class="btn btn-danger col-md-12" title="Batal">Batal</a>
                                    </div>
                                </div>
                                <div class="col-md-1"></div>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
<script src="{{ asset('js/main.js') }}"></script>
<script>
        $('.date').datetimepicker({
            format: 'YYYY-MM-DD',
            locale: 'en'
          })

          $('.datetime').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            locale: 'en',
            sideBySide: true,
            stepping: 30
          })

          $('.timepicker').datetimepicker({
            format: 'HH:mm:ss'
          })
</script>

  <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
  <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

  <script>
      $(document).ready(function() {
          $('#tambah1,#tambah2').DataTable();
      });
  </script>

@endsection