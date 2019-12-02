@extends('template.style')
@section('isi')

<?php  
  
      function tglIndonesia($str){
         $tr   = trim($str);
         $str    = str_replace(array('Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12'), array('Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum\'at', 'Sabtu', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'), $tr);
         return $str;
     }
?>

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Payroll
        <small>Laporan Payroll</small>
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
          <div class="box box-solid">
            <div class="box-body">

                    <div class="col-md-12">
                      <table id="pegawais" class="table table-bordered table-striped">
                        <thead>
                          <tr>
                          <th>Bulan</th>
                          <th>Nama Pegawai</th>
                          <th>Jabatan</th>
                          </tr>
                        </thead>
                        <tfoot>
                        <tr>
                          <th>Bulan</th>
                          <th>Nama Pegawai</th>
                          <th>Jabatan</th>
                        </tr>
                        </tfoot>
                        <tbody>
                          @foreach ($data as $d)
                            <tr>
                              <td><a href="{{ url('payroll/'.$d->id_payroll) }}">{{  tglIndonesia(date('F', strtotime($d->tgl))).' '. date('Y', strtotime($d->tgl))  }}</a></td>
                              <td style="text-transform: capitalize">{{ $d->nama }}</td>
                              <td>{{ $d->jabatan }}</td>
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>

            </div>                   
          </div>
        </div>
      </div>
      
    </section>
    <!-- /.content -->
  </div>

@endsection
