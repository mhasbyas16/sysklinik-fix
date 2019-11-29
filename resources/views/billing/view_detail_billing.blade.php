@extends('template.style')
@section('isi')
<script src='http://fullcalendar.io/js/fullcalendar-2.1.1/lib/moment.min.js'></script>
<script src='http://fullcalendar.io/js/fullcalendar-2.1.1/lib/jquery.min.js'></script>
<script src="http://fullcalendar.io/js/fullcalendar-2.1.1/lib/jquery-ui.custom.min.js"></script>
<script src='http://fullcalendar.io/js/fullcalendar-2.1.1/fullcalendar.min.js'></script>
<div class="content-wrapper">
  <style>
    .content-wrapper{
      background: white;
      min-height: -61px;
    }
  </style>
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
    Billing
    <small>Detail Billing</small>
    </h1>
    <!--
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-files-o"></i> Main Menu</a></li>
      <li class="active">Assesment</li>
    </ol>
    -->
  </section>
  <!-- Main content -->
<?php
 
    function tglIndonesia($str){
       $tr   = trim($str);
       $str    = str_replace(array('Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'), array('Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum\'at', 'Sabtu', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'), $tr);
       return $str;
   }

   function penyebut($nilai) {
    $nilai = abs($nilai);
    $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
    $temp = "";
    if ($nilai < 12) {
      $temp = " ". $huruf[$nilai];
    } else if ($nilai <20) {
      $temp = penyebut($nilai - 10). " belas";
    } else if ($nilai < 100) {
      $temp = penyebut($nilai/10)." puluh". penyebut($nilai % 10);
    } else if ($nilai < 200) {
      $temp = " seratus" . penyebut($nilai - 100);
    } else if ($nilai < 1000) {
      $temp = penyebut($nilai/100) . " ratus" . penyebut($nilai % 100);
    } else if ($nilai < 2000) {
      $temp = " seribu" . penyebut($nilai - 1000);
    } else if ($nilai < 1000000) {
      $temp = penyebut($nilai/1000) . " ribu" . penyebut($nilai % 1000);
    } else if ($nilai < 1000000000) {
      $temp = penyebut($nilai/1000000) . " juta" . penyebut($nilai % 1000000);
    } else if ($nilai < 1000000000000) {
      $temp = penyebut($nilai/1000000000) . " milyar" . penyebut(fmod($nilai,1000000000));
    } else if ($nilai < 1000000000000000) {
      $temp = penyebut($nilai/1000000000000) . " trilyun" . penyebut(fmod($nilai,1000000000000));
    }     
    return $temp;
  }

  function terbilang($nilai) {
    if($nilai<0) {
      $hasil = "minus ". trim(penyebut($nilai));
    } else {
      $hasil = trim(penyebut($nilai));
    }         
    return $hasil;
  }
      
 ?>
 <section class="content">

      <!-- row -->
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-solid">


            <div class="box-body">
              <div class="row">
                <div class="col-md-12">
                    <div class="col-md-5">
                      {!! $calendar->calendar() !!}
                      {!! $calendar->script() !!}
                    </div>
                    <div class="col-md-7">
                      <div class="row">
                        <div class="col-md-12" style="padding: 10px 0px">
                          <h3>Data Pribadi</h3>
                          <hr>
                        </div>
                      </div>
                      @foreach ($dp as $dp)
                        <div class="row">
                          <div class="col-md-3">
                            <label for="">Nama</label>
                          </div>
                          <div class="col-md-8" style="text-transform: capitalize">
                            : {{ $dp->nama }}
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-3">
                            <label for="">TTL</label>
                          </div>
                          <div class="col-md-8" style="text-transform: capitalize">
                            : {{ $dp->tempat_lahir}}
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-3">
                            <label for="">Nama Ayah</label>
                          </div>
                          <div class="col-md-8" style="text-transform: capitalize">
                            : {{ $dp->nama_ayah}}
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-3">
                            <label for="">Nama Ibu</label>
                          </div>
                          <div class="col-md-8" style="text-transform: capitalize">
                            : {{ $dp->nama_ibu}}
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-3">
                            <label for="">Telp</label>
                          </div>
                          <div class="col-md-8" style="text-transform: capitalize">
                            : {{ $dp->tlp .' / '. $dp->tlp_ayah .' / '. $dp->tlp_ibu}}
                          </div>
                        </div>
                      @endforeach
                      <div class="row">
                        <div class="col-md-12" style="padding: 10px 0px">
                          <h3>Jadwal Terapi</h3>
                          <hr>
                        </div>
                      </div>
                      @foreach ($jadwal as $d)
                        @if($d->month == date('m', strtotime($tgl)))
                          <div class="row">
                            <div class="col-md-3">
                              <label for="">{{ tglIndonesia(date('D', strtotime($d->day))) }}</label>
                            </div>
                            <div class="col-md-8" style="text-transform: capitalize">
                              : {{ $d->id_terapi}}({{ date('H:i', strtotime($d->jam_masuk))}} - {{ date('H:i', strtotime($d->jam_keluar))}} WIB)/{{ $d->nama }}
                            </div>
                            <div class="col-md-12" style="padding: 10px 0px">
                              <hr>
                            </div>
                          </div>
                        @endif
                      @endforeach
                    </div>

                </div>
                <div class="col-md-12" style="padding-bottom: 50px">
                  <div class="col-md-12 text-center">
                    <h3>{{ tglIndonesia(date('F Y', strtotime($tgl)))}}</h3>
                  </div>
                    <table class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th>Hari, Tanggal</th>
                          <th>Keterangan</th>
                          <th>Jml Sesi</th>
                          <th>Biaya</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($data as $d)
                          <tr>
                            <td>{{ tglIndonesia(date('D, d/mY', strtotime($d->tgl))) }}</td>
                            <td>{{ $d->terapi}}</td>
                            <td>{{ $d->sesi }}</td>
                            <td>Rp. {{ number_format($d->biaya, 2) }}</td>
                          </tr>
                        @endforeach
                        <tr>
                          <td>Total</td>
                          <td></td>
                          <td>{{ count($data) }}</td>
                          <td>Rp. {{ number_format(count($data) * $bps, 2) }}</td>
                        </tr>
                        <tr>
                          <td>Perubahan</td>
                          <td>Sisa sesi bulan lalu</td>
                          <td>{{ $sisa_sesi }}</td>
                          <td>Rp. {{ number_format($sisa_sesi * $bps, 2) }}</td>
                        </tr>
                        <tr>
                          <td colspan="2"><label for="">Jumlah</label></td>
                          <td></td>
                          <td>Rp. {{ number_format($total, 2) }}</td>
                        </tr>
                        <tr>
                          <td colspan="4" style="text-align: right; text-transform:capitalize; font-weight: bold">" {{ terbilang($total)." rupiah" }} "</td>
                        </tr>
                      </tbody>
                    </table>
                    <div class="col-md-12">
                      <div class="col-md-2 col-md-offset-8">
                        <a href="{{ url('send/billing/'.$id) }}" target="_Blank" class="btn btn-success col-md-12">Send Email</a>
                      </div>
                      <div class="col-md-2">
                        <a href="{{ url('print/billing/'.$id) }}" target="_Blank" class="btn btn-primary col-md-12">Print</a>
                      </div>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

  </div>
  

    
@endsection