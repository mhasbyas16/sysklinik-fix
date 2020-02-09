<div role="tabpanel" class="tab-pane {{Request::is('absensi/karyawan')?'active':''}}" id="karyawan">
    <section class="content">
        <div class="row">
          <div class="col-xs-12">
            <!-- jQuery Knob -->
            <div class="box box-solid">
              <div class="box-header">
                <i class="fa fa-bar-chart-o"></i>
                <h3 class="box-title">Tabel Presensi Karyawan</h3>
              </div>

              <!-- /.box-header -->
              <div class="box-body">
                <form method="post" action="{{url('/absensi/karyawan')}}">
                  {{csrf_field()}}
                <table border="0" cellspacing="5" cellpadding="5">
                  <tbody><tr>
                    <td>Dari</td>
                    <td>:</td>
                    <td><div class="input-group date">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                          <input type="date" class="form-control" name="min">
                        </div>
                    </td>
                    <td>-</td>
                    <td><div class="input-group date">
                        <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                        </div>
                        <input type="date" class="form-control" name="max">
                    </div>
                  </td>
                  <td>&nbsp;&nbsp;&nbsp;</td>
                  <td><button type="submit" class="btn btn-information"><i class="fa fa-search"></i></button></td>
                  </form>
                  <td>&nbsp;&nbsp;&nbsp;</td>
                  <td><a href="{{url('/absensi')}}"><button type="button" class="btn btn-success">Clear</button></a></td>
                  </tr>
                  <tr>
                  </tr>
                </tbody></table>
                <br>
                <table id="absen3" class="display text-center" style="width:100%;" >
                  <thead>
                    <tr>
                      <th>No</th>
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
                    @php
                      $no=1;
                    @endphp
                    @foreach ($karyawan as $isi)
                    @if ($isi->status_hadir=="hadir" OR $isi->status_hadir=="telat" )
                    <tr>
                        <td>{{$no}}</td>
                        <td>{{$isi->nama}}</td>
                        <td>{{$isi->tgl}}</td>
                        <td>{{$isi->jam_masuk}}</td>
                        <td>{{$isi->lokasi_masuk}}</td>
                        <td>{{$isi->jam_keluar}}</td>
                        <td>{{$isi->lokasi_keluar}}</td>
                        <td>@if ($isi->status_hadir=="hadir")
                                <span class="badge bg-green">Hadir</span>
                            @else
                                <span class="badge bg-red">Telat</span>
                            @endif
                        </td>
                    </tr>  
                    @endif                      
                    @php
                      $no++;
                    @endphp
                    @endforeach
                  </tbody>
                  <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Tanggal</th>
                        <th>Jam Masuk</th>
                        <th>Lokasi Masuk</th>
                        <th>Jam Keluar</th>
                        <th>Lokasi Keluar</th>
                        <th>Status</th>
                    </tr>
                  </tfoot>
              </div>
            </table>
                <a href="{{url('/absensi/export')}}/{{$Dawal}}/{{$Dakhir}}/karyawan"><button type="button" class="btn btn-success">
                    Export Data
                  </button></a>
              </div>
              <!-- /.box-body -->
            </div>
          </div>
        </div>
    </section>
  </div>
  <script type="text/javascript">
  $(document).ready(function() {
      $('#absensiKaryawan').DataTable({
        select:true
      });
  });
  </script>
</div>