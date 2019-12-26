@extends('template.style')
@section('isi')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
    Rekam Medis
    <small>Form Rekam Medis</small>
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
          <!-- begin data alat-->
          @foreach ($data as $d)
            <form class="form-horizontal" action="{{ url('rekam_medis/'.$d->id_rm ) }}" method="post">
              @csrf
              {{ method_field('PATCH') }}
              <div class="box-body">
                <div class="row">
                  <div class="col-xs-7 col-md-12 text-left">
                    <div class="form-group">
                      <label class="col-sm-12"><h3>Data Rekam Medis</h3><hr></label>
                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="col-md-6">                  
                    <div class="row">
                      <div class="col-xs-12 col-md-12 text-center">
                        <div class="form-group">
                          <label class="col-sm-5 control-label" style="text-align: left; padding-left: 20pt">Pasien</label>
                          <div class="col-sm-7">
                            <input type="text" name="nama" value="{{ $d->nama }}" disabled>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-xs-12 col-md-12 text-center">
                        <div class="form-group">
                          <label class="col-sm-5 control-label" style="text-align: left; padding-left: 20pt">ID Assessment</label>
                          <div class="col-sm-7">
                            <input type="text" name="id_asses" value="{{ $d->id_asses }}" disabled>
                            <input type="hidden" name="id_asses" value="{{ $d->id_asses }}">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  
                  <div class="col-md-6">
                    <div class="row">
                      <div class="col-xs-12 col-md-12 text-center">
                        <div class="form-group">
                          <label class="col-sm-5 control-label" style="text-align: left; padding-left: 20pt">Diagnosa</label>
                          <div class="col-sm-7">
                            <textarea class="form-control" name="diagnosa" rows="5" value="{{ $d->diagnosa }}">{{ $d->diagnosa }}</textarea>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <br>
                <div class="button">
                  <ul>
                    <button class="btn btn-success" href="#">Simpan</button>
                    <a class="btn btn-danger" onclick="goBack()">Batal</a>
                  </ul>
                </div>
                <br>
                <br>
              </div>
            </form>
          @endforeach
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
      <!-- /.col -->
    </div>
  </section>
</div>
<script>
  
function goBack() {
  window.history.back();
}
</script>
@endsection