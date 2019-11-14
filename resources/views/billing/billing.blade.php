@extends('template.style')
@section('isi')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Billing
        <small>Header Billing</small>
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
          <a href="#home" aria-controls="home" role="tab" data-toggle="tab">Daftar Billing</a>
        </li>
        <li role="presentation">
          <a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Sesi Tambahan</a>
        </li>
      </ul>

      <!-- Tab panes -->
      <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="home">
          <section class="content">

              <!-- row -->
              <div class="row">
                <div class="col-xs-12">
                  <!-- jQuery Knob -->
                  <div class="box box-solid">

                    <!-- begin data alat-->
                    <form class="form-horizontal">

                    <div class="box-body">
                      <div class="row">
                        <div class="col-xs-7 col-md-12 text-left">
                            <div class="form-group">
                              <label class="col-sm-12"><h3>Data Billing</h3><hr></label>
                            </div>
                        </div>
                      </div>

                    <div class="row">
                      <div class="col-xs-7 col-md-6 text-center">
                          <div class="form-group">
                            <label class="col-sm-5 control-label" style="text-align: left; padding-left: 20pt">Nama</label>

                            <div class="col-sm-6">
                              <input type="text" class="form-control" name="nama_P">
                            </div>
                          </div>
                      </div>
                      <!-- ./col -->
                      <div class="col-xs-7 col-md-6 text-center">
                          <div class="form-group">
                            <label class="col-sm-5 control-label" style="text-align: left; padding-left: 20pt">Jenis Kelamin</label>

                            <div class="col-sm-6">
                              <input type="text" class="form-control" name="nama_P">
                            </div>
                          </div>
                      </div>
                    </div>
                    
                    <div class="row">
                      <div class="col-xs-7 col-md-6 text-center">
                          <div class="form-group">
                            <label class="col-sm-5 control-label" style="text-align: left; padding-left: 20pt">ID Pasien</label>

                            <div class="col-sm-6">
                              <input type="text" class="form-control" name="nama_P">
                            </div>
                          </div>
                      </div>
                      <!-- ./col -->
                      <div class="col-xs-7 col-md-6 text-center">
                          <div class="form-group">
                            <label class="col-sm-5 control-label" style="text-align: left; padding-left: 20pt">Durasi</label>

                            <div class="col-sm-6">
                              <input type="text" class="form-control" name="nama_P">
                            </div>
                          </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-xs-7 col-md-6 text-center">
                          <div class="form-group">
                            <label class="col-sm-5 control-label" style="text-align: left; padding-left: 20pt">Nama Pasien</label>

                            <div class="col-sm-6">
                              <input type="text" class="form-control" name="nama_P">
                            </div>
                          </div>
                      </div>
                      <!-- ./col -->
                      <div class="col-xs-7 col-md-6 text-center">
                          <div class="form-group">
                            <label class="col-sm-5 control-label" style="text-align: left; padding-left: 20pt">Keterangan</label>

                            <div class="col-sm-6">
                              <input type="text" class="form-control" name="nama_P">
                            </div>
                          </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-xs-7 col-md-6 text-center">
                          <div class="form-group">
                            <label class="col-sm-5 control-label" style="text-align: left; padding-left: 20pt">Nama Terapis</label>

                            <div class="col-sm-6">
                              <input type="text" class="form-control" name="nama_P">
                            </div>
                          </div>
                      </div>
                      <!-- ./col -->
                      <div class="col-xs-7 col-md-6 text-center">
                          <div class="form-group">
                            <label class="col-sm-5 control-label" style="text-align: left; padding-left: 20pt">Tarif</label>

                            <div class="col-sm-6">
                              <input type="text" class="form-control" name="nama_P">
                            </div>
                          </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-xs-7 col-md-6 text-center">
                          <div class="form-group">
                            <label class="col-sm-5 control-label" style="text-align: left; padding-left: 20pt">Tanggal</label>

                            <div class="col-sm-6">
                              <input type="text" class="form-control" name="nama_P">
                            </div>
                          </div>
                      </div>
                      <!-- ./col -->
                      <div class="col-xs-7 col-md-6 text-center">
                          <div class="form-group">
                            <label class="col-sm-5 control-label" style="text-align: left; padding-left: 20pt">Jumlah Sesi</label>

                            <div class="col-sm-6">
                              <input type="text" class="form-control" name="nama_P">
                            </div>
                          </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-xs-7 col-md-6 text-center">
                          <div class="form-group">
                            <label class="col-sm-5 control-label" style="text-align: left; padding-left: 20pt">Jam Masuk</label>

                            <div class="col-sm-6">
                              <input type="text" class="form-control" name="nama_P">
                            </div>
                          </div>
                      </div>
                      <!-- ./col -->
                      <div class="col-xs-7 col-md-6 text-center">
                          <div class="form-group">
                            <label class="col-sm-5 control-label" style="text-align: left; padding-left: 20pt">Biaya</label>

                            <div class="col-sm-6">
                              <input type="text" class="form-control" name="nama_P">
                            </div>
                          </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-xs-7 col-md-6 text-center">
                          <div class="form-group">
                            <label class="col-sm-5 control-label" style="text-align: left; padding-left: 20pt">Jam Keluar</label>

                            <div class="col-sm-6">
                              <input type="text" class="form-control" name="nama_P">
                            </div>
                          </div>
                      </div>
                      <!-- ./col -->
                      <div class="col-xs-7 col-md-6 text-center">
                          <div class="form-group">
                            <label class="col-sm-5 control-label" style="text-align: left; padding-left: 20pt">Status</label>

                            <div class="col-sm-6">
                              <input type="text" class="form-control" name="nama_P">
                            </div>
                          </div>
                      </div>
                    </div>
                    <br>
                    <div class="button">
                        <ul style="padding-left: 680pt ">
                          <button class="btn btn-success" href="#">Simpan</button>
                          <button class="btn btn-danger" href="#">Batal</button>
                        </ul>
                    </div>
                    <br>
                    <br>
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
                      <h3 class="box-title">Tabel Billing</h3>
                    </div>
                    
                    <!-- /.box-header -->
                    <div class="box-body">
                      <table id="pegawais" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID x</th>
                                <th>x</th>
                                <th>Jenis x</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tfoot>
                            <tr>
                                <th>ID x</th>
                                <th>x</th>
                                <th>Jenis x</th>
                                <th>Aksi</th>
                            </tr>
                        </tfoot>

                        <tbody>
                        <tr>
                          <td></td>
                          <td></td>
                          <td></td>
                           
                          <td>
                            <a href="{{url('/d_billing')}}"><i class="fas fa-edit" style="color:green;font-size:20px;"></i></a> 
                            &nbsp;&nbsp;&nbsp;
                            <a href="#" onclick="return confirm('Apakah Kamu Yakin Mengahapus Data ID?')">
                              <i class="fas fa-eraser" style="color:red;font-size:20px;"></i>
                            </a>
                          </td>
                          
                          <td></td>
                          
                      </tr>
                     
                  </tbody>
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
                    <form class="form-horizontal">
                    <div class="box-body">
                      <div class="row">
                        <div class="col-xs-7 col-md-12 text-left">
                            <div class="form-group">
                              <label class="col-sm-12"><h3>Sesi Tambahan</h3><hr></label>
                            </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-xs-7 col-md-8 text-center">
                            <div class="form-group">
                              <label class="col-sm-4 control-label" style="text-align: left; padding-left: 40pt">ID Pasien</label>

                              <div class="col-sm-7">
                                <input type="text" class="form-control" name="nama_P">
                              </div>
                            </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-xs-7 col-md-8 text-center">
                            <div class="form-group">
                              <label class="col-sm-4 control-label" style="text-align: left; padding-left: 40pt">Nama Pasien</label>

                              <div class="col-sm-7">
                                  <input type="text" class="form-control" id="alamatP" name="alamat"></textarea>
                              </div>
                            </div>
                        </div>
                      </div> 

                      <div class="row">
                        <div class="col-xs-7 col-md-8 text-center">
                            <div class="form-group">
                              <label class="col-sm-4 control-label" style="text-align: left; padding-left: 40pt">Nama Terapis</label>

                              <div class="col-sm-7">
                                <input type="text" class="form-control" name="nama_P">
                              </div>
                            </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-xs-7 col-md-8 text-center">
                            <div class="form-group">
                              <label class="col-sm-4 control-label" style="text-align: left; padding-left: 40pt">Tanggal</label>

                              <div class="col-sm-7">
                                  <input type="text" class="form-control" id="alamatP" name="alamat"></textarea>
                              </div>
                            </div>
                        </div>
                      </div>     

                      <div class="row">
                        <div class="col-xs-7 col-md-8 text-center">
                            <div class="form-group">
                              <label class="col-sm-4 control-label" style="text-align: left; padding-left: 40pt">Keterangan</label>

                              <div class="col-sm-7">
                                  <input type="text" class="form-control" id="alamatP" name="alamat"></textarea>
                              </div>
                            </div>
                        </div>
                      </div>         

                      <div class="row">
                        <div class="col-xs-7 col-md-8 text-center">
                            <div class="form-group">
                              <label class="col-sm-4 control-label" style="text-align: left; padding-left: 40pt">Biaya</label>

                              <div class="col-sm-7">
                                  <input type="text" class="form-control" id="alamatP" name="alamat"></textarea>
                              </div>
                            </div>
                        </div>
                      </div> 
                      
                      <div class="button">
                        <ul class="left" style="padding-left: 390pt ">
                          <button class="btn btn-success" href="#">Simpan</button>
                          <button class="btn btn-danger" href="#">Batal</button>
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
                      <h3 class="box-title">Tabel Sesi Tambahan</h3>
                    </div>
                    
                    <!-- /.box-header -->
                    <div class="box-body">
                      <table id="pegawais" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                          <th>Rendering engine</th>
                          <th>Browser</th>
                          <th>Platform(s)</th>
                          <th>Engine version</th>
                          <th>CSS grade</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                          <td>Trident</td>
                          <td>Internet
                            Explorer 4.0
                          </td>
                          <td>Win 95+</td>
                          <td> 4</td>
                          <td>X</td>
                        </tr>
                        <tr>
                          <td>Trident</td>
                          <td>Internet
                            Explorer 5.0
                          </td>
                          <td>Win 95+</td>
                          <td>5</td>
                          <td>C</td>
                        </tr>
                        </tbody>
                        <tfoot>
                        <tr>
                          <th>Rendering engine</th>
                          <th>Browser</th>
                          <th>Platform(s)</th>
                          <th>Engine version</th>
                          <th>CSS grade</th>
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
    <!-- End Main content -->
  </div>
@endsection
