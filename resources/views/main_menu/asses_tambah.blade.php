@extends('template.style')
@section('isi')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Tambah Assessment
        <small>Tambah Assessment Baru</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
   <!-- row -->
      <div class="row">
        <div class="col-xs-12">
          <!-- jQuery Knob -->
          <div class="box box-solid">
            <!-- /.box-header -->
            <form method=""  action="" enctype="multipart/form-data" class="form-horizontal">
            <div class="box-body">
              @if(\Session::has('alert'))
              <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> Warning!</h4>
                {{Session::get('alert')}}
              </div>
              @endif
              <div class="row">
                      <div class="col-xs-7 col-md-12 text-left">
                          <div class="form-group">
                            <label class="col-sm-12"><h3>&nbsp;&nbsp;&nbsp;Atur Assessment</h3>
                            <hr></label>
                          </div>
                      </div>
                      <!-- ./col -->
              </div>

              <div class="row">
                <div class="col-xs-7 col-md-6 text-center">
                    <div class="form-group">
                      <label class="col-sm-4 control-label" style="text-align: left; padding-left: 20pt">Pasien</label>
                      <div class="col-sm-5" style="margin-left: 1pt">
                          <select class="form-control select2" style="width: 100%;" name="assesor" value="" required>
                            <option value="">Pilih Pasien</option>
                          </select>
                      </div>
                    </div>
                </div>
                <div class="col-xs-7 col-md-6 text-center">
                    <div class="form-group">
                      <label class="col-sm-4 control-label" style="text-align: left; padding-left: 20pt">Assesor</label>
                      <div class="col-sm-5" style="margin-left: 1pt">
                          <select class="form-control select2" style="width: 100%;" name="assesor" value="" required>
                            <option value="">Pilih Assessor</option>
                          </select>
                      </div>
                    </div>
                </div>
                <!-- ./col -->
              </div>

              <div class="row">
                <div class="col-xs-7 col-md-6 text-center">
                    <div class="form-group">
                      <label class="col-sm-4 control-label" style="text-align: left; padding-left: 20pt">Jenis Terapi</label>

                      <div class="col-sm-7 text-left">
                          <input type="checkbox" name="" value="">&nbsp;<br>
                      </div>
                    </div>
                </div>
              </div>

              <div class="row">
                <div class="col-xs-7 col-md-6 text-center">
                    <div class="form-group">
                      <label class="col-sm-4 control-label" style="text-align: left; padding-left: 20pt">Tanggal Mulai Terapi</label>
                      <div class="col-sm-5">
                          <div class="input-group date">
                            <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" class="form-control pull-right" id="tgl_mulai" name="tgl_mulai_terapi" value="" required>
                          </div>
                          <!-- /.input group -->
                        </div>
                    </div>
                </div>
                <div class="col-xs-7 col-md-6 text-center">
                    <div class="form-group">
                      <label class="col-sm-4 control-label" style="text-align: left; padding-left: 20pt">Tanggal Selesai Terapi</label>
                       <div class="col-sm-5">
                          <div class="input-group date">
                            <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" class="form-control pull-right" id="tgl_selesai" name="tgl_selesai_terapi" value="" required>
                          </div>
                          <!-- /.input group -->
                        </div>
                    </div>
                </div>
                <!-- ./col -->
              </div>

               <div class="row">
                <div class="col-xs-7 col-md-6 text-center">
                    <div class="form-group">
                      <label class="col-sm-4 control-label" style="text-align: left; padding-left: 20pt">Status</label>

                      <div class="col-sm-5">
                          <select class="form-control select2" style="width: 100%;" name="status" value=" " required>
                            <option value="">Pilih Status</option>
                            <option value=""></option>
                          </select>
                      </div>
                    </div>
                </div>
              </div>
              <div class="row col-xs-12 col-md-12" style="padding-top: 20px; padding-bottom: 20px">
                  <div class="col-sm-1 text-left">
                    <input type="submit" class="btn btn-success" name="" value="Tambah">
                  </div>
                  <div class="col-sm-1 text-left">
                    <a href="{{url('/jadwal-terapi')}}"><div class="btn btn-danger">Batal</div></a>
                  </div>
              </div>
    </section>
    <!-- /.content -->
  </div>
</div>

@endsection
