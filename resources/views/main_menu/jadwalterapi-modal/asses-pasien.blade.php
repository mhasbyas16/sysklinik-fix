<div role="tabpanel" class="tab-pane" id="assessment">
  <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <!-- jQuery Knob -->
          <div class="box box-solid">
            <div class="box-header">
              <i class="fa fa-bar-chart-o"></i>
              <h3 class="box-title">Tabel Request Jadwal Terapis</h3>
            </div>

            <!-- /.box-header -->
            <div class="box-body">
              <table id="pegawais" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Nama</th>
                  <th>Assesor</th>
                  <th>Status</th>
                </tr>
                </thead>
                <tbody>
                  @php
                    $no=1;
                  @endphp
                  @foreach($assessment as $asses)
                  <tr>
                    <td>{{$no}}</td>
                    <td><a href="{{url('/jadwal-terapi/asses')}}/{{$asses->id_asses}}">{{$asses->namaP}}</a></td>
                    <td>{{$asses->namaA}}</td>
                    <td><a href="{{url('/register-list')}}/{{$asses->id_pasien}}">{{$asses->status_pasien}}</a></td>
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
                  <th>Assesor</th>
                  <th>Status</th>
                </tr>
                </tfoot>
              </table>
              <div class="col-xs-3">
                <a href="{{url('/tambah_asses')}}" class="btn btn-block btn-social btn-linkedin">
                  <i class="fa fa-user-plus"></i>Tambah Assessment
                </a>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
      </div>
  </section>
</div>
