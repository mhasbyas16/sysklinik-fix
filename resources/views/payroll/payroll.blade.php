@extends('template.style')
@section('isi')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Payroll
        <small>Header Payroll</small>
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
          <div class="box-header">
            <i class="fa fa-bar-chart-o"></i>
            <h3 class="box-title">Tabel Pegawai</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="pegawais" class="table table-bordered table-striped">
              <thead>
                <tr>
                <th>ID Pegawai</th>
                <th>Nama Pegawai</th>
                <th>Jabatan</th>
                </tr>
              </thead>
              <tfoot>
              <tr>
                <th>ID Pegawai</th>
                <th>Nama Pegawai</th>
                <th>Jabatan</th>
              </tr>
              </tfoot>
              <tbody>
                @foreach ($data as $d)
                  <tr>
                    <td><a href="{{ url('payroll/'.$d->id_p.'/edit') }}">{{ $d->id_p }}</a></td>
                    <td style="text-transform: capitalize">{{ $d->nama }}</td>
                    <td>{{ $d->jabatan }}</td>
                  </tr>
                @endforeach
              </tbody>
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
