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
                  <th>No</th>
                  <th>Tanggal</th>
                  <th>Jam</th>
                  <th>Terapis</th>
                  <th>Pasien</th>
                  <th>Jenis Terapi</th>
                  <th>Keterangan</th>
                </tr>
                </thead>
                <tbody>
                  @php
                    $no=1;
                  @endphp
                  @foreach($data2 as $data)
                  <tr>
                    <td>{{$no}}</td>
                    <td>{{$data->tgl}}</td>
                    <td>{{$data->jam_masuk}} - {{$data->jam_keluar}}</td>
                    <td>{{$data->nama}}</td>
                    <td>{{$data->namaP}}</td>
                    <td>{{$data->id_terapi}}</td>
                    <td>{{$data->keterangan}}</td>
                  </tr>
                  @php
                    $no++;
                  @endphp
                  @endforeach
                </tbody>
                <tfoot>
                <tr>
                  <th>No</th>
                  <th>Tanggal</th>
                  <th>Jam</th>
                  <th>Terapis</th>
                  <th>Pasien</th>
                  <th>Jenis Terapi</th>
                  <th>Keterangan</th>
                </tr>
                </tfoot>
              </table>
              <div class="col-xs-3">
                <a href="{{url('/tambah_jadwal')}}" class="btn btn-block btn-social btn-linkedin">
                  <i class="fa fa-user-plus"></i>Tambah Jadwal
                </a>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
      </div><div class="container">
      </div>
  </section>
</div>
