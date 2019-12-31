@extends('template.style')
@section('isi')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Main Menu
        <small>Register List</small>
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
            <form method="post"  action="{{url('/register-list/update')}}" enctype="multipart/form-data" class="form-horizontal">
              {{csrf_field()}}
              <input type="text" value="{{$id}}" name="id_pasien" hidden/>
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
                              <a href="{{url('/register-list')}}" button type="button" class="btn btn-box-tool"><i class="fa fa-times"></i></button>
                            </button></a>
                            &nbsp;&nbsp;&nbsp;
                            </div>
                            <label class="col-sm-12"><h3>Data Pasien</h3>
                            <hr></label>
                          </div>
                      </div>
                      <!-- ./col -->
              </div>

              <div class="row">
                <div class="col-xs-7 col-md-8 text-center">
                    <div class="form-group">
                      <label class="col-sm-2 control-label" style="text-align: left; padding-left: 20pt">Nama</label>

                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="nama_P" value="{{$data->nama}}" required>
                      </div>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-xs-7 col-md-4 text-center" >
                    <div class="form-group">
                      <label class="col-sm-5 control-label" style="text-align: left; padding-left: 20pt">Jenis Kelamin</label>

                      <div class="col-sm-6">
                          <select class="form-control select2" style="width: 100%;" name="jk" value=" " required>
                            <option value="{{$data->jk}}" hidden>@if($data->jk=='Perempuan')Perempuan @else Laki - Laki @endif </option>
                            <option value="Laki-laki">Laki - Laki</option>
                            <option value="Perempuan">Perempuan</option>
                          </select>
                      </div>
                    </div>
                </div>
                <!-- ./col -->
              </div>
              <!-- /.row -->
              <div class="row">
                <div class="col-xs-7 col-md-8 text-center">
                    <div class="form-group">
                      <label class="col-sm-2 control-label" style="text-align: left; padding-left: 20pt">Alamat</label>

                      <div class="col-sm-10">
                          <textarea class="form-control" id="alamatP" rows="3" name="alamat_P">{{$data->alamat}}</textarea>
                      </div>
                    </div>
                </div>
              </div>
              <!-- /.row -->
              <div class="row">
                <div class="col-xs-7 col-md-4 text-center">
                    <div class="form-group">
                      <label class="col-sm-4 control-label" style="text-align: left; padding-left: 20pt">Tempat Lahir</label>

                      <div class="col-sm-7">
                        <input type="text" class="form-control" value="{{$data->tempat_lahir}}" name="tempat_lahir" required>
                      </div>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-xs-7 col-md-4 text-center">
                    <div class="form-group">
                        <label class="col-sm-5 control-label" style="text-align: left; padding-left: 20pt">Tanggal Lahir</label>

                        <div class="col-sm-7">
                          <div class="input-group date">
                            <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" class="form-control pull-right" value="{{$data->tgl_lahir}}" id="datepicker" name="tanggal_lahir" required>
                          </div>
                          <!-- /.input group -->
                        </div>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-xs-7 col-md-4 text-center">
                    <div class="form-group">
                      <label class="col-sm-5 control-label" style="text-align: left; padding-left: 20pt">Umur</label>

                      <div class="col-sm-6">
                        <input type="text" class="form-control" name="umur" value="{{$umur}}" maxlength="3" required>
                      </div>
                    </div>
                </div>
                <!-- ./col -->
              </div>
              <!-- /.row -->
              <div class="row">
                <div class="col-xs-7 col-md-4 text-center">
                    <div class="form-group">
                      <label class="col-sm-4 control-label" style="text-align: left; padding-left: 20pt">No. Telp</label>

                      <div class="col-sm-7">
                        <input type="text" class="form-control" name="notelp_P" value="{{$data->tlp}}" maxlength="15" required>
                      </div>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-xs-7 col-md-4 text-center">
                    <div class="form-group">
                        <label class="col-sm-5 control-label" style="text-align: left; padding-left: 20pt">Tanggal Daftar</label>

                        <div class="col-sm-7">
                          <div class="input-group date">
                            <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" class="form-control pull-right" value="{{$data->tgl}}" id="datedaftar" name="tanggal_daftar" required>
                          </div>
                          <!-- /.input group -->
                        </div>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-xs-7 col-md-4 text-center">
                    <div class="form-group">
                      <label class="col-sm-5 control-label" style="text-align: left; padding-left: 20pt">Agama</label>

                      <div class="col-sm-6">
                          <select class="form-control select2" style="width: 100%;" name="agama" value=" ">
                            <option value="{{$data->agama}}" hidden>{{$data->agama}}</option>
                            @foreach($agama as $isi)
                            <option value="{{$isi}}">{{$isi}}</option>
                            @endforeach
                          </select>
                      </div>
                    </div>
                </div>
              </div>

              <div class="row">
                <div class="col-xs-7 col-md-8 text-center">
                    <div class="form-group">
                      <label class="col-sm-2 control-label" style="text-align: left; padding-left: 20pt">Keluhan</label>

                      <div class="col-sm-10">
                          <textarea class="form-control" rows="3" name="keluhan">{{$data->keluhan}}</textarea>
                      </div>
                    </div>
                </div>
              </div>

              <div class="row col-md-12">
                <div class="col-xs-1 col-md-1 text-left">
                      <div class="form-group">
                        <label class="col-sm-1" style="text-align: left;">Besar Nominal:</label>
                      </div>
                </div>
              
                <div class="col-xs-4 col-md-4 text-left">
                      <div class="form-group">
                        <label class="col-sm-5 control-label">Uang Pangkal</label>

                        <div class="col-sm-7">
                            <input type="text" class="form-control" name="b_pangkal" required="">
                        </div>
                      </div>
                </div>

                <div class="col-xs-4 col-md-4 text-left">
                      <div class="form-group">
                        <label class="col-sm-5 control-label">Assessment</label>

                        <div class="col-sm-7">
                            <input type="text" class="form-control" name="b_asses" required="">
                        </div>
                      </div>
                </div>

                <div class="col-xs-3 col-md-3 text-left">
                      <div class="form-group">
                        <label class="col-sm-5 control-label">Evaluasi</label>

                        <div class="col-sm-7">
                            <input type="text" class="form-control" name="b_eval" required="">
                        </div>
                      </div>
                </div>
              </div>
              

              <div class="row">
                <div class="col-xs-7 col-md-5 text-center">
                    <div class="form-group">
                      <label class="col-sm-3 control-label" style="text-align: left; padding-left: 20pt">Foto</label>

                      <div class="col-sm-7" style="padding-left: 17pt">
                          <div class="input-group">
                              <span class="input-group-btn">
                                  <span class="btn btn-default btn-file">
                                      Browse… <input type="file" id="imgInp" value=" " name="foto">
                                  </span>
                              </span>
                              <input type="text" class="form-control" value="{{$data->foto}}" name="Nfoto" readonly>
                          </div>
                          <img id='img-upload' src="{{asset('foto/pasien')}}/{{$data->foto}}" />
                      </div>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-xs-7 col-md-5 text-center">
                  <label class="col-sm-5 control-label" style="text-align: left">*Foto berformat (png,jpg,jpeg) max 1MB</label>
                </div>
              </div>
              <!-- end data pasien-->

                    <div class="box-body">
                      <div class="row">
                      <div class="col-xs-7 col-md-12 text-left">
                          <div class="form-group">
                            <label class="col-sm-12"><h3>Data Orangtua - Ayah</h3><hr></label>
                          </div>
                      </div>
                      <!-- ./col -->
                      </div>

                      <div class="row">
                        <div class="col-xs-7 col-md-6 text-center">
                            <div class="form-group">
                              <label class="col-sm-2 control-label" style="text-align: left; padding-left: 20pt">Nama</label>

                              <div class="col-sm-9" style="padding-left: 30pt">
                                <input type="text" class="form-control" name="nama_A" value="{{$data->nama_ayah}}" required>
                              </div>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-xs-7 col-md-6 text-center">
                            <div class="form-group">
                              <label class="col-sm-2 control-label" style="text-align: left; padding-left: 20pt">NIK</label>

                              <div class="col-sm-9">
                                <input type="text" class="form-control" name="nik_A" value="{{$data->nik_ayah}}" maxlength="16" required>
                              </div>
                            </div>
                        </div>
                        <!-- ./col -->
                      </div>
                      <!-- /.row -->
                      <div class="row">
                        <div class="col-xs-7 col-md-4 text-center">
                            <div class="form-group">
                              <label class="col-sm-3 control-label" style="text-align: left; padding-left: 20pt">Agama</label>

                              <div class="col-sm-9" style="padding-left: 30pt">
                                  <select class="form-control select2" style="width: 100%;" name="agama_A" value=" ">
                                    <option value="{{$data->agama_ayah}}" hidden>{{$data->agama_ayah}}</option>
                                    @foreach($agama as $isi)
                                    <option value="{{$isi}}">{{$isi}}</option>
                                    @endforeach
                                  </select>
                              </div>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-xs-7 col-md-6 text-center">
                            <div class="form-group">
                              <label class="col-sm-2 control-label" style="text-align: left; padding-left: 155pt">Alamat</label>

                              <div class="col-sm-7" style="padding-left: 47pt; padding-right: 0pt">
                                  <textarea class="form-control" id="alamatA" rows="3" name="alamat_A">{{$data->alamat_ayah}}</textarea>
                                  <input type="checkbox" name="a" value="alamatA" id="cekboxA" style="padding-left: 47pt"/>  Alamat sama dengan pasien
                              </div>
                            </div>
                        </div>

                      </div>

                      <div class="row">
                         <div class="col-xs-7 col-md-4 text-center">
                            <div class="form-group">
                              <label class="col-sm-3 control-label" style="text-align: left; padding-left: 20pt; padding-top: 0pt">Pekerjaan
                              </label>
                              <div class="col-sm-9" style="padding-left: 30pt">
                                <input type="text" class="form-control" name="pekerjaan_A" value="{{$data->pekerjaan}}">
                              </div>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-xs-7 col-md-4 text-center">
                            <div class="form-group">
                              <label class="col-sm-3 control-label" style="text-align: left; padding-left: 153pt">Pend. Terakhir
                              </label>
                              <div class="col-sm-4" style="padding-left: 47pt; padding-top: 0pt">
                                <input type="text" class="form-control" value="{{$data->pend_ayah}}" name="pendTerakhir_A" maxlength="3" required>
                              </div>
                        </div>
                      </div>

                      <!-- /.row -->
                      <div class="row">
                        <div class="col-xs-7 col-md-6 text-center">
                            <div class="form-group">
                              <label class="col-sm-3 control-label" style="text-align: left; padding-left: 30pt">No. Telepon</label>

                              <div class="col-sm-9" style="padding-left: 5pt">
                                <input type="text" class="form-control" name="noTelp_A" value="{{$data->tlp_ayah}}" maxlength="15" required>
                              </div>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-xs-7 col-md-6 text-center">
                            <div class="form-group">
                              <label class="col-sm-2 control-label" style="text-align: left; padding-left: 20pt">Email</label>

                              <div class="col-sm-9">
                                <input type="email" class="form-control" name="email_A" value="{{$data->email_ayah}}" maxlength="16" required>
                              </div>
                            </div>
                        </div>
                        <!-- ./col -->
                      </div>
                  </div>
                  <!-- end data ayah-->
                  <div class="box-body">
                    <div class="row">
                      <div class="col-xs-7 col-md-12 text-left">
                          <div class="form-group">
                            <label class="col-sm-12"><h3>Data Orangtua - Ibu</h3><hr></label>
                          </div>
                      </div>
                      <!-- ./col -->
                    </div>

                      <div class="row">
                        <div class="col-xs-7 col-md-6 text-center">
                            <div class="form-group">
                              <label class="col-sm-2 control-label" style="text-align: left; padding-left: 20pt">Nama</label>

                              <div class="col-sm-9" style="padding-left: 30pt">
                                <input type="text" class="form-control" value="{{$data->nama_ibu}}" name="nama_I" required>
                              </div>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-xs-7 col-md-6 text-center">
                            <div class="form-group">
                              <label class="col-sm-2 control-label" style="text-align: left; padding-left: 20pt">NIK</label>

                              <div class="col-sm-9">
                                <input type="text" class="form-control" name="nik_I" value="{{$data->nik_ibu}}" maxlength="16" required>
                              </div>
                            </div>
                        </div>
                        <!-- ./col -->
                      </div>
                      <!-- /.row -->
                      <div class="row">
                        <div class="col-xs-7 col-md-4 text-center">
                            <div class="form-group">
                              <label class="col-sm-3 control-label" style="text-align: left; padding-left: 20pt">Agama</label>

                              <div class="col-sm-9" style="padding-left: 30pt">
                                  <select class="form-control select2" style="width: 100%;" name="agama_I" value=" ">
                                    <option value="{{$data->agama_ibu}}" hidden>{{$data->agama_ibu}}</option>
                                    @foreach($agama as $isi)
                                    <option value="{{$isi}}">{{$isi}}</option>
                                    @endforeach
                                  </select>
                              </div>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-xs-7 col-md-6 text-center">
                            <div class="form-group">
                              <label class="col-sm-2 control-label" style="text-align: left; padding-left: 153pt">Alamat</label>

                              <div class="col-sm-7" style="padding-left: 47pt; padding-right: 0pt">
                                  <textarea class="form-control" id="alamatI" rows="3" name="alamat_I">{{$data->alamat_ibu}}</textarea>
                                  <input type="checkbox" name="a" value="alamatI" id="cekboxI" style="padding-left: 47pt"/>  Alamat sama dengan pasien
                              </div>
                            </div>
                        </div>

                      </div>

                      <div class="row">
                         <div class="col-xs-7 col-md-4 text-center">
                            <div class="form-group">
                              <label class="col-sm-3 control-label" style="text-align: left; padding-left: 20pt; padding-top: 0pt">Pekerjaan
                              </label>
                              <div class="col-sm-9" style="padding-left: 30pt">
                                <input type="text" class="form-control" value="{{$data->pekerjaan_ibu}}" name="pekerjaan_I" required>
                              </div>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-xs-7 col-md-8 text-center">
                            <div class="form-group">
                              <label class="col-sm-3 control-label" style="text-align: left; padding-left: 153pt">Pend. Terakhir
                              </label>
                              <div class="col-sm-4" style="padding-left: 47pt; padding-top: 0pt">
                                <input type="text" class="form-control" value="{{$data->pend_ibu}}" name="pendTerakhir_I" maxlength="3" required>
                              </div>
                        </div>
                      </div>
                      <!-- /.row -->
                      <div class="row">
                        <div class="col-xs-7 col-md-6 text-center">
                            <div class="form-group">
                              <label class="col-sm-3 control-label" style="text-align: left; padding-left: 30pt">No. Telepon</label>

                              <div class="col-sm-9" style="padding-left: 5pt">
                                <input type="text" class="form-control" value="{{$data->tlp_ibu}}" name="noTelp_I" maxlength="15" required>
                              </div>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-xs-7 col-md-6 text-center">
                            <div class="form-group">
                              <label class="col-sm-2 control-label" style="text-align: left; padding-left: 20pt">Email</label>

                              <div class="col-sm-9">
                                <input type="email" class="form-control" value="{{$data->email_ibu}}" name="email_I" maxlength="16" required>
                              </div>
                            </div>
                        </div>
                        <!-- ./col -->
                      </div>
                </div>
                <!-- end data ibu-->
              <!-- /.row -->
              <div class="row">
                <hr>
                <br>
                <br>
                <div class="col-xs-7 col-md-4 text-center">
                    <div class="form-group">
                      <label class="col-sm-4 control-label" style="text-align: left; padding-left: 20pt">Assesor</label>
                      <div class="col-sm-8" style="padding-left: 30pt">
                          <select class="form-control select2" style="width: 100%;" name="assesor" value=" " required>

                            @foreach($kar as $kar)
                              <option value="{{$kar->id_pegawai}}">{{$kar->nama}}</option>
                            @endforeach
                          </select>
                      </div>
                    </div>
                </div>
                <div class="col-xs-7 col-md-4 text-center">
                    <div class="form-group">
                      <label class="col-sm-5 control-label" style="text-align: left; padding-left: 20pt">Jenis Terapi</label>

                      <div class="col-sm-7 text-left">
                          @foreach($j_terapi as $j_terapi)
                          <input type="checkbox" name="J_terapi[]" value="{{$j_terapi->id_terapi}}">&nbsp;{{$j_terapi->terapi}}<br>
                          @endforeach
                      </div>
                    </div>
                </div>
                <!-- ./col -->
              </div>
              <!-- /.row -->
              <div class="row">
                <div class="col-xs-7 col-md-4 text-center">
                    <div class="form-group">
                        <label class="col-sm-5 control-label" style="text-align: left; padding-left: 20pt">Tanggal Mulai Terapi</label>

                        <div class="col-sm-7">
                          <div class="input-group date">
                            <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" class="form-control pull-right" id="tgl_mulai" name="tgl_mulai_terapi" value="@if ($count==0) @else {{$isiA->tgl_mulai_terapi}} @endif" required>
                          </div>
                          <!-- /.input group -->
                        </div>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-xs-7 col-md-4 text-center">
                    <div class="form-group">
                        <label class="col-sm-5 control-label" style="text-align: left; padding-left: 20pt">Tanggal Selesai Terapi</label>

                        <div class="col-sm-7">
                          <div class="input-group date">
                            <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" class="form-control pull-right" id="tgl_selesai" name="tgl_selesai_terapi" value="@if ($count==0) @else {{$isiA->tgl_selesai_terapi}} @endif" required>
                          </div>
                          <!-- /.input group -->
                        </div>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-xs-7 col-md-4 text-center">
                    <div class="form-group">
                      <label class="col-sm-5 control-label" style="text-align: left; padding-left: 20pt">Status</label>

                      <div class="col-sm-7">
                          <select class="form-control select2" style="width: 100%;" name="status" value=" " required>
                            <option value="{{$data->status_pasien}}" hidden>{{$data->status_pasien}}</option>
                            @foreach($status as $isi)
                            <option value="{{$isi}}">{{$isi}}</option>
                            @endforeach
                          </select>
                      </div>
                    </div>
                </div>
                <!-- ./col -->
              </div>
              <div class="row">
                <div class="button">
                    <ul style="padding-left: 680pt ">
                      <button type="submit" class="btn btn-success">Simpan</button>
                      <a href="{{url('/register-list')}}"><div class="btn btn-danger">Batal</div></a>
                    </ul>
                </div>
            <br>
            <br>
          <!-- ./col -->
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
</div>

@endsection
