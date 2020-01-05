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
                        <!-- ./col -->
                </div>
                <input type = "hidden" name="id_asses" value="{{$id}}">
                @foreach($isi as $I)
                <input type = "hidden" name="id_terapi[]" value="{{$I->id_terapi}}">
                <div class = "row">
                  <div class = "col-xs-8 col-md-12 text-left">
                      <div class = "form-group">
                        <label class = "col-sm-2 control-label" style="text-align: left; padding-left: 20pt">{{$I->terapi}}</label>
                        <div class = "col-sm-2">
                          <div class = "input-group date">
                            <div class = "input-group-addon">
                              <i class = "fa fa-calendar"></i>
                            </div>
                            <?php 
                              $now=date('Y-m-d');
                            ?>
                            <input type = "text" class="form-control pull-right" value="{{$now}}" id="datepicker" placeholder="tanggal" name="tgl[]" required>
                          </div>
                        </div>
                        <div class = "col-sm-2">
                          <input type = "time" class="form-control pull-right" value="00:00:00" placeholder="jam Masuk" name="jam_masuk[]" required>
                        </div>
                        <div class = "col-sm-2">
                          <input type = "time" class="form-control pull-right" value="00:00:00" placeholder="jam keluar" name="jam_keluar[]" required>
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

      <script>
          $(document).ready(function() {
              $('#alljadwal').DataTable();
          });
      </script>

    </section>
  </div>

@endsection
