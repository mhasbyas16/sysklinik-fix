@extends('template.style')
@section('isi')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
    Billing
    <small>Bukti Pembayaran Billing</small>
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
            <h3 class="box-title">Tabel Bukti Pembayaran Billing</h3>
          </div>
          
          <!-- /.box-header -->
          <div class="box-body">
            <table id="pegawais" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>ID Bukti Bayar</th>
                  <th>Tanggal Bayar</th>
                  <th>Jumlah bayar</th>
                  <th>Keterangan</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($data as $d)
                  <tr>
                    <td>{{ $d->id_bukti}}</td>
                    <td>{{ $d->tgl_bayar}}</td>
                    <td>{{ $d->jml_bayar }}</td>
                    <td><a href="{{ url('billing/'.$d->id_bukti.'/edit') }}">{{ $d->validasi }}</a></td>
                  </tr>
                @endforeach
              </tbody>
              <tfoot>
              <tr>
                  <th>ID Bukti Bayar</th>
                  <th>Tanggal Bayar</th>
                  <th>Jumlah bayar</th>
                  <th>Keterangan</th>
              </tr>
              </tfoot>
            </table>
          </div>
          <!-- /.box-body -->
        </div>
      </div>
    </div>
    
  </section>
  <!-- End Main content -->
</div>
@endsection