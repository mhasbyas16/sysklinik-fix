<div role="tabpanel" class="tab-pane active" id="home">
  <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <!-- jQuery Knob -->
          <div class="box box-solid">
            <div class="box-header">
              <i class="fa fa-bar-chart-o"></i>
              <h3 class="box-title">Tabel Jadwal Keseluruhan</h3>
            </div>

            <!-- /.box-header -->
            <div class="box-body">
              <table id="pegawais" class="table table-bordered table-striped text-center">
                <thead>
                <tr>
                  <th>Jam</th>
                  <th>Terapis</th>
                  <th>Pasien</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                  @foreach($data2 as $data)
                  <tr>
                    <td>{{$data->jam_masuk}} - {{$data->jam_keluar}}</td>
                    <td>{{$data->nama}}</td>
                    <td>{{$data->namaP}}</td>
                    <td>jml sesi</td>
                  </tr>
                  @endforeach
                </tbody>
                <tfoot>
                <tr>
                  <th>Jam</th>
                  <th>Terapis</th>
                  <th>Pasien</th>
                  <th>Action</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
      </div><div class="container">
      </div>
  </section>
</div>
