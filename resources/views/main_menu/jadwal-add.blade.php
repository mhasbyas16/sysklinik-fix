@extends('template.style')
@section('isi')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Jadwal Terapi
        <small>Atur jadwal terapis</small>
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
            <form method="post"  action="{{url('jadwal-terapi/add')}}" enctype="multipart/form-data" class="form-horizontal">
              {{csrf_field()}}
              <input type="text" value="" name="id_pasien"/>
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
                            <div class="box-tools pull-right">
                              <a href=""<button type="button" class="btn btn-box-tool"><i class="fa fa-times"></i></button>
                            </button></a>
                            &nbsp;&nbsp;&nbsp;
                            </div>
                            <label class="col-sm-12"><h3>Atur jadwal Terapi</h3>
                            <hr></label>
                          </div>
                      </div>
                      <!-- ./col -->
              </div>

              <input type="hidden" name="id_asses" value="{{$id}}">
              @foreach($isi as $I)
              <input type="hidden" name="id_terapi[]" value="{{$I->id_terapi}}">
              <div class="row">
                <div class="col-xs-8 col-md-12 text-left">
                    <div class="form-group">
                      <label class="col-sm-2 control-label" style="text-align: left; padding-left: 20pt">{{$I->terapi}}</label>

                      <div class="col-sm-2">
                        <div class="input-group date">
                          <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                          </div>
                          <input type="text" class="form-control pull-right" value="" id="datepicker" placeholder="tanggal" name="tgl[]" required>
                        </div>
                      </div>
                      <div class="col-sm-2">
                          <input type="time" class="form-control pull-right" value="" placeholder="jam Masuk" name="jam_masuk[]" required>
                      </div>
                      <div class="col-sm-2">
                          <input type="time" class="form-control pull-right" value="" placeholder="jam keluar" name="jam_keluar[]" required>
                      </div>
                      <input type="hidden" name="id_terapipasien[]" value="{{$I->id_terapipasien}}">
                      <div class="col-sm-2">
                        <select class="form-control select2" style="width: 100%;" name="terapis[]" value=" " required>
                          @foreach($terapis as $isi)
                          @if($I->id_terapi==$isi->id_terapi)
                            <option value="{{$isi->id_pegawai}}">{{$isi->nama}}</option>
                          @endif
                          @endforeach
                          <option value="null">-</option>
                        </select>
                      </div>
                      <div class="col-sm-2">
                          <input type="text" class="form-control pull-right" placeholder="Biaya" value="" name="biaya[]" required>
                      </div>
                    </div>
                </div>
              </div>
              <!-- /.row -->
              @endforeach
              <div class="row">
                <div class="col-xs-7 col-md-8 text-left">
                  <div class="col-sm-2">
                    <input type="submit" class="btn btn-success" name="" value="Tambah">
                  </div>
                  <div class="col-sm-2">
                    <a href="{{url('/jadwal-terapi')}}"><div class="btn btn-danger">Batal</div></a>
                  </div>
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
