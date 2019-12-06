@extends('template.style')
@section('isi')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
    Billing
    <small>Detail Billing</small>
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
            <form class="form-horizontal" action="{{ url('billing/'.$d->id_bukti ) }}" method="post">
              @csrf
              {{ method_field('PATCH') }}
              <div class="box-body">
                <div class="row">
                  <div class="col-xs-7 col-md-12 text-left">
                    <div class="form-group">
                      <label class="col-sm-12"><h3>Data Billing Detail</h3><hr></label>
                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="col-md-6">
                    <div class="row">
                      <div class="col-xs-12 col-md-12 text-center">
                        <div class="form-group">
                          <label class="col-sm-5 control-label" style="text-align: left; padding-left: 20pt">Validasi</label>
                          <div class="col-sm-7">
                            <select name="validasi" class="form-control" <?php if($d->validasi == "Valid"){ echo 'disabled';} ?>>
                              <option value="Tidak Valid" <?php if($d->validasi == "Tidak Valid"){ echo 'selected';} ?>>Tidak Valid</option>
                              <option value="Valid" <?php if($d->validasi == "Valid"){ echo 'selected';} ?>>Valid</option>
                            </select>
                            <input type="hidden" name="id_bill" value="{{ $d->id_bill }}">
                          </div>
                        </div>
                      </div>
                    </div>                  
                    <div class="row">
                      <div class="col-xs-12 col-md-12 text-center">
                        <div class="form-group">
                          <label class="col-sm-5 control-label" style="text-align: left; padding-left: 20pt">Tanggal Bayar</label>
                          <div class="col-sm-7">
                            <input type="text" value="{{ $d->tgl_bayar }}" class="form-control" disabled>
                            <input type="hidden" name="tgl_bayar" value="{{ $d->tgl_bayar }}" class="form-control" >
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-xs-12 col-md-12 text-center">
                        <div class="form-group">
                          <label class="col-sm-5 control-label" style="text-align: left; padding-left: 20pt">Jumlah Bayar</label>
                          <div class="col-sm-7">
                            <input type="text" value="{{ $d->jml_bayar }}" class="form-control" disabled>
                            <input type="hidden" name="jml_bayar" value="{{ $d->jml_bayar }}" class="form-control" >
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  
                  <div class="col-md-6">
                    <div class="row">
                      <div class="col-xs-12 col-md-12 text-center">
                        <div class="form-group">
                          <label class="col-sm-5 control-label" style="text-align: left; padding-left: 20pt">Bukti</label>
                          <div class="col-sm-7">
                            <img src="{{ asset('/images/bukti/'.$d->foto) }}" target="_Blank" alt="Bukti">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <br>
                <div class="button">
                  <ul>
                    @if ($d->validasi == "Tidak Valid")
                      <button class="btn btn-success" type="submit">Update</button>
                    @else
                      <a href="{{ url('/kwitansi/'.$d->id_bukti) }}" class="btn btn-success">View Kwitansi</a>
                    @endif
                    <button class="btn btn-danger" type="button" onclick="goBack()">Batal</button>
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
  <!-- End Main content -->
</div>
@endsection