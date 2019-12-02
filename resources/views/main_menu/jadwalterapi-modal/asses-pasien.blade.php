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
                  <th>Nama</th>
                  <th>Assesor</th>
                  <th>Status</th>
                </tr>
                </thead>
                <tbody>
                  @foreach($assessment as $asses)
                  <tr>
                    <td><a href="{{url('/jadwal-terapi/asses')}}/{{$asses->id_asses}}">{{$asses->namaP}}</a></td>
                    <td>{{$asses->namaA}}</td>
                    <td>{{$asses->status_pasien}}</td>
                  </tr>
                  @endforeach
                </tbody>
                <tfoot>
                <tr>
                  <th>Nama</th>
                  <th>Assesor</th>
                  <th>Status</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
      </div>
  </section>
</div>
