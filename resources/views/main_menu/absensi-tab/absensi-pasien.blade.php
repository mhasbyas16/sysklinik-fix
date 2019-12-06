<!-- Tab panes -->
<div class="tab-content">
  <div role="tabpanel" class="tab-pane {{Request::is('absensi','absensi/pasien')?'active':''}}" id="pasien">
    <section class="content">
        <div class="row">
          <div class="col-xs-12">
            <!-- jQuery Knob -->
            <div class="box box-solid">
              <div class="box-header">
                <i class="fa fa-bar-chart-o"></i>
                <h3 class="box-title">Tabel Presensi Pasien</h3>
              </div>

              <!-- /.box-header -->
              <div class="box-body">
                <form method="post" action="{{url('/absensi/pasien')}}">
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
                <table id="absensiPasien" class="display text-center" style="width:100%;" >
                  <thead>
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
                <a href="{{url('/absensi/export')}}/{{$Dawal}}/{{$Dakhir}}/pasien"><button type="button" class="btn btn-success">
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
      $('#absensiPasien').DataTable({
        select:true
      });
  });
  </script>