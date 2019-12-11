@extends('template.style')
@section('isi')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Tambah Jadwal Terapi
        <small>Tambah Jadwal Baru</small>
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
                            <label class="col-sm-12"><h3>&nbsp;&nbsp;&nbsp;Atur jadwal Terapi</h3>
                            <hr></label>
                          </div>
                      </div>
                      <!-- ./col -->
              </div>

              <div class="row">
                <div class="col-xs-8 col-md-12 text-left">
                    <div class="form-group col-md-12">
                      <div class="col-sm-2">
                        <div class="input-group date">
                          <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                          </div>
                          <input type="text" class="form-control pull-right" value="" id="datepicker" placeholder="Tanggal" name="" required>
                        </div>
                      </div>
                      <div class="col-sm-2">
                        <select class="form-control select2" style="width: 100%;" name="" value="pasien" required>
                          <option value="Pilih Pasien">Pilih Pasien</option>
                          <option value="null">-</option>
                        </select>
                      </div>
                      <div class="col-sm-2">
                        <select class="form-control select2" style="width: 100%;" name="" value="terapis" required>
                          <option value="Pilih Terapis">Pilih Terapis</option>
                          <option value="null">-</option>
                        </select>
                      </div>
                      <div class="col-sm-2">
                        <select class="form-control select2" style="width: 100%;" name="" value="jenis_terapi" required>
                          <option value="Pilih Jenis Terapi">Pilih Jenis Terapis</option>
                          <option value="null">-</option>
                        </select>
                      </div>
                    </div>
                    <div class="form-group col-md-12">
                      <div class="col-sm-2">
                          <input type="time" class="form-control pull-right" value="" placeholder="jam Masuk" name="" required>
                      </div>
                      <div class="col-sm-2">
                          <input type="time" class="form-control pull-right" value="" placeholder="jam keluar" name="" required>
                      </div>
                      <div class="col-sm-2">
                          <input type="text" class="form-control pull-right" placeholder="Biaya" value="" name="" required>
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
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </form>
    </section>
    <!-- /.content -->
  </div>
</div>

@endsection
