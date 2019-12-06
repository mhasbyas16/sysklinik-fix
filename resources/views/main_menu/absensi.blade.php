@extends('template.style')
@section('isi')
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Main Menu
          <small>Absensi</small>
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
        <div>
        <br>
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
          <li role="presentation" class="{{Request::is('absensi','absensi/pasien')?'active':''}}">
            <a href="#pasien" aria-controls="home" role="tab" data-toggle="tab">Pasien</a>
          </li>
          <li role="presentation" class="{{Request::is('absensi/terapis')?'active':''}}">
            <a href="#terapis" aria-controls="profile" role="tab" data-toggle="tab">Terapis</a>
          </li>
          <li role="presentation" class="{{Request::is('absensi/karyawan')?'active':''}}">
            <a href="#karyawan" aria-controls="profile" role="tab" data-toggle="tab">Karyawan</a>
          </li>
        </ul>

        @include('main_menu.absensi-tab.absensi-pasien')

          <div role="tabpanel" class="tab-pane {{Request::is('absensi/terapis')?'active':''}}" id="terapis">
            <section class="content">
                <div class="row">
                  <div class="col-xs-12">
                    <!-- jQuery Knob -->
                    <div class="box box-solid">
                      <div class="box-header">
                        <i class="fa fa-bar-chart-o"></i>
                        <h3 class="box-title">Tabel Presensi Terapis</h3>
                      </div>

                      <!-- /.box-header -->
                      <div class="box-body">
                        <form method="post" action="{{url('/absensi/terapis')}}">
                          {{csrf_field()}}
                        <table border="0" cellspacing="5" cellpadding="5">
                          <tbody><tr>
                            <td>Dari</td>
                            <td>:</td>
                            <td><div class="input-group date">
                                <div class="input-group-addon">
                                  <i class="fa fa-calendar"></i>
                                </div>
                                  <input type="date" class="form-control" name="min">
                                </div>
                            </td>
                            <td>-</td>
                            <td><div class="input-group date">
                                <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                                </div>
                                <input type="date" class="form-control" name="max">
                            </div>
                          </td>
                          <td>&nbsp;&nbsp;&nbsp;</td>
                          <td><button type="submit" class="btn btn-information"><i class="fa fa-search"></i></button></td>
                          </form>
                          <td>&nbsp;&nbsp;&nbsp;</td>
                          <td><a href="{{url('/absensi')}}"><button type="button" class="btn btn-success">Clear</button></a></td>
                          </tr>
                          <tr>
                          </tr>
                        </tbody></table>
                        <br>
                        <table id="absensiTerapis" class="display text-center" style="width:100%;" >
                          <thead>
                            <tr>
                              <th>Nama</th>
                              <th>Tanggal</th>
                              <th>Jam Masuk</th>
                              <th>Jam Keluar</th>
                              <th>ID Jadwal</th>
                              <th>Status</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach ($terapis as $isi)
                              <tr>
                                <td>{{$isi->nama}}</td>
                                <td>{{$isi->tgl}}</td>
                                <td>{{$isi->jam_masuk}}</td>
                                <td>{{$isi->jam_keluar}}</td>
                                <td>{{$isi->id_jadwal}}</td>
                                <td>{{$isi->status_terapis}}</td>
                              </tr>
                            @endforeach
                          </tbody>
                          <tfoot>
                            <tr>
                              <th>Nama</th>
                              <th>Tanggal</th>
                              <th>Jam Masuk</th>
                              <th>Jam Keluar</th>
                              <th>ID Jadwal</th>
                              <th>Status</th>
                            </tr>
                          </tfoot>
                      </div>
                    </table>
                      </div>
                      <!-- /.box-body -->
                    </div>
                  </div>
                </div>
            </section>
          </div>
          <script type="text/javascript">
          $(document).ready(function() {
              $('#absensiTerapis').DataTable({
                dom: 'Bfrtip',
                buttons:[
                  {extend:'excelHtml5',
                   title:'Absensi Terapis'},
                  {extend:'pdfHtml5',
                   title:'Absensi Terapis'},
                   'print'],
                   select:true
              });
          });
          </script>
          <div role="tabpanel" class="tab-pane {{Request::is('absensi/karyawan')?'active':''}}" id="karyawan">
            <section class="content">
                <div class="row">
                  <div class="col-xs-12">
                    <!-- jQuery Knob -->
                    <div class="box box-solid">
                      <div class="box-header">
                        <i class="fa fa-bar-chart-o"></i>
                        <h3 class="box-title">Tabel Presensi Karyawan</h3>
                      </div>

                      <!-- /.box-header -->
                      <div class="box-body">
                        <form method="post" action="{{url('/absensi/karyawan')}}">
                          {{csrf_field()}}
                        <table border="0" cellspacing="5" cellpadding="5">
                          <tbody><tr>
                            <td>Dari</td>
                            <td>:</td>
                            <td><div class="input-group date">
                                <div class="input-group-addon">
                                  <i class="fa fa-calendar"></i>
                                </div>
                                  <input type="date" class="form-control" name="min">
                                </div>
                            </td>
                            <td>-</td>
                            <td><div class="input-group date">
                                <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                                </div>
                                <input type="date" class="form-control" name="max">
                            </div>
                          </td>
                          <td>&nbsp;&nbsp;&nbsp;</td>
                          <td><button type="submit" class="btn btn-information"><i class="fa fa-search"></i></button></td>
                          </form>
                          <td>&nbsp;&nbsp;&nbsp;</td>
                          <td><a href="{{url('/absensi')}}"><button type="button" class="btn btn-success">Clear</button></a></td>
                          </tr>
                          <tr>
                          </tr>
                        </tbody></table>
                        <br>
                        <table id="absensiKaryawan" class="display text-center" style="width:100%;" >
                          <thead>
                            <tr>
                              <th>Nama</th>
                              <th>Tanggal</th>
                              <th>Jam Masuk</th>
                              <th>Jam Keluar</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach ($karyawan as $isi)
                              <tr>
                                <td>{{$isi->nama}}</td>
                                <td>{{$isi->tgl}}</td>
                                <td>{{$isi->jam_masuk}}</td>
                                <td>{{$isi->jam_keluar}}</td>
                              </tr>
                            @endforeach
                          </tbody>
                          <tfoot>
                            <tr>
                              <th>Nama</th>
                              <th>Tanggal</th>
                              <th>Jam Masuk</th>
                              <th>Jam Keluar</th>
                            </tr>
                          </tfoot>
                      </div>
                    </table>
                      </div>
                      <!-- /.box-body -->
                    </div>
                  </div>
                </div>
            </section>
          </div>
          <script type="text/javascript">
          $(document).ready(function() {
              $('#absensiKaryawan').DataTable({
                dom: 'Bfrtip',
                buttons:[
                  {extend:'excelHtml5',
                   title:'Absensi Karyawan'},
                  {extend:'pdfHtml5',
                   title:'Absensi Karyawan'},
                   'print'],
                   select:true
              });
          });
          </script>
        </div>
        <!-- End Nav tabs -->

        </div>
      </div>
      <!-- /.content -->
    </div>

  @endsection
