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
      <div class="row">
        <div class="col-xs-12">
          <!-- jQuery Knob -->
          <div class="box box-solid">
            <!-- /.box-header -->
            <form method="post"  action="{{url('/store_asses')}}" enctype="multipart/form-data" class="form-horizontal">
              {{ csrf_field() }}
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
                <?php
                    $angka=range(0,9);
                    shuffle($angka);
                    $id=array_rand($angka,3);
                    $idstring=implode($id);
                    $id_asses=$idstring;

                    $now = date('ymd');
                    $dataakhir = \App\m_Hpasien::max('id_pasien');
                    $no = $dataakhir;
                    $lama = substr($no, 0, 6);
                    $rplc = str_replace($lama, $now, $id_asses);
                    $idnew = $now.$rplc;
                ?>
                <input type="text" name="id_asses" value="{{$idnew}}" hidden />

                <div class="row">
                  <div class="col-xs-7 col-md-6 text-center">
                      <div class="form-group">
                        <label class="col-sm-4 control-label" style="text-align: left; padding-left: 20pt">Pasien</label>
                        <div class="col-sm-5" style="margin-left: 1pt">
                            <select class="form-control select2" style="width: 100%;" name="pasien" value="" required>
                              @foreach ($pasien as $item)
                            <option value="{{$item->id_pasien}}">{{$item->nama}}</option>
                              @endforeach
                            </select>
                        </div>
                      </div>
                  </div>
                  <div class="col-xs-7 col-md-6 text-center">
                      <div class="form-group">
                        <label class="col-sm-4 control-label" style="text-align: left; padding-left: 20pt">Assesor</label>
                        <div class="col-sm-5" style="margin-left: 1pt">
                            <select class="form-control select2" style="width: 100%;" name="assesor" value="" required>
                              @foreach($kar as $kar)
                                <option value="{{$kar->id_pegawai}}">{{$kar->nama}}</option>
                              @endforeach
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
                            @foreach($j_terapi as $j_terapi)
                            <input type="checkbox" name="J_terapi[]" value="{{$j_terapi->id_terapi}}">&nbsp;{{$j_terapi->terapi}}<br>
                            @endforeach
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
                                @foreach($status as $isi)
                                <option value="{{$isi}}">{{$isi}}</option>
                                @endforeach
                            </select>
                        </div>
                      </div>
                  </div>
                </div>

                <!-- <div class="row col-xs-12 col-md-12" style="padding-top: 20px; padding-bottom: 20px; padding-left: 680pt">
                    <div class="col-sm-1 text-left">
                      <input type="submit" class="btn btn-success" name="" value="Tambah">
                    </div>
                    <div class="col-sm-1 text-left">
                      <a href="{{url('/register-list')}}"><div class="btn btn-danger text-center" style="margin-left: 40pt; padding-right: 15pt; padding-left: 15pt">Batal</div></a>
                    </div>
                </div> -->
                <div class="row">
                    <div class="button">
                        <ul style="padding-left: 680pt ">
                          <button type="submit" class="btn btn-success">Simpan</button>
                          <a href="{{url('/register-list')}}"><div class="btn btn-danger">Batal</div></a>
                        </ul>
                    </div>
                    <br>
                    <br>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
</div>

@endsection
