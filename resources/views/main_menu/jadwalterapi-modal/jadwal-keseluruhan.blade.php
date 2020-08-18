<!-- <div role="tabpanel" class="tab-pane active" id="home">
  <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-solid">
            <div class="box-header">
              <i class="fa fa-bar-chart-o"></i>
              <h3 class="box-title">Tabel Jadwal Keseluruhan</h3>
            </div>
            <div class="box-body">
              <table id="pegawais" class="table table-bordered table-striped text-center">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Tanggal</th>
                  <th>Jam</th>
                  <th>Terapis</th>
                  <th>Pasien</th>
                  <th>Keterangan</th>
                  <th>Aksi</th>
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
                    <td>{{$data->jam_masuk}}</td>
                    <td>{{$data->nama}}</td>
                    <td>{{$data->namaP}}</td>
                    <td>{{$data->keterangan}}</td>
                    <td>
                      <div class="inline">
                        <a class="btn btn-warning btn-sm" href="{{url('/edit_jadwal')}}/{{$data->id_jadwal}}">
                          Edit
                        </a>
                        <a class="btn btn-danger btn-sm" href="{{url('/jadwal-terapi/hapus')}}/{{$data->id_jadwal}}" onclick="return confirm('Apakah Anda Yakin Menghapus Data Ini {{$data->id_jadwal}}?')">
                          Hapus
                        </a>
                      </div>
                    </td>
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
                  <th>Keterangan</th>
                  <th>Aksi</th>
                </tr>
                </tfoot>
              </table>
              <div class="col-xs-3">
                <a href="{{url('/tambah_jadwal')}}" class="btn btn-block btn-social btn-linkedin">
                  <i class="fa fa-user-plus"></i>Tambah Jadwal
                </a>
              </div>
            </div>
          </div>
        </div>
      </div><div class="container">
      </div>
  </section>
</div> -->

<div role="tabpanel" class="tab-pane active" id="home">
  <section class="content">
        <div class="row">
          <div class="col-xs-12">
            <div class="box box-solid">
              <div style="padding-bottom: 20px; padding-top: 20px; padding-left: 10px" class="row">
                <div class="col-lg-12">
                  <a class="btn btn-success" href="{{ url('/toregist') }}">
                    Pendaftaran Baru
                  </a>
                </div>
              </div>
              <div class="box-header">
                <i class="fa fa-bar-chart-o"></i>
                <h3 class="box-title">Tabel Daftar Registrasi</h3>
              </div>
              <div class="box-body">
                <br>
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>ID Pasien</th>
                    <th>ID Asses</th>
                    <th>Status</th>
                  </tr>
                  </thead>
                  <tbody>
                    @php
                      $no=1;
                    @endphp
                    @foreach($isi as $data)
                    <tr>
                      <td>{{$no}}</td>
                      <td>{{$data->nama}}</td>
                      <td>{{$data->id_pasien}}</td>
                      <td>{{$data->id_asses}}</td>
                      <td><a href="{{url('/register-list')}}/{{$data->id_pasien}}">{{$data->status_pasien}}</a></td>
                    </tr>
                    @php
                      $no++;
                    @endphp
                    @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                      <th>No</th>
                      <th>Nama</th>
                      <th>ID Pasien</th>
                      <th>ID Asses</th>
                      <th>Status</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
            </div>
          </div>
        </div>
  </section>
</div>
