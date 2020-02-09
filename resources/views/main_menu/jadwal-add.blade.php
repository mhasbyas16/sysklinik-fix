@extends('template.style')
@section('isi')

  <div class = "content-wrapper">
    <section class = "content-header">
      <h1>
        Jadwal Terapi
        <small>Atur jadwal terapis</small>
      </h1>
    </section>

    <section class = "content">
      <div class = "row">
        <div class= "col-xs-12">
          <div class = "box box-solid">
            <form method = "post"  action="{{url('jadwal-terapi/add')}}" enctype="multipart/form-data" class="form-horizontal">
              {{csrf_field()}}
              <div class = "box-body">
                @if(\Session::has('alert-success'))
                <div class = "alert alert-info alert-dismissible">
                  <button type = "button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h4><i class = "icon fa fa-check"></i> Success!</h4>
                  {{Session::get('alert-success')}}
                </div>
                @endif
                @if(\Session::has('alert'))
                <div class = "alert alert-danger alert-dismissible">
                  <button type = "button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h4><i class = "icon fa fa-check"></i> Warning!</h4>
                  {{Session::get('alert')}}
                </div>
                @endif
                <div class = "row">
                        <div class = "col-xs-7 col-md-12 text-left">
                            <div class = "form-group">
                              <label class = "col-sm-12"><h3>Atur jadwal Terapi</h3>
                              <hr></label>
                            </div>
                        </div>
                </div>
                <input type = "label" name="id_asses" value="{{$id}}">
                @foreach($isi as $I)
                <input type = "hidden" name="id_terapi[]" value="{{$I->id_terapi}}">
                <div class = "row">
                  <div class = "col-xs-8 col-md-12 text-left">
                      <div class = "form-group">
                        <label class = "col-sm-2 control-label" style="text-align: left; padding-left: 20pt">{{$I->terapi}}</label>
                        <div class = "col-sm-2">
                          <div class = "input-group date">
                            <?php 
                              $now=date('Y-m-d');
                            ?>
                            <input type="date" class="form-control pull-right" value="{{$now}}" id="datepicker" name="tgl[]" required>
                          </div>
                        </div>
                        <div class = "col-sm-2">
                          <!-- <div class="form-group">
                            <div class='input-group date' id='example1'>
                              <input type='text' class="form-control" />
                              <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                              </span>
                            </div>
                          </div> -->
                          <input type="date" class="form-control pull-right" name="jam_masuk[]" id="datee" required>
                        </div>
                        <div class = "col-sm-2">
                          <input type="time" class="form-control pull-right" name="jam_keluar[]" id="example2" required>
                        </div>
                        <input type = "hidden" name="id_terapipasien[]" value="{{$I->id_terapipasien}}">
                        <div class = "col-sm-2">
                          <select class = "form-control select2" style="width: 100%;" name="terapis[]" value=" " required>
                            <option value = "Pilih">Pilih</option>
                            @foreach($terapis as $isi)
                            @if($I->id_terapi==$isi->id_terapi)
                            <option value = "{{$isi->id_pegawai}}">{{$isi->nama}}</option>
                            @endif
                            @endforeach
                            <option value = "null">-</option>
                          </select>
                        </div>
                        <div class = "col-sm-2">
                            <input type = "text" class="form-control pull-right" placeholder="Biaya" name="biaya[]" required value="0">
                        </div>
                      </div>
                  </div>
                </div>
                @endforeach
                <br>
                <label class = "col-sm-2 control-label" style="text-align: left; padding-left: 10pt">Perulangan Jadwal</label>
                <div class = "col-sm-2">
                  <div class = "form-group">
                    @foreach(App\Event::RECURRENCE_RADIO as $key => $label)
                    <div>
                        <input id="recurrence_{{ $key }}" name="recurrence" type="radio" value="{{ $key }}" {{ old('recurrence', 'none') === (string)$key ? 'checked' : '' }} required>
                        <label for="recurrence_{{ $key }}">{{ $label }}</label>
                    </div>
                    @endforeach
                  </div>
                </div>
                <br>
                <div class = "col-sm-12 text-right">
                  <input type = "submit" class="btn btn-info" name="" value="Tambah">
                </div>
                <div class="row">
                  <div class="col-xs-12">
                    <hr>
                    <div class="box box-solid">
                      <div class="box-header">
                        <i class="fa fa-bar-chart-o"></i>
                        <h3 class="box-title">Preview Jadwal Terapi</h3>
                      </div>
                      <div class="box-body">
                        <table id="alljadwal" class="table table-bordered table-striped text-center">
                          <thead>
                          <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Jam</th>
                            <th>Terapis</th>
                            <th>Pasien</th>
                            <th>Jenis Terapi</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                          </tr>
                          </thead>
                          <tbody>
                            @php
                              $no=1;
                            @endphp
                            @foreach($tabel as $data)
                            <tr>
                              <td>{{$no}}</td>
                              <td>{{$data->tgl}}</td>
                              <td>{{$data->jam_masuk}} - {{$data->jam_keluar}}</td>
                              <td>{{$data->nama}}</td>
                              <td>{{$data->namaP}}</td>
                              <td>{{$data->id_terapi}}</td>
                              <td>{{$data->keterangan}}</td>
                              <td>
                                <div class="inline">
                                  <a class="btn btn-danger btn-sm" href="{{url('/jadwal-terapi/hapus')}}/{{$data->id_jadwal}}" onclick="return confirm('Apakah Anda Yakin Menghapus Data Ini?')">
                                    Hapus
                                  </a>
                                </div>
                              </td>
                            </tr>
                            @php
                              $no++;
                            @endphp
                            @endforeach
                          </tbody>
                          <tfoot>
                          <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Jam</th>
                            <th>Terapis</th>
                            <th>Pasien</th>
                            <th>Jenis Terapi</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                          </tr>
                          </tfoot>
                        </table>
                      </div>
                      <!-- /.box-body -->
                    </div>
                  </div>
                  <br>
                  <div class="row col-xs-12 col-md-12" style="padding-top: 20px; padding-bottom: 20px">
                    <!-- <div class="col-md-1 text-left">
                      <input type="submit" class="btn btn-success" name="" value="Simpan">
                    </div> -->
                    <div class="col-md-1 text-left">
                      <a href="{{url('/jadwal-terapi')}}"><div class="btn btn-warning">Keluar</div></a>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>

      <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
      <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
      <link href="/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
      <script src="https://cdn.jsdelivr.net/momentjs/2.14.1/moment.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
      <script>
          $(document).ready(function() {
              $('#alljadwal').DataTable();
          });
      </script>
      <script>
      $(function () {
        $('#example1,#example2').timepicker({
          format: 'H:i:s'
          autoclose: true
          sideBySide: true, 
          });
      });
      </script>
      <script type="text/javascript">
        $(function () {
          $('#datepicker,#datee').datepicker({
          format: 'dd-mm-yyyy'
          autoclose: true
          sideBySide: true, 
          });
        });
      </script>

    </section>
  </div>

@endsection
