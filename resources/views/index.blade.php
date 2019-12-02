@extends('template.style')
@section('isi')
@include('sweet::alert')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard Administrator Klinik Liliput
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dash</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua" >
            <div class="inner">
              <h3 value="{{$terapis}}">{{$terapis}}</h3>

              <p><a href="{{url('data-terapis')}}" style="color: white">Total Terapis</a></p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3 value="{{$pegawai}}">{{$pegawai}}</h3>

              <p><a href="{{url('karyawan')}}" style="color: white">Total Karyawan</a></p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3 value="{{$pasien}}">{{$pasien}}</h3>

              <p><a href="{{url('data-pasien')}}" style="color: white">Total Pasien</a></p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3 value="{{$jenis}}">{{$jenis}}</h3>

              <p><a href="{{url('data_terapi')}}" style="color: white">Total Jenis Terapi</a></p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-7 connectedSortable">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <!-- Tabs within a box -->
            <ul class="nav nav-tabs pull-right">
              <li class="active"><a href="#revenue-chart" data-toggle="tab">Bar Chart</a></li>
              <li class="pull-left header"><i class="fa fa-inbox"></i> Total Pasien Tiap Jenis Terapi</li>
            </ul>
            <div class="tab-content no-padding">
              <!-- Morris chart - Sales -->
              <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;"></div>
            </div>
          </div>
          <!-- /.nav-tabs-custom -->

        </section>

        <section class="col-lg-5 connectedSortable">

          <!-- Calendar -->
          <div class="box box-solid bg-green-gradient">
            <div class="box-header">
              <i class="fa fa-calendar"></i>

              <h3 class="box-title">Kalender</h3>
              <!-- tools box -->
              <div class="pull-right box-tools">
                <!-- button with a dropdown -->
                <button type="button" class="btn btn-success btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-success btn-sm" data-widget="remove"><i class="fa fa-times"></i>
                </button>
              </div>
              <!-- /. tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <!--The calendar -->
              <div id="calendar" style="width: 100%"></div>
            </div>
          </div>
          <!-- /.box -->


        </section>
      </div>

      <div class="row">

        <section class="col-lg-12 connectedSortable">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <!-- Tabs within a box -->
            <ul class="nav nav-tabs pull-right">
              <!--li class="active"><a href="#revenue-chart" data-toggle="tab">Request Send Mail</a></li-->
              <li class="pull-left header"><i class="fa fa-inbox"></i> Permintaan Unduh Kuesioner Terapi</li>
            </ul>
            <div class="tab-content no-padding">
              <!-- Morris chart - Sales -->
              <div class="chart tab-pane active" id="revenue-chart" style="position: relative;"></div>
                <div class="row">
                  <div class="col-xs-12">
                    <br>
                      <div class="box-body">
                        <table id="pegawais" class="table table-bordered table-striped text-center">
                          <thead>
                          <tr>
                            <th>Tanggal</th>
                            <th>ID Pasien</th>
                            <th>Nama Pasien</th>
                            <th>E-mail</th>
                            <th>Jenis Terapi</th>
                            <th>Aksi</th>
                            <th>Status</th>
                          </tr>
                          </thead>
                          <tbody>
                            @foreach($kue as $xx)
                            <tr>
                              <td>{{$xx->tgl}}</td>
                              <td>{{$xx->id_pasien}}</td>
                              <td>{{$xx->nama}}</td>
                              <td>{{$xx->email}}</td>
                              <td>{{$xx->jenis_terapi}}</td>
                              <td>
                                <form action="" method="">
                                    
                                    <input type="submit" class="btn btn-info btn-sm" href="#" value="Kirim E-Mail">
                                </form>
                              </td>
                              <td>{{$xx->status}}</td>
                            </tr>
                            @endforeach
                          </tbody>
                          <tfoot>
                          <tr>
                            <th>Tanggal</th>
                            <th>ID Pasien</th>
                            <th>Nama Pasien</th>
                            <th>E-mail</th>
                            <th>Jenis Terapi</th>
                            <th>Aksi</th>
                            <th>Status</th>
                          </tr>
                          </tfoot>
                        </table>
                      </div>
                      <br>
                  </div>
                </div>
            </div>
          </div>
          <!-- /.nav-tabs-custom -->

        </section>
        <!-- right col -->
      </div>

      <div class="row">

        <section class="col-lg-12 connectedSortable">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <!-- Tabs within a box -->
            <ul class="nav nav-tabs pull-right">
              <!--li class="active"><a href="#revenue-chart" data-toggle="tab">Request New Asses</a></li-->
              <li class="pull-left header"><i class="fa fa-inbox"></i> Permintaan Pasien untuk Assesment Baru</li>
            </ul>
            <div class="tab-content no-padding">
              <!-- Morris chart - Sales -->
              <div class="chart tab-pane active" id="revenue-chart" style="position: relative;"></div>
                <div class="row">
                  <div class="col-xs-12">
                    <br>
                      <div class="box-body">
                        <table id="pegawaiis" class="table table-bordered table-striped text-center">
                          <thead>
                          <tr>
                            <th>Tanggal</th>
                            <th>ID Pasien</th>
                            <th>Nama Pasien</th>
                            <th>E-Mail</th>
                            <th>Status</th>
                            <th>Aksi</th>
                          </tr>
                          </thead>
                          <tbody>
                            @foreach($r as $x)
                            <tr>
                              <td>{{$x->tgl}}</td>
                              <td>{{$x->id_pasien}}</td>
                              <td>{{$x->nama}}</td>
                              <td>{{$x->email}}</td>
                              <td>{{$x->status}}</td>
                              <td>
                                <div class="inline">
                                  <a href="#">
                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#update" id="ubah">Ubah</button>
                                  </a>
                                  <a href="{{url('/hapus')}}/{{$data->id_pasien}}" onclick="return confirm('Apakah Anda Yakin Menghapus Data Ini?')">
                                    <button type="button" class="btn btn-danger">Hapus</button>
                                  </a>
                                </div>
                              </td>
                            </tr>
                            @endforeach
                          </tbody>
                          <tfoot>
                          <tr>
                            <th>Tanggal</th>
                            <th>ID Pasien</th>
                            <th>Nama Pasien</th>
                            <th>E-Mail</th>
                            <th>Status</th>
                            <th>Aksi</th>
                          </tr>
                          </tfoot>
                        </table>
                      </div>
                      <br>
                  </div>
                </div>
            </div>
          </div>
          <!-- /.nav-tabs-custom -->
          <form action="{{url('/ubahstatus')}}" method="post">
          <div class="modal" id="update">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">Update Status</h4>
                  </div>
                  <div class="modal-body">
                    <input class="control-label col-md-4 text-left" type="text" name="ids" placeholder="id pasiennya">
                        
                    <div class="text-center col-sm-4">
                      <div class="form-group d-md-inline-flex col-md-11">
                        <label class="control-label col-md-4 text-left">Status</label>
                        <select class="form-control col-md-8 text-left select2" style="width: 100%;" name="status" required>
                          <option value="Pilih">Pilih</option>
                          <option value="Terima">Terima</option>
                          <option value="Tolak">Tolak</option> 
                        </select>
                      </div>
                    </div>
                   </div>
                   <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" href="#">Simpan</button>
                   </div>
                </div>
              </div>
          </div>
          </form>

          @if(\Session::has('alertwarn'))
              <div class="alert alert-success">
                <strong> Success </strong> {{Session::get('alert-success')}}
              </div>
            @endif

        </section>
    <!-- /.content -->
  </div>

  <script type="text/javascript">
    var table=$('#pegawaiis').Datatable();

    $('#pegawaiis').on('click', 'tr', function(){
      var id=table.row(this).id();
      $('#ids').val(id);
    });
  </script>


  <!-- /.content-wrapper -->
  @endsection
