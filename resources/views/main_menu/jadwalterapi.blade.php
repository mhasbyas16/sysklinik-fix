@extends('template.style')
@section('isi')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Main Menu
        <small>Jadwal Terapi</small>
      </h1>
      <!--
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-files-o"></i> Main Menu</a></li>
        <li class="active">Assesment</li>
      </ol>
    -->
    </section>


    <!-- Main content -->
    <div class="container">
      <div class="row">
          <div class="col-md-10 col-xs-offset-1 ">
              <div class="panel panel-default">
                  <div class="panel-heading">Kalender Jadwal Keseluruhan</div>

                  <div class="panel-body">
                      {!! $calendar->calendar() !!}
                      {!! $calendar->script() !!}
                  </div>
              </div>
          </div>
      </div>
      <div>
      <br>
      <!-- Nav tabs -->
      <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active">
          <a href="#home" aria-controls="home" role="tab" data-toggle="tab">Jadwal Keseluruhan</a>
        </li>
        <li role="presentation">
          <a href="#assessment" aria-controls="profile" role="tab" data-toggle="tab">Asses Pasien</a>
        </li>
        <li role="presentation">
          <a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Request Terapis</a>
        </li>
        <li role="presentation">
          <a href="#profiles" aria-controls="profile" role="tab" data-toggle="tab">Request Pasien</a>
        </li>
      </ul>

      <!-- Tab panes -->
      <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="home">
          <section class="content">
              <div class="row">
                <div class="col-xs-12">
                  <!-- jQuery Knob -->
                  <div class="box box-solid">
                    <div class="box-header">
                      <i class="fa fa-bar-chart-o"></i>
                      <h3 class="box-title">Tabel Jadwal Keseluruhan</h3>
                    </div>

                    <!-- /.box-header -->
                    <div class="box-body">
                      <table id="pegawais" class="table table-bordered table-striped text-center">
                        <thead>
                        <tr>
                          <th>Jam</th>
                          <th>Terapis</th>
                          <th>Pasien</th>
                          <th>Jumlah Sesi</th>
                        </tr>
                        </thead>
                        <tbody>
                          @foreach($data2 as $data)
                          <tr>
                            <td>{{$data->jam_masuk}}</td>
                            <td>{{$data->nama}}</td>
                            <td>{{$data->namaP}}</td>
                            <td>jml sesi</td>
                          </tr>
                          @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                          <th>Jam</th>
                          <th>Terapis</th>
                          <th>Pasien</th>
                          <th>Jumlah Sesi</th>
                        </tr>
                        </tfoot>
                      </table>
                    </div>
                    <!-- /.box-body -->
                  </div>
                </div>
              </div><div class="container">

              </div>
          </section>
        </div>

        <div role="tabpanel" class="tab-pane" id="profile">
          <section class="content">
              <div class="row">
                <div class="col-xs-12">
                  <!-- jQuery Knob -->
                  <div class="box box-solid">
                    <div class="box-header">
                      <i class="fa fa-bar-chart-o"></i>
                      <h3 class="box-title">Tabel Request Jadwal Terapis</h3>
                    </div>

                    <!-- /.box-header -->
                    <div class="box-body">
                      <table id="pegawais" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                          <th>Nama</th>
                          <th>Hari</th>
                          <th>Waktu</th>
                          <th>Deskripsi</th>
                          <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                          @foreach ($rterapis as $isi)
                          <tr>
                            <td>{{$isi->nama}}</td>
                            <td>{{$isi->hari}}</td>
                            <td>{{$isi->waktu}}</td>
                            <td></td>
                          </tr>
                          @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                          <th>Nama</th>
                          <th>Hari</th>
                          <th>Waktu</th>
                          <th>Deskripsi</th>
                          <th>Aksi</th>
                        </tr>
                        </tfoot>
                      </table>
                    </div>
                    <!-- /.box-body -->
                  </div>
                </div>
              </div>
          </section>
        </div>

        <div role="tabpanel" class="tab-pane" id="assessment">
          <section class="content">
              <div class="row">
                <div class="col-xs-12">
                  <!-- jQuery Knob -->
                  <div class="box box-solid">
                    <div class="box-header">
                      <i class="fa fa-bar-chart-o"></i>
                      <h3 class="box-title">Tabel Request Jadwal Terapis</h3>
                    </div>

                    <!-- /.box-header -->
                    <div class="box-body">
                      <table id="pegawais" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                          <th>Nama</th>
                          <th>Assesor</th>
                          <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
                          @foreach($assessment as $asses)
                          <tr>
                            <td><a href="{{url('/jadwal-terapi/asses')}}/{{$asses->id_asses}}">{{$asses->namaP}}</a></td>
                            <td>{{$asses->namaA}}</td>
                            <td>{{$asses->status_pasien}}</td>
                          </tr>
                          @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                          <th>Nama</th>
                          <th>Assesor</th>
                          <th>Status</th>
                        </tr>
                        </tfoot>
                      </table>
                    </div>
                    <!-- /.box-body -->
                  </div>
                </div>
              </div>
          </section>
        </div>

        <div role="tabpanel" class="tab-pane" id="profiles">
          <section class="content">
              <div class="row">
                <div class="col-xs-12">
                  <!-- jQuery Knob -->
                  <div class="box box-solid">
                    <div class="box-header">
                      <i class="fa fa-bar-chart-o"></i>
                      <h3 class="box-title">Tabel Request Jadwal Pasien</h3>
                    </div>

                    <!-- /.box-header -->
                    <div class="box-body">
                      <table id="pegawais" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                          <th>Nama</th>
                          <th>Hari</th>
                          <th>Waktu</th>
                          <th>Deskripsi</th>
                          <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                          @foreach ($rpasien as $isi)
                          <tr>
                            <td>{{$isi->nama}}</td>
                            <td>{{$isi->hari}}</td>
                            <td>{{$isi->waktu}}</td>
                            <td></td>
                          </tr>
                          @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                          <th>Nama</th>
                          <th>Hari</th>
                          <th>Waktu</th>
                          <th>Deskripsi</th>
                          <th>Aksi</th>
                        </tr>
                        </tfoot>
                      </table>
                    </div>
                    <!-- /.box-body -->
                  </div>
                </div>
              </div>
          </section>
        </div>

      </div>
      <!-- End Nav tabs -->

      </div>
    </div>
    <!-- /.content -->
  </div>

@endsection
