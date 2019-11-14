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
          <form class="form-horizontal" action="{{ url('rekam_medis') }}" method="post">
            @csrf
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
                        <label class="col-sm-5 control-label" style="text-align: left; padding-left: 20pt">ID RM</label>
                        <div class="col-sm-7">
                          <input type="input" name="diagnosa">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-12">
                <div class="col-md-6">                  
                  <div class="row">
                    <div class="col-xs-12 col-md-12 text-center">
                      <div class="form-group">
                        <label class="col-sm-5 control-label" style="text-align: left; padding-left: 20pt">ID Pasien</label>
                        <div class="col-sm-7">
                          <select class="form-control" name="id_pasien">
                            @foreach($pasien as $psn)
                              <option value="{{ $psn->id_pasien }}">{{ $psn->nama }}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-12">
                <div class="col-md-6">      
                    <div class="row">
                      <div class="col-xs-12 col-md-12 text-center">
                        <div class="form-group">
                          <label class="col-sm-5 control-label" style="text-align: left; padding-left: 20pt">Diagnosa</label>
                          <div class="col-sm-7">
                            <input type="input" name="diagnosa">
                          </div>
                        </div>
                      </div>
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
  </section>
</div>
@endsection