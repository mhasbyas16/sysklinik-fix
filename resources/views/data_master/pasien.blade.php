@extends('template.style')
@section('isi')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data Master
        <small>Pasien</small>
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
    <!-- row -->
              <div class="row">
                <div class="col-xs-12">
                  <!-- jQuery Knob -->
                  <div class="box box-solid">
                    <div class="box-header">
                      <i class="fa fa-bar-chart-o"></i>
                      <h3 class="box-title">Tabel Pasien</h3>
                    </div>

                    <!-- /.box-header -->
                    <div class="box-body">
                      <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>Nama</th>
                      <th>ID Asses</th>
                      <th>Assesor</th>
                      <th>Status</th>
                      <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                      @foreach($data as $data)
                      <tr>
                        <td>{{$data->namaPAS}}</td>
                        <td>{{$data->id_asses}}</td>
                        <td>{{$data->namaPEG}}</td>
                        <td>{{$data->status_pasien}}</td>
                        <td><div class="btn-group">
                                <a href="{{url('/data-pasien/view')}}/{{$data->id_pasien}}">
                                  <button class="btn btn-info" >Edit</button></a>
                                <a href="{{url('/data-pasien/record')}}/{{$data->id_pasien}}">
                                  <button  type="button" class="btn btn-success" data-toggle="modal" data-target="#{{$data->id_pegawai}}">Record</button></a>
                            </div>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Nama</th>
                        <th>ID Asses</th>
                        <th>Assesor</th>
                        <th>Status</th>
                        <th>Batal</th>
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
</div>
</div>

@endsection
