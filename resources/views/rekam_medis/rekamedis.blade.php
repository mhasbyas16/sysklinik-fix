@extends('template.style')
@section('isi')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header d-md-inline-flex">
    <h1>
    Rekam Medis
    <small>Header Rekam Medis</small>
    </h1>
    <a href="{{ url('rekam_medis/create') }}" class="btn btn-primary">Add New</a>
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
            <h3 class="box-title">Tabel Rekam Medis</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="pegawais" class="table table-bordered table-striped">
              <thead>
                <tr>
                <th>ID Rekam Medis</th>
                <th>ID Asses</th>
                <th>Diagnosa</th>
                <th>Aksi</th>
                </tr>
              </thead>
              <tfoot>
              <tr>
                <th>ID Rekam Medis</th>
                <th>ID Asses</th>
                <th>Diagnosa</th>
                <th>Aksi</th>
              </tr>
              </tfoot>
              <tbody>
                @foreach ($list_rekam_medis as $list_rm)
                  <tr>
                    <td><a href="{{ url('detail_rekam_medis/'.$list_rm->id_rm) }}">{{ $list_rm->id_rm }}</a></td>
                    <td><a href="{{ url('detail_rekam_medis/'.$list_rm->id_rm) }}">{{ $list_rm->id_asses }}</td>
                    <td><a href="{{ url('detail_rekam_medis/'.$list_rm->id_rm) }}">{{ $list_rm->diagnosa }}</td>
                    <td>
                      <a href="{{url('detail_rekam_medis/'.$list_rm->id_rm.'/edit')}}" class="col-md-3">Edit</a>
                      <form action="{{ url('rekam_medis/'.$list_rm->id_rm) }}" method="POST" style="padding:0px; margin:0px" class="col-md-3">
                          @method('DELETE')
                          @csrf
                          <input type="submit" style="padding:0px; margin:0px; border: 0px; background: none" value="Hapus" class="btn-link">
                      </form>
                    </td>
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