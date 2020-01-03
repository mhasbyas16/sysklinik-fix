@extends('template.style')
@section('isi')
@include('sweet::alert')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header d-md-inline-flex">
    <h1>
    Rekam Medis
    <small>Header Rekam Medis</small>
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
            <h3 class="box-title">Tabel Rekam Medis</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="pegawais" class="table table-bordered table-striped">
              <thead>
                <tr>
                <th>No</th>
                <th>ID Rekam Medis</th>
                <th>Nama Pasien</th>
                <th>Jenis Terapi</th>
                <th>Diagnosa</th>
                <th>Aksi</th>
                </tr>
              </thead>
              <tfoot>
              <tr>
                <th>No</th>
                <th>ID Rekam Medis</th>
                <th>Nama Pasien</th>
                <th>Jenis Terapi</th>
                <th>Diagnosa</th>
                <th>Aksi</th>
              </tr>
              </tfoot>
              <tbody>
                  @php
                    $no=1;
                  @endphp
                  @foreach ($list_rekam_medis as $list_rm)
                  <tr>
                    <td>{{$no}}</td>
                    <td><a href="{{ url('detail_rekam_medis/'.$list_rm->id_rm) }}">{{ $list_rm->id_rm }}</a></td>
                    <td>{{ $list_rm->nama }}</td>
                    <td>{{ $a }}</td>
                    <td>{{ $list_rm->diagnosa }}</td>
                    <td>
                      <a href="{{url('rekam_medis/'.$list_rm->id_rm.'/edit')}}" class="col-md-3 btn btn-primary">Edit</a> 
                      <form action="{{ url('rekam_medis/'.$list_rm->id_rm) }}" id="rekam_medis" method="POST" class="col-md-3">
                          @method('DELETE')
                          @csrf
                          <input type="submit" value="Hapus" class="btn btn-danger btn-delete">
                      </form>
                    </td>
                  </tr>
                  @php
                    $no++;
                  @endphp
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

<script>
  $('.btn-delete').click(function(e) {
        return confirm("Are you sure?");
});
</script>
@endsection