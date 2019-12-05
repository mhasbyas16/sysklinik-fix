<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title></title>
  <link rel="stylesheet" href="">
</head>
<body style="width:1000px; margin:0px 50px 0px 50px" onload="window.print()">
  <link rel="stylesheet" href="{{asset('AdminLTE/bower_components/fullcalendar/dist/fc.css')}}"/>
  
  <script src='http://fullcalendar.io/js/fullcalendar-2.1.1/lib/moment.min.js'></script>
  <script src='http://fullcalendar.io/js/fullcalendar-2.1.1/lib/jquery.min.js'></script>
  <script src="http://fullcalendar.io/js/fullcalendar-2.1.1/lib/jquery-ui.custom.min.js"></script>
  <script src='http://fullcalendar.io/js/fullcalendar-2.1.1/fullcalendar.min.js'></script>

  <!-- jQuery UI 1.11.4 -->
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->

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

    <style>
      .content-wrapper{
        background: white;
        min-height: -61px;
      }

      .fc-toolbar .fc-header-toolbar{
        margin-bottom: 0em;
      }

      h4{
        margin: 3px 0px;
      }

      hr{
        color: black;
        background: black
      }

    </style>
    



    <table width="100%" style="padding-left: 0%">
      <tr>
        <td colspan="2" style="border-bottom-width: 5px; border-bottom-style: double; border-bottom-color: black;">
          <table cellspacing="0" cellpadding="0" width="100%">
            <tr>
              <td width="25%">
                <img src="{{ asset('/foto/logo_liliput_edit.png') }}" alt="Logo">
              </td>
              <td width="75%">
                <table cellspacing="0" cellpadding="0">
                  <tr>
                    <td style="font-weight: bold; font-size: 24pt">
                      Liliput
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <i style="font-size: 14pt">Helping hands in your child’s development</i>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      Jl. Cipete IV No. 6 Jakarta Selatan
                    </td>
                  </tr>
                  <tr>
                    <td>
                      Telp. (+62-21) 7581 6662/ 32692552
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>
        </td>
      </tr>
      <tr>
        <td colspan="2" align="center" style="border-bottom: 2px solid black">
          <h1>Billing</h1>
        </td>
      </tr>
      <tr>
        <td rowspan="2" width="41%">
          {!! $clndr->calendar() !!}
          {!! $clndr->script() !!}
        </td>
        <td width="59%" style="padding-left:3%; vertical-align: top">
          <table width="100%">
              <tr>
                <td colspan="2" style="border-bottom: solid 1px black; padding-bottom: 1%">
                  <h3>Data Pribadi</h3>
                </td>
              </tr>
            @foreach ($dp as $dp)
              <tr>
                <td style="padding-top: 1%;; padding-left:3%" width="25%">
                  Nama
                </td>
                <td style="padding-top: 1%">
                  : {{ $dp->nama }}
                </td>
              </tr>
              <tr>
                <td style="padding-top: 1%;; padding-left:3%" width="25%">
                  TTl
                </td>
                <td style="padding-top: 1%">
                  : {{ $dp->tempat_lahir}}
                </td>
              </tr>
              <tr>
                <td style="padding-top: 1%;; padding-left:3%" width="25%">
                  Nama Ayah
                </td>
                <td style="padding-top: 1%">
                  : {{ $dp->nama_ayah}}
                </td>
              </tr>
              <tr>
                <td style="padding-top: 1%;; padding-left:3%" width="25%">
                  Nama Ibu
                </td>
                <td style="padding-top: 1%">
                  : {{ $dp->nama_ibu}}
                </td>
              </tr>
              <tr>
                <td style="padding-top: 1%;; padding-left:3%" width="25%">
                  Telp.
                </td>
                <td style="padding-top: 1%">
                  : {{ $dp->tlp .' / '. $dp->tlp_ayah .' / '. $dp->tlp_ibu}}
                </td>
              </tr>
            @endforeach
          </table>
        </td>
      </tr>
      <tr valign="top">
        <td width="72%" style="padding-left:3%; vertical-align: top">
          <table width="100%" valign="top">
            <tr valign="top">
              <td colspan="2" style="border-bottom: solid 1px black;">
                <h3>Jadwal Terapi</h3>
              </td>
            </tr>
            @foreach ($jadwal as $d)
              @if($d->month == date('m', strtotime($tgl)))
                <tr>
                  <td style="padding-top: 1%; padding-left:3%" width="25%">
                    {{ tglIndonesia(date('D', strtotime($d->day))) }}
                  </td>
                  <td style="padding-top: 1%">
                    : {{ $d->id_terapi}}({{ date('H:i', strtotime($d->jam_masuk))}} - {{ date('H:i', strtotime($d->jam_keluar))}} WIB)/{{ $d->nama }}
                  </td>
                </tr>
              @endif
            @endforeach
          </table>
        </td>
      </tr>
    </table>


    <table width="100%" style="padding-top: 2%" align="center">
      <tr>
        <td align="center">
          <h3>{{ tglIndonesia(date('F Y', strtotime($tgl)))}}</h3>
        </td>
      </tr>
      <tr>
        <td>
          <table class="table table-bordered table-striped" width="95%">
            <thead>
              <tr>
                <th width="15%" align="left">Hari, Tanggal</th>
                <th width="45%" align="left">Keterangan</th>
                <th width="10%" align="center">Jml Sesi</th>
                <th width="10%" align="right" colspan="2">Biaya</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($data as $d)
                <tr>
                  <td>{{ tglIndonesia(date('D, d/m/Y', strtotime($d->tgl))) }}</td>
                  <td>{{ $d->terapi}}</td>
                  <td align="center">{{ $d->sesi }}</td>
                  <td width="15px">Rp. </td>
                  <td align="right">{{ number_format($d->biaya, 2) }}</td>
                </tr>
              @endforeach
              <tr>
                <td>Total</td>
                <td></td>
                <td align="center">{{ count($data) }}</td>
                <td width="15px">Rp. </td>
                <td align="right">{{ number_format(count($data) * $bps, 2) }}</td>
              </tr>
              <tr valign="top">
                <td rowspan="5">Perubahan</td>
                <td>Sisa sesi bulan lalu</td>
                <td align="center">{{ $sisa_sesi }}</td>
                <td width="15px">Rp. </td>
                <td align="right">{{ number_format($ttl_sisaSesi, 2) }}</td>
              </tr>
              <tr>
                <td>Uang Pangkal</td>
                <td align="center">&nbsp;</td>
                <td width="15px">Rp. </td>
                <td align="right">{{ number_format($uang_pangkal, 2) }}</td>
              </tr>
              <tr>
                <td>Assessment</td>
                <td align="center">&nbsp;</td>
                <td width="15px">Rp. </td>
                <td align="right">{{ number_format($assessment, 2) }}</td>
              </tr>
              <tr>
                <td>Evaluasi</td>
                <td align="center">&nbsp;</td>
                <td width="15px">Rp. </td>
                <td align="right">{{ number_format($evaluasi, 2) }}</td>
              </tr>
              <tr>
                <td>Denda</td>
                <td align="center">&nbsp;</td>
                <td width="15px">Rp. </td>
                <td align="right">{{ number_format($denda, 2) }}</td>
              </tr>
              <tr>
                <td colspan="2"><label for="">Jumlah</label></td>
                <td></td>
                <td width="15px">Rp. </td>
                <td align="right">{{ number_format($total, 2) }}</td>
              </tr>
              <tr>
                <td colspan="5" style="text-align: right; text-transform:capitalize; font-weight: bold">
                  "
                    @if ($total == 0)
                      Lunas
                    @else
                      {{ terbilang($total)." rupiah" }}
                    @endif 
                  "
                </td>
              </tr>
            </tbody>
          </table>
        </td>
      </tr>
    </table>


  <script src="{{asset('AdminLTE/bower_components/moment/min/moment.min.js')}}"></script>
  <script src="{{asset('AdminLTE/bower_components/jquery/dist/jquery.min.js')}}"></script>
  <script src="{{asset('AdminLTE/bower_components/jquery-ui/jquery-ui.min.js')}}"></script>
  <script src="{{asset('AdminLTE/bower_components/fullcalendar/dist/fullcalendar.min.js')}}"></script>
  <script src="{{asset('AdminLTE/bower_components/fullcalendar/dist/locale/id.js')}}" type="text/javascript"></script>

</body>
</html>


    