@extends('template.style')
@section('isi')
@include('sweet::alert')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
    Keuangan
    <small>Transaksi Keuangan</small>
    </h1>
    <!--
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-files-o"></i> Main Menu</a></li>
      <li class="active">Assesment</li>
    </ol>
    -->
  </section>
  <!-- Main content -->
  <div class="container">
    <div>
      <br>
      <!-- Nav tabs -->
      <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active">
          <a href="#home" aria-controls="home" role="tab" data-toggle="tab">Pemasukan</a>
        </li>
        <li role="presentation">
          <a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Pengeluaran</a>
        </li>
      </ul>
      <!-- Tab panes -->
      <div class="tab-content col-md-12">
        <div role="tabpanel" class="tab-pane active" id="home">
          <section class="content">
            <!-- row -->
            <div class="row">
              <div class="col-xs-12">
                <!-- jQuery Knob -->
                <div class="box box-solid">
                  <!-- begin data alat-->
                  <form class="form-horizontal" action="{{ url('/transaksi_keuangan') }}" method="post">
                    @csrf
                    <input type="hidden" name="formName" value="pemasukan">
                    <div class="box-body">
                      <div class="row">
                        <div class="col-xs-7 col-md-12 text-left">
                          <div class="form-group">
                            <label class="col-sm-12"><h3>Input Transaksi Pemasukan</h3><hr></label>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-xs-7 col-md-8 text-center">
                          <div class="form-group">
                            <label class="col-sm-4 control-label" style="text-align: left; padding-left: 40pt">Penanggung Jawab</label>
                            <div class="col-sm-7">
                              <select name="id_karyawan" class="form-control" required>
                                @foreach($karyawan as $krywn)
                                    <option value="{{ $krywn->id_pegawai }}">{{ $krywn->nama }}</option>
                                @endforeach
                              </select>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-xs-7 col-md-8 text-center">
                          <div class="form-group">
                            <label class="col-sm-4 control-label" style="text-align: left; padding-left: 40pt">Kategori</label>
                            <div class="col-sm-7">
                              <select name="kategori" class="form-control" required="">
                                @foreach($kategori_pemasukan as $kategori)
                                    <option value="{{ $kategori }}">{{ $kategori }}</option>
                                @endforeach
                              </select>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-xs-7 col-md-8 text-center">
                          <div class="form-group">
                            <label class="col-sm-4 control-label" style="text-align: left; padding-left: 40pt">Tanggal</label>
                            <div class="col-sm-7">
                              <input type="text" class="form-control tanggal" name="tanggal" required>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-xs-7 col-md-8 text-center">
                          <div class="form-group">
                            <label class="col-sm-4 control-label" style="text-align: left; padding-left: 40pt">Jumlah</label>
                            <div class="col-sm-7">
                              <div class="input-group">
                                <span class="input-group-addon" id="basic-addon1">RP.</span>
                                <input type="text" class="form-control uang" placeholder="Jumlah" aria-describedby="basic-addon1" name="jumlah" required="">
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-xs-7 col-md-8 text-center">
                          <div class="form-group">
                            <label class="col-sm-4 control-label" style="text-align: left; padding-left: 40pt">Keterangan</label>
                            <div class="col-sm-7">
                              <textarea name="keterangan" id="keterangan" class="form-control" cols="30" rows="10" required=""></textarea>
                            </div>
                          </div>
                        </div>
                      </div>
                      
                      <div class="button">
                        <ul class="left" style="padding-left: 390pt ">
                          <button class="btn btn-success" href="#">Simpan</button>
                          <a class="btn btn-secondary" href="#" onclick="goBack()">Batal</a>
                        </ul>
                      </div>
                    </div>
                  </form>
                  <!-- /.box-body -->
                </div>
                <!-- /.box -->
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
            <!-- row -->
            <div class="row">
              <div class="col-xs-12">
                <!-- jQuery Knob -->
                <div class="box box-solid">
                  <div class="box-header">
                    <i class="fa fa-bar-chart-o"></i>
                    <h3 class="box-title">Tabel Record Transaksi Pemasukan</h3>
                  </div>
                  
                  <!-- /.box-header -->
                  <div class="box-body">
                    <table id="pegawais" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th>Penanggung Jawab</th>
                          <th>Kategori</th>
                          <th>Jumlah</th>
                          <th>Keterangan</th>
                          <th>Tanggal</th>
                          <th>Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($pemasukan_list as $p)
                          <tr>
                            <td>{{ $p->nama }}</td>
                            <td>{{ $p->kategori }}</td>
                            <td>{{ $p->jumlah }}</td>
                            <td>{{ $p->keterangan }}</td>
                            <td>{{ $p->tgl }}</td>
                            <td>
                              <form action="{{ url('transaksi_keuangan/'.$p->id_income) }}" method="POST" style="padding:0px; margin:0px" class="col-md-3">
                                  @method('DELETE')
                                  @csrf
                                  <input type="submit" style="padding:0px; margin:0px; border: 0px; background: none" value="Hapus" class="btn btn-danger btn-delete">
                              </form>
                            </td>
                          </tr>
                        @endforeach
                      </tbody>
                      <tfoot>
                      <tr>
                        <th>Penanggung Jawab</th>
                        <th>Kategori</th>
                        <th>Jumlah</th>
                        <th>Keterangan</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
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
        <div role="tabpanel" class="tab-pane" id="profile">
          <section class="content">
            <!-- row -->
            <div class="row">
              <div class="col-xs-12">
                <!-- jQuery Knob -->
                <div class="box box-solid">
                  <!-- begin data alat-->
                  <form class="form-horizontal" method="post" action="{{ url('/transaksi_keuangan') }}">
                    @csrf
                    <input type="hidden" name="formName" value="pengeluaran">
                    <div class="box-body">
                      <div class="row">
                        <div class="col-xs-7 col-md-12 text-left">
                          <div class="form-group">
                            <label class="col-sm-12"><h3>Input Transaksi Pengeluaran</h3><hr></label>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-xs-7 col-md-8 text-center">
                          <div class="form-group">
                            <label class="col-sm-4 control-label" style="text-align: left; padding-left: 40pt">Penanggung Jawab</label>
                            <div class="col-sm-7">
                              <select name="id_karyawan" class="form-control" required="">
                                @foreach($karyawan as $krywn)
                                    <option value="{{ $krywn->id_pegawai }}">{{ $krywn->nama }}</option>
                                @endforeach
                              </select>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-xs-7 col-md-8 text-center">
                          <div class="form-group">
                            <label class="col-sm-4 control-label" style="text-align: left; padding-left: 40pt">Kategori</label>
                            <div class="col-sm-7">
                              <select name="kategori" class="form-control" required="">
                                @foreach($kategori_pengeluaran as $kategori)
                                    <option value="{{ $kategori }}">{{ $kategori }}</option>
                                @endforeach
                              </select>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-xs-7 col-md-8 text-center">
                          <div class="form-group">
                            <label class="col-sm-4 control-label" style="text-align: left; padding-left: 40pt">Tanggal</label>
                            <div class="col-sm-7">
                              <input type="text" class="form-control tanggal" name="tanggal" required>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-xs-7 col-md-8 text-center">
                          <div class="form-group">
                            <label class="col-sm-4 control-label" style="text-align: left; padding-left: 40pt">Jumlah</label>
                            <div class="col-sm-7">
                              <div class="input-group">
                                <span class="input-group-addon" id="basic-addon1">RP.</span>
                                <input type="text" class="form-control uang" placeholder="Jumlah" aria-describedby="basic-addon1" name="jumlah" required="">
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-xs-7 col-md-8 text-center">
                          <div class="form-group">
                            <label class="col-sm-4 control-label" style="text-align: left; padding-left: 40pt">Keterangan</label>
                            <div class="col-sm-7">
                              <textarea name="keterangan" id="keterangan" class="form-control" cols="30" rows="10"></textarea>
                            </div>
                          </div>
                        </div>
                      </div>
                      
                      <div class="button">
                        <ul class="left" style="padding-left: 390pt ">
                          <button class="btn btn-success" href="#">Simpan</button>
                          <a class="btn btn-secondary" href="#" onclick="goBack()">Batal</a>
                        </ul>
                      </div>
                    </div>
                  </form>
                  <!-- /.box-body -->
                </div>
                <!-- /.box -->
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
            <!-- row -->
            <div class="row">
              <div class="col-xs-12">
                <!-- jQuery Knob -->
                <div class="box box-solid">
                  <div class="box-header">
                    <i class="fa fa-bar-chart-o"></i>
                    <h3 class="box-title">Tabel Record Transaksi Pengeluaran</h3>
                  </div>
                  
                  <!-- /.box-header -->
                  <div class="box-body">
                    <table id="pegawais" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th>Penanggung Jawab</th>
                          <th>Kategori</th>
                          <th>Jumlah</th>
                          <th>Keterangan</th>
                          <th>Tanggal</th>
                          <th>Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($pengeluaran_list as $p)
                          <tr>
                            <td>{{ $p->nama }}</td>
                            <td>{{ $p->kategori }}</td>
                            <td>{{ $p->jumlah }}</td>
                            <td>{{ $p->keterangan }}</td>
                            <td>{{ $p->tgl }}</td>
                            <td>
                              <form action="{{ url('transaksi_keuangan/'.$p->id_outcome) }}" id="transaksi_keuangan" method="POST" style="padding:0px; margin:0px" class="col-md-3">
                                  @method('DELETE')
                                  @csrf
                                  <input type="submit" value="Hapus" class="btn btn-delete btn-danger">
                              </form>
                            </td>
                          </tr>
                        @endforeach
                      </tbody>
                      <tfoot>
                      <tr>
                        <th>Penanggung Jawab</th>
                        <th>Kategori</th>
                        <th>Jumlah</th>
                        <th>Keterangan</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
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
      </div>
      <!-- End Nav tabs -->
    </div>
  </div>
  <!-- /.content -->
</div>

<script>
  $('.btn-delete').click(function(e) {
        return confirm("Are you sure?");
});
  
function goBack() {
  window.history.back();
}
</script>
</script>
@endsection