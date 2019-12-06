<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php
    header("Content-type: application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename=Absensi_Karyawan_$awal-$akhir.xls");
    ?>
    <table class="display text-center" style="width:100%;" >
            <thead>
                <tr>
                    <th colspan="7">Absensi Karyawan {{$awal}}-{{$akhir}}</th>    
                </tr>
              <tr>
                <th>Nama</th>
                <th>Tanggal</th>
                <th>Jam Masuk</th>
                <th>Lokasi Masuk</th>
                <th>Jam Keluar</th>
                <th>Lokasi Keluar</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($karyawan as $isi)
              @if ($isi->status_hadir=="hadir" OR $isi->status_hadir=="telat" )
              <tr>
                  <td>{{$isi->nama}}</td>
                  <td>{{$isi->tgl}}</td>
                  <td>{{$isi->jam_masuk}}</td>
                  <td>{{$isi->lokasi_masuk}}</td>
                  <td>{{$isi->jam_keluar}}</td>
                  <td>{{$isi->lokasi_keluar}}</td>
                  <td>{{$isi->status_hadir}}</td>
              </tr>  
              @endif                      
              @endforeach
            </tbody>
        </div>
      </table>
      <br><br><br><br><br>
      <table class="display text-center" style="width:100%;" >
            <thead>
                <tr>
                    <th colspan="3">Total Absensi Karyawan</th>    
                </tr>
              <tr>
                <th>ID Pegawai</th>
                <th>Nama</th>
                <th>total</th>
              </tr>
            </thead>
            <tbody> 
                    <tr>
                        <th colspan="3">Total Hadir Karyawan</th>    
                    </tr>
                    @foreach ($sumKaryawanH as $totalKH)
                    <tr>
                        <td>{{$totalKH->id_pegawai}}</td>
                        <td>{{$totalKH->nama}}</td>
                        <td>{{$totalKH->total}}</td>
                    </tr>
                    @endforeach
                    <tr>
                        <th colspan="3">Total Terlambat Karyawan</th>    
                    </tr>
                    @foreach ($sumKaryawanT as $totalKT)
                    <tr>
                        <td>{{$totalKT->id_pegawai}}</td>
                        <td>{{$totalKT->nama}}</td>
                        <td>{{$totalKT->total}}</td>
                    </tr>
                    @endforeach
            </tbody>
      </table>
  </body>
</html>
