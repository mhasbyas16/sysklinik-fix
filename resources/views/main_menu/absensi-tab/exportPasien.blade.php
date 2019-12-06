<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php
    header("Content-type: application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename=Absensi_Pasien_$awal-$akhir.xls");
    ?>
    <table class="display text-center" style="width:100%;display:none;" >
      <thead>
          <tr>
              <th colspan="6">Absensi Pasien {{$awal}}-{{$akhir}}</th>    
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
        @foreach ($pasien as $isi)
          <tr>
            <td>{{$isi->nama}}</td>
            <td>{{$isi->tgl}}</td>
            <td>{{$isi->jam_masuk}}</td>
            <td>{{$isi->jam_keluar}}</td>
            <td>{{$isi->id_jadwal}}</td>
            <td>{{$isi->status_pasien}}</td>
          </tr>
        @endforeach
        <tr>
          <th colspan="6">Total Absensi Pasien</th>
        </tr>
        @foreach($sumPasien as $totalP)
        <tr>
          <td>{{$totalP->id_pasien}}</td>
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
