@extends('template.style')
@section('isi')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data Master
        <small>Jenis Terapis</small>
      </h1>
      <!--
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-files-o"></i> Main Menu</a></li>
        <li class="active">Assesment</li>
      </ol>
      -->
    </section>

    <!-- Main content -->
    <section class="content">

              <!-- row -->
              <div class="row">
                <div class="col-xs-12">
                  <!-- jQuery Knob -->
                  <div class="box box-solid">

                    <!-- begin data alat-->
                    <form class="form-horizontal" method="post" action="{{url('/data-terapi/add')}}" enctype="multipart/form-data">
                      {{csrf_field()}}
                    <div class="box-body">
                      <div class="row">
                        <div class="col-xs-7 col-md-12 text-left">
                            <div class="form-group">
                              <label class="col-sm-12"><h3>Tambah Jenis Terapi</h3><hr></label>
                            </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-xs-7 col-md-8 text-center">
                            <div class="form-group">
                              <label class="col-sm-4 control-label" style="text-align: left; padding-left: 40pt">Kode Jenis Terapi</label>

                              <div class="col-sm-7">
                                <input type="text" class="form-control" name="kode_jenis" required>
                              </div>
                            </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-xs-7 col-md-8 text-center">
                            <div class="form-group">
                              <label class="col-sm-4 control-label" style="text-align: left; padding-left: 40pt">Jenis Terapi</label>

                              <div class="col-sm-7">
                                  <input type="text" class="form-control" id="alamatP" name="nama_jenis"></textarea>
                              </div>
                            </div>
                        </div>
                      </div>

                      <div class="button">
                        <ul class="left" style="padding-left: 390pt ">
                          <button class="btn btn-success" href="#">Simpan</button>
                          <button class="btn btn-danger" href="#">Batal</button>
                        </ul>
                      </div>

                    </div>

                    </form>
                    <!-- /.box-body -->
                  </div>
                  <!-- /.box -->
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- row -->
              <div class="row">
                <div class="col-xs-12">
                  <!-- jQuery Knob -->
                  <div class="box box-solid">
                    <div class="box-header">
                      <i class="fa fa-bar-chart-o"></i>
                      <h3 class="box-title">Tabel Jenis Terapi</h3>
                    </div>

                    <!-- /.box-header -->
                    <div class="box-body">
                      <table id="terapi" class="table table-bordered table-striped text-center">
                        <thead>
                        <tr>
                          <th>ID Terapi</th>
                          <th>Nama Terapi</th>
                          <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                          @foreach($data as $data)
                        <tr>
                          <td>{{$data->id_terapi}}</td>
                          <td style="text-align:left">{{$data->terapi}}</td>
                          <td><a href="{{url('/data-terapi/delete')}}/{{$data->id_terapi}}" onclick="return confirm('apakah anda yakin akan menghapus data ini')"><button class="btn btn-danger" href="#">Delete</button></a></td>
                        </tr>
                          @endforeach
                        </tbody>
                        <tfoot>
                          <tr>
                            <th>ID Terapi</th>
                            <th>Nama Terapi</th>
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
    <!-- /.content -->
  </div>

@endsection
