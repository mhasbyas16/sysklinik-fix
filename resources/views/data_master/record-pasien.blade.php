@extends('template.style')
@section('isi')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data Master
        <small>Record Pasien</small>
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
                    <div style="padding-bottom: 20px; padding-top: 20px; padding-left: 10px" class="row">
                      <div class="col-lg-12">
                        <a class="btn btn-danger" href="{{ url('/data-pasien') }}">
                          Kembali
                        </a>
                      </div>
                    </div>
                    <div class="box-header">
                      <i class="fa fa-bar-chart-o"></i>
                      <h3 class="box-title">Record Pasien</h3>
                    </div>

                    <!-- /.box-header -->
                    <div class="box-body">
                      <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>Nama</th>
                      <th>ID Asses</th>
                      <th>Keterangan</th>
                      <th>Tanggal</th>
                    </tr>
                    </thead>
                    <tbody>
                      @foreach($data as $record)
                        <tr>
                          <td>{{$record->nama}}</td>
                          <td>{{$record->id_asses}}</td>
                          <td>{{$record->keterangan}}</td>
                          <td>{{$record->tgl}}</td>
                        </tr>
                      @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                      <th>Nama</th>
                      <th>ID Asses</th>
                      <th>Keterangan</th>
                      <th>Tanggal</th>
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
