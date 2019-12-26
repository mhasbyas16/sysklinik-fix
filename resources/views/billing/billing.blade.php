@extends('template.style')
@section('isi')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
    Billing
    <small>Header Billing</small>
    </h1>
    <!--
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-files-o"></i> Main Menu</a></li>
      <li class="active">Assesment</li>
    </ol>
    -->
  </section>
  <!-- Main content -->
  <div class="col-md-12">
    <div>
      <br>
      
      <div class="row">
        <div class="col-xs-12">
          <!-- jQuery Knob -->
          <div class="box box-solid">
            <div class="box-header">
              <i class="fa fa-bar-chart-o"></i>
              <h3 class="box-title">Tabel Billing</h3>
            </div>
            
            <!-- /.box-header -->
            <div class="box-body">
              <table id="pegawais" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>ID Billing</th>
                    <th>Nama</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($data as $d)
                    <tr>
                      <td>{{ $d->id_bill }}</td>
                      <td>{{ $d->nama }}</td>
                      <td>{{ $d->tgl }}</td>
                      <td>
                        <a href="{{ url('billing/'.$d->id_bill) }}" class="btn btn-primary">Detail Pembayaran 
                          @php
                            $bBukti = \App\BuktiBilling::where('status', 'Baru')->where('id_bill', $d->id_bill)->count();
                          @endphp
                          @if (isset($bBukti))
                            @if ($bBukti > 0)
                              <span class="badge bg-white text-black">{{ $bBukti }}</span>
                            @endif
                          @endif
                        </a>  
                        <a href="{{ url('detail_billing/'.$d->id_bill) }}" class="btn btn-success">Detail Billing</a>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
                <tfoot>
                  <tr>
                    <th>ID Billing</th>
                    <th>Nama</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                  </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- End Main content -->
</div>
@endsection