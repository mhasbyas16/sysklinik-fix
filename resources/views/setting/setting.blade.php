@extends('template.style')
@section('isi')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Setting
        <small>Account</small>
      </h1>
      <!--
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-files-o"></i> Main Menu</a></li>
        <li class="active">Assesment</li>
      </ol>
      -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- row -->
      <div class="row">
        <div class="col-xs-12">
          <!-- jQuery Knob -->
          <div class="box box-solid">
            <!-- /.box-header -->
            <form class="form-horizontal">
            <div class="box-body">
              <div class="row">
                <div class="col-xs-7 col-md-12 text-left">
                    <div class="form-group">
                      <label class="col-sm-12"><h3>Setting Account</h3><hr></label>
                    </div>
                </div>
                <!-- ./col -->
              </div>

              <div class="row">
                        <div class="col-xs-7 col-md-8 text-center">
                            <div class="form-group">
                              <label class="col-sm-4 control-label" style="text-align: left; padding-left: 40pt">Nama</label>

                              <div class="col-sm-7">
                                <input type="text" class="form-control" name="nama_P" disabled="">
                              </div>
                            </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-xs-7 col-md-8 text-center">
                            <div class="form-group">
                              <label class="col-sm-4 control-label" style="text-align: left; padding-left: 40pt">Jabatan</label>

                              <div class="col-sm-7">
                                  <input type="text" class="form-control" id="alamatP" name="alamat" disabled=""></textarea>
                              </div>
                            </div>
                        </div>
                      </div> 

                      <div class="row">
                        <div class="col-xs-7 col-md-8 text-center">
                            <div class="form-group">
                              <label class="col-sm-4 control-label" style="text-align: left; padding-left: 40pt">Email</label>

                              <div class="col-sm-7">
                                <input type="text" class="form-control" name="nama_P" disabled="">
                              </div>
                            </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-xs-7 col-md-8 text-center">
                            <div class="form-group">
                              <label class="col-sm-4 control-label" style="text-align: left; padding-left: 40pt">Password</label>

                              <div class="col-sm-7">
                                  <input type="text" class="form-control" id="alamatP" name="alamat" disabled=""></textarea>
                              </div>
                            </div>
                        </div>
                      </div>             
                      
                      <div class="button">
                        <ul class="left" style="padding-left: 450pt ">
                          <button class="btn btn-primary" href="#" data-toggle="modal" data-target="#myModal">Edit</button>
                        </ul>
                      </div>

                  <!-- Modal -->
                  <div id="myModal" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                      <!-- konten modal-->
                      <div class="modal-content">
                        <!-- heading modal -->
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <h4 class="modal-title">Edit Data</h4>
                        </div>
                        <!-- body modal -->
                        <div class="modal-body">
                          <div class="row">
                            <div class="col-xs-7 col-md-12 text-center">
                                <div class="form-group">
                                  <label class="col-sm-4 control-label" style="text-align: left; padding-left: 40pt">Password</label>

                                  <div class="col-sm-7">
                                      <input type="text" class="form-control" id="alamatP" name="alamat"></textarea>
                                  </div>
                                </div>
                            </div>
                          </div> 
                          <div class="row">
                            <div class="col-xs-7 col-md-12 text-center">
                                <div class="form-group">
                                  <label class="col-sm-4 control-label" style="text-align: left; padding-left: 40pt">Re-type Password</label>

                                  <div class="col-sm-7">
                                      <input type="text" class="form-control" id="alamatP" name="alamat"></textarea>
                                  </div>
                                </div>
                            </div>
                          </div>     
                        </div>
                        <!-- footer modal -->
                        <div class="modal-footer">
                          <ul>
                            <button type="button" class="btn btn-success" data-dismiss="modal">Simpan</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                          </ul>
                        </div>
                      </div>
                    </div>
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
     
    </section>
    <!-- /.content -->
  </div>

@endsection
