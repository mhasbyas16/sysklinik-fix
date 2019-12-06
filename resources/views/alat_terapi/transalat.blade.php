@extends('template.style')
@section('isi')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Alat Terapi
        <small>Transaksi Alat Terapi</small>
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
          <a href="#masuk" aria-controls="Masuk" role="tab" data-toggle="tab">Alat Masuk</a>
        </li>
        <li role="presentation">
          <a href="#keluar" aria-controls="keluar" role="tab" data-toggle="tab">Alat Keluar</a>
        </li>
      </ul>

      <!-- Tab panes -->
      <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="masuk">
          <!-- Main content -->
          <section class="content">

            <!-- row -->
            <div class="row">
              <div class="col-xs-12">
                <!-- jQuery Knob -->
                <div class="box box-solid">

                  <!-- begin data alat-->
                  @if(ISSET($idat))
                    @foreach($idat as $id)
                      <form class="form-horizontal" action="{{url('transalat/'.$id->id_barang)}}" method="post" name="formName">
                        @csrf
                        @method("PATCH")
                        <div class="box-body">
                          <div class="row">
                            <div class="col-xs-7 col-md-12 text-left">
                                <div class="form-group">
                                  <label class="col-sm-12"><h3>Input Transaksi Almasukan Terapi Masuk</h3><hr></label>
                                </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-xs-7 col-md-8 text-center">
                                <div class="form-group">
                                  <label class="col-sm-4 control-label" style="text-align: left; padding-left: 40pt">Tanggal</label>

                                  <div class="col-sm-3">
                                    <input type="date" name="tglat" id="datepicker" class="input-tanggal" required value="{{$id->tgl}}">
                                  </div>
                                </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-xs-7 col-md-8 text-center">
                                <div class="form-group">
                                  <label class="col-sm-4 control-label" style="text-align: left; padding-left: 40pt">No. Kwitansi</label>

                                  <div class="col-sm-7">
                                      <input type="text" class="form-control" name="noat" value="{{$id->no_kwitansi}}">
                                  </div>
                                </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-xs-7 col-md-8 text-center">
                                <div class="form-group">
                                  <label class="col-sm-4 control-label" style="text-align: left; padding-left: 40pt">ID Barang</label>

                                  <div class="col-sm-7">
                                    <select class="form-control select2" name="idat">
                                      <option selected hidden disabled>Jenis Terapi</option>
                                      @foreach($alll as $idnyaat)
                                      <option value="{{$idnyaat->id_barang}}">{{$idnyaat->id_barang}}</option>
                                      @endforeach
                                    </select>
                                  </div>
                                </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-xs-7 col-md-8 text-center">
                                <div class="form-group">
                                  <label class="col-sm-4 control-label" style="text-align: left; padding-left: 40pt">Jumlah Barang</label>

                                  <div class="col-sm-7">
                                      <input type="text" class="form-control" name="jmlat" value="{{$id->jml_barang}}">
                                  </div>
                                </div>
                            </div>
                          </div>              
                          
                          <div class="button">
                            <ul class="left" style="padding-left: 385pt ">
                              <button class="btn btn-success" href="#">Simpan</button>
                              <button class="btn btn-secondary" href="#">Batal</button>
                            </ul>
                          </div>
                        </div>
                      </form>
                      @endforeach
                  @else
                  <form class="form-horizontal" action="{{url('transalat')}}" method="post" name="formName">
                    @csrf
                    <input type="hidden" name="formName" value="masukan">
                    <div class="box-body">
                      <div class="row">
                        <div class="col-xs-7 col-md-12 text-left">
                            <div class="form-group">
                              <label class="col-sm-12"><h3>Input Transaksi Alat Terapi Masuk</h3><hr></label>
                            </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-xs-7 col-md-8 text-center">
                            <div class="form-group">
                              <label class="col-sm-4 control-label" style="text-align: left; padding-left: 40pt">Tanggal</label>

                              <div class="col-sm-3">
                                <input type="date" name="tglat" id="datepicker" class="input-tanggal" required>
                              </div>
                            </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-xs-7 col-md-8 text-center">
                            <div class="form-group">
                              <label class="col-sm-4 control-label" style="text-align: left; padding-left: 40pt">No. Kwitansi</label>

                              <div class="col-sm-7">
                                  <input type="text" class="form-control" name="noat">
                              </div>
                            </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-xs-7 col-md-8 text-center">
                            <div class="form-group">
                              <label class="col-sm-4 control-label" style="text-align: left; padding-left: 40pt">ID Barang</label>

                              <div class="col-sm-7">
                                <select class="form-control select2" name="idat">
                                  <option selected hidden disabled>Cari ID Barang</option>
                                  @foreach($alll as $idnyaat)
                                  <option value="{{$idnyaat->id_barang}}">{{$idnyaat->id_barang}}</option>
                                  @endforeach
                                </select>
                              </div>
                            </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-xs-7 col-md-8 text-center">
                            <div class="form-group">
                              <label class="col-sm-4 control-label" style="text-align: left; padding-left: 40pt">Jumlah Barang</label>

                              <div class="col-sm-7">
                                  <input type="text" class="form-control" name="jmlat">
                              </div>
                            </div>
                        </div>
                      </div>              
                      
                      <div class="button">
                        <ul class="left" style="padding-left: 385pt ">
                          <button class="btn btn-success" href="#">Simpan</button>
                          <button class="btn btn-secondary" href="#">Batal</button>
                        </ul>
                      </div>
                    </div>
                  </form>
                  @endif
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
                    <h3 class="box-title">Tabel Record Transaksi Alat Terapi Masuk</h3>
                  </div>
                  
                  <div class="box-body">
                    <table id="pegawais" class="table table-bordered table-striped text-center">
                      <thead>
                      <tr>
                        <th>Tanggal</th>
                        <th>No. Kwitansi</th>
                        <th>ID Barang</th>
                        <th>Jumlah Barang</th>
                        <th>Aksi</th>

                      </tr>
                      </thead>
                      <tbody>
                        @foreach($at as $x)
                      <tr>
                        <td>{{$x->tgl}}</td>
                        <td>{{$x->no_kwitansi}}</td>
                        <td>{{$x->id_barang}}</td>
                        <td>{{$x->jml_barang}}</td>
                        <td>
                          <form action="{{ url('transalat', $x->id_barang) }}" method="post">
                              @csrf
                              @method("DELETE")
                              <input type="submit" class="btn btn-danger btn-sm" href="{{ $x->id_barang }}" value="Delete">
                          </form>
                        </td>
                      </tr>
                      @endforeach
                      </tbody>
                      <tfoot>
                      <tr>
                        <th>Tanggal</th>
                        <th>No. Kwitansi</th>
                        <th>ID Barang</th>
                        <th>Jumlah Barang</th>
                        <th>Aksi</th>
                      </tr>
                      </tfoot>
                    </table>
                  </div>
                  <!-- /.box-body -->
                </div>
              </div>
            </div>
            <!-- /.row -->
          </section>
          <!-- /.content -->
        </div>

        <div role="tabpanel" class="tab-pane" id="keluar">
          <!-- Main content -->
          <section class="content">

            <!-- row -->
            <div class="row">
              <div class="col-xs-12">
                <!-- jQuery Knob -->
                <div class="box box-solid">

                  <!-- begin data alat-->
                  @if(ISSET($idat))
                    @foreach($idat as $id)
                      <form class="form-horizontal" action="{{url('transalat/'.$id->id_barang)}}" method="post" name="formName">
                        @csrf
                        @method("PATCH")
                        <div class="box-body">
                          <div class="row">
                            <div class="col-xs-7 col-md-12 text-left">
                                <div class="form-group">
                                  <label class="col-sm-12"><h3>Input Transaksi Alat Terapi Keluar</h3><hr></label>
                                </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-xs-7 col-md-8 text-center">
                                <div class="form-group">
                                  <label class="col-sm-4 control-label" style="text-align: left; padding-left: 40pt">Tanggal</label>

                                  <div class="col-sm-3">
                                    <input type="date" name="tglat" id="datepicker" class="input-tanggal" required value="{{$id->tgl}}">
                                  </div>
                                </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-xs-7 col-md-8 text-center">
                                <div class="form-group">
                                  <label class="col-sm-4 control-label" style="text-align: left; padding-left: 40pt">No. Kwitansi</label>

                                  <div class="col-sm-7">
                                      <input type="text" class="form-control" name="noat" value="{{$id->no_kwitansi}}">
                                  </div>
                                </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-xs-7 col-md-8 text-center">
                                <div class="form-group">
                                  <label class="col-sm-4 control-label" style="text-align: left; padding-left: 40pt">ID Barang</label>

                                  <div class="col-sm-7">
                                    <select class="form-control select2" name="idat">
                                      <option selected hidden disabled>Cari ID Barang</option>
                                      @foreach($alll as $idnyaat)
                                      <option value="{{$idnyaat->id_barang}}">{{$idnyaat->id_barang}}</option>
                                      @endforeach
                                    </select>
                                  </div>
                                </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-xs-7 col-md-8 text-center">
                                <div class="form-group">
                                  <label class="col-sm-4 control-label" style="text-align: left; padding-left: 40pt">Jumlah Barang</label>

                                  <div class="col-sm-7">
                                      <input type="text" class="form-control" name="jmlat" value="{{$id->jml_barang}}">
                                  </div>
                                </div>
                            </div>
                          </div>              
                          
                          <div class="button">
                            <ul class="left" style="padding-left: 385pt ">
                              <button class="btn btn-success" href="#">Simpan</button>
                              <button class="btn btn-secondary" href="#">Batal</button>
                            </ul>
                          </div>
                        </div>
                      </form>
                      @endforeach
                  @else
                  <form class="form-horizontal" action="{{url('transalat')}}" method="post" name="formName">
                    @csrf
                    <input type="hidden" name="formName" value="keluaran">
                    <div class="box-body">
                      <div class="row">
                        <div class="col-xs-7 col-md-12 text-left">
                            <div class="form-group">
                              <label class="col-sm-12"><h3>Input Transaksi Alat Terapi Keluar</h3><hr></label>
                            </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-xs-7 col-md-8 text-center">
                            <div class="form-group">
                              <label class="col-sm-4 control-label" style="text-align: left; padding-left: 40pt">Tanggal</label>

                              <div class="col-sm-3">
                                <input type="date" name="tglat" id="datepicker" class="input-tanggal" required>
                              </div>
                            </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-xs-7 col-md-8 text-center">
                            <div class="form-group">
                              <label class="col-sm-4 control-label" style="text-align: left; padding-left: 40pt">No. Kwitansi</label>

                              <div class="col-sm-7">
                                  <input type="text" class="form-control" name="noat">
                              </div>
                            </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-xs-7 col-md-8 text-center">
                            <div class="form-group">
                              <label class="col-sm-4 control-label" style="text-align: left; padding-left: 40pt">ID Barang</label>

                              <div class="col-sm-7">
                                <select class="form-control select2" name="idat">
                                  <option selected hidden disabled>Cari ID Barang</option>
                                  @foreach($alll as $idnyaat)
                                  <option value="{{$idnyaat->id_barang}}">{{$idnyaat->id_barang}}</option>
                                  @endforeach
                                </select>
                              </div>
                            </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-xs-7 col-md-8 text-center">
                            <div class="form-group">
                              <label class="col-sm-4 control-label" style="text-align: left; padding-left: 40pt">Jumlah Barang</label>

                              <div class="col-sm-7">
                                  <input type="text" class="form-control" name="jmlat">
                              </div>
                            </div>
                        </div>
                      </div>              
                      
                      <div class="button">
                        <ul class="left" style="padding-left: 385pt ">
                          <button class="btn btn-success" href="#">Simpan</button>
                          <button class="btn btn-secondary" href="#">Batal</button>
                        </ul>
                      </div>
                    </div>
                  </form>
                  @endif
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
                    <h3 class="box-title">Tabel Record Transaksi Alat Terapi Keluar</h3>
                  </div>
                  
                  <div class="box-body">
                    <table id="pegawais" class="table table-bordered table-striped text-center">
                      <thead>
                      <tr>
                        <th>Tanggal</th>
                        <th>No. Kwitansi</th>
                        <th>ID Barang</th>
                        <th>Jumlah Barang</th>
                        <th>Aksi</th>

                      </tr>
                      </thead>
                      <tbody>
                        @foreach($out as $x)
                      <tr>
                        <td>{{$x->tgl}}</td>
                        <td>{{$x->no_kwitansi}}</td>
                        <td>{{$x->id_barang}}</td>
                        <td>{{$x->jml_barang}}</td>
                        <td>
                          <form action="{{ url('transalat', $x->id_barang) }}" method="post">
                              @csrf
                              @method("DELETE")
                              <input type="submit" class="btn btn-danger btn-sm" href="{{ $x->id_barang }}" value="Delete">
                          </form>
                        </td>
                      </tr>
                      @endforeach
                      </tbody>
                      <tfoot>
                      <tr>
                        <th>Tanggal</th>
                        <th>No. Kwitansi</th>
                        <th>ID Barang</th>
                        <th>Jumlah Barang</th>
                        <th>Aksi</th>
                      </tr>
                      </tfoot>
                    </table>
                  </div>
                  <!-- /.box-body -->
                </div>
              </div>
            </div>
            <!-- /.row -->
          </section>
          <!-- /.content -->
          <!-- /.content -->
        </div>
      </div>
      <!-- End Nav tabs -->

      </div>
    </div>
    <!-- /.content -->
  </div>

@endsection
