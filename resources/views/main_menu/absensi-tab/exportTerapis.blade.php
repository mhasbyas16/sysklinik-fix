<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php
    header("Content-type: application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename=Absensi_Terapis_$awal-$akhir.xls");
    ?>
    <table id="absensiTerapis" class="display text-center" style="width:100%;" >
        <thead>
          <tr>
            <th colspan="6">Absensi Terapis {{$awal}}-{{$akhir}}</th>    
          </tr>  
          <tr>
            <th>Nama</th>
            <th>Tanggal</th>
            <th>Jam Masuk</th>
            <th>Jam Keluar</th>
            <th>ID Jadwal</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($terapis as $isi)
            <tr>
              <td>{{$isi->nama}}</td>
              <td>{{$isi->tgl}}</td>
              <td>{{$isi->jam_masuk}}</td>
              <td>{{$isi->jam_keluar}}</td>
              <td>{{$isi->id_jadwal}}</td>
              <td>{{$isi->status_terapis}}</td>
            </tr>
          @endforeach
          <tr>
            <th colspan="6">Total Absensi Terapis</th>
          </tr>
          @foreach($sumTerapis as $totalP)
          <tr>
            <td>{{$totalP->id_pegawai}}</td>
            <td>{{$totalP->nama}}</td>
            <td>{{$totalP->total}}</td>
            <td style="display:hidden;"></td>
            <td style="display:hidden;"></td>
            <td style="display:hidden;"></td>
          </tr>
          @endforeach
        </tbody>
        <tfoot>
          <tr>
            <th>Nama</th>
            <th>Tanggal</th>
            <th>Jam Masuk</th>
            <th>Jam Keluar</th>
            <th>ID Jadwal</th>
            <th>Status</th>
          </tr>
        </tfoot>
    </div>
  </table>
  </body>
</html>
