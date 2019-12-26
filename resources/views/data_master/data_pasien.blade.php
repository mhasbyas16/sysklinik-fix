@extends('template.style')
@section('isi')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data Master
        <small>Pasien</small>
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
                    <form class="form-horizontal" method="post" action="{{url('data-pasien/update')}}" enctype="multipart/form-data">
                      {{csrf_field()}}
                      <div class="box-body">
                        <div class="row">
                          <div class="col-xs-7 col-md-12 text-left">
                              <div class="form-group">
                                <label class="col-sm-12"><h3>Data Pasien</h3><hr></label>
                              </div>
                          </div>
                        </div>


                        <input type="hidden" class="form-control" name="id_pasien" value="{{$data->id_pasien}}">

                                          <div class="row">
                                            <div class="col-xs-7 col-md-8 text-center">
                                                <div class="form-group">
                                                  <label class="col-sm-2 control-label" style="text-align: left; padding-left: 20pt">Nama</label>

                                                  <div class="col-sm-10">
                                                    <input type="text" class="form-control" name="nama_P" value="{{Request::is('data-pasien/view/*') ? $data->nama:''}}" >
                                                  </div>
                                                </div>
                                            </div>
                                            <!-- ./col -->
                                            <div class="col-xs-7 col-md-4 text-center" >
                                                <div class="form-group">
                                                  <label class="col-sm-5 control-label" style="text-align: left; padding-left: 20pt">Jenis Kelamin</label>

                                                  <div class="col-sm-6">
                                                      <select class="form-control select2" style="width: 100%;" name="jk" value=" " >
                                                        <option value="{{Request::is('data-pasien/view/*') ? $data->jk:''}}" hidden > @if(Request::is('data-pasien/view/*')) @if($data->jk=='Perempuan')Perempuan @else Laki - Laki @endif @endif </option>
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
                                                      <textarea class="form-control" id="alamatP" rows="3" name="alamat_P">{{Request::is('data-pasien/view/*') ? $data->alamat:''}}</textarea>
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
                                                    <input type="text" class="form-control" value="{{Request::is('data-pasien/view/*') ? $data->tempat_lahir:''}}" name="tempat_lahir" >
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
                                                        <input type="text" class="form-control pull-right" value="{{Request::is('data-pasien/view/*') ? $data->tgl_lahir:''}}" id="datepicker" name="tanggal_lahir">
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
                                                    <input type="text" class="form-control" name="umur" value="{{Request::is('data-pasien/view/*') ? $umur:''}}" maxlength="3">
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
                                                    <input type="text" class="form-control" name="notelp_P" value="{{Request::is('data-pasien/view/*') ? $data->tlp:''}}" maxlength="15" >
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
                                                        <input type="text" class="form-control pull-right" value="{{Request::is('data-pasien/view/*') ? $data->tgl:''}}" id="datedaftar" name="tanggal_daftar">
                                                      </div>
                                                      <!-- /.input group -->
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- ./col -->
                                            <div class="col-xs-7 col-md-4 text-center">
                                                <div class="form-group">
                                                  <label class="col-sm-3 control-label" style="text-align: left; padding-left: 20pt">Agama</label>

                                                  <div class="col-sm-9" style="padding-left: 30pt">
                                                      <select class="form-control select2" style="width: 100%;" name="agama" value=" ">
                                                        <option value="{{Request::is('data-pasien/view/*') ? $data->agama:''}}" hidden>{{Request::is('data-pasien/view/*') ? $data->agama:''}}</option>
                                                        @foreach($agama as $isi)
                                                        <option value="{{$isi}}">{{$isi}}</option>
                                                        @endforeach

                                                      </select>
                                                  </div>
                                                </div>
                                            </div>
                                          </div>

                                          <!-- /.row -->
                                          <div class="row">
                                            <div class="col-xs-7 col-md-8 text-center">
                                                <div class="form-group">
                                                  <label class="col-sm-2 control-label" style="text-align: left; padding-left: 20pt">Keluhan</label>

                                                  <div class="col-sm-10">
                                                      <textarea class="form-control" rows="3" name="keluhan">{{Request::is('data-pasien/view/*') ? $data->keluhan:''}}</textarea>
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
                                                          <input type="text" class="form-control" value="{{Request::is('data-pasien/view/*') ? $data->foto:''}}" name="Nfoto" readonly>
                                                      </div>
                                                      <img id='img-upload' src="{{asset('foto/pasien')}}/{{Request::is('data-pasien/view/*') ? $data->foto:''}}" />
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
                                                            <input type="text" class="form-control" name="nama_A" value="{{Request::is('data-pasien/view/*') ? $data->nama_ayah:''}}" >
                                                          </div>
                                                        </div>
                                                    </div>
                                                    <!-- ./col -->
                                                    <div class="col-xs-7 col-md-6 text-center">
                                                        <div class="form-group">
                                                          <label class="col-sm-2 control-label" style="text-align: left; padding-left: 20pt">NIK</label>

                                                          <div class="col-sm-9">
                                                            <input type="text" class="form-control" name="nik_A" value="{{Request::is('data-pasien/view/*') ? $data->nik_ayah:''}}" maxlength="16" >
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
                                                                <option value="{{Request::is('data-pasien/view/*') ? $data->agama_ayah:''}}" hidden>{{Request::is('data-pasien/view/*') ? $data->agama_ayah:''}}</option>
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
                                                              <textarea class="form-control" id="alamatA" rows="3" name="alamat_A">{{Request::is('data-pasien/view/*') ? $data->alamat_ayah:''}}</textarea>
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
                                                            <input type="text" class="form-control" name="pekerjaan_A" value="{{Request::is('data-pasien/view/*') ? $data->pekerjaan:''}}">
                                                          </div>
                                                        </div>
                                                    </div>
                                                    <!-- ./col -->
                                                    <div class="col-xs-7 col-md-4 text-center">
                                                        <div class="form-group">
                                                          <label class="col-sm-3 control-label" style="text-align: left; padding-left: 153pt">Pend. Terakhir
                                                          </label>
                                                          <div class="col-sm-4" style="padding-left: 47pt; padding-top: 0pt">
                                                            <input type="text" class="form-control" value="{{Request::is('data-pasien/view/*') ? $data->pend_ayah:''}}" name="pendTerakhir_A">
                                                          </div>
                                                    </div>
                                                  </div>

                                                  <!-- /.row -->
                                                  <div class="row">
                                                    <div class="col-xs-7 col-md-6 text-center">
                                                        <div class="form-group">
                                                          <label class="col-sm-3 control-label" style="text-align: left; padding-left: 30pt">No. Telepon</label>

                                                          <div class="col-sm-9" style="padding-left: 5pt">
                                                            <input type="text" class="form-control" name="noTelp_A" value="{{Request::is('data-pasien/view/*') ? $data->tlp_ayah:''}}" maxlength="15" >
                                                          </div>
                                                        </div>
                                                    </div>
                                                    <!-- ./col -->
                                                    <div class="col-xs-7 col-md-6 text-center">
                                                        <div class="form-group">
                                                          <label class="col-sm-2 control-label" style="text-align: left; padding-left: 20pt">Email</label>

                                                          <div class="col-sm-9">
                                                            <input type="email" class="form-control" name="email_A" value="{{Request::is('data-pasien/view/*') ? $data->email_ayah:''}}" maxlength="16" >
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
                                                            <input type="text" class="form-control" value="{{Request::is('data-pasien/view/*') ? $data->nama_ibu:''}}" name="nama_I" >
                                                          </div>
                                                        </div>
                                                    </div>
                                                    <!-- ./col -->
                                                    <div class="col-xs-7 col-md-6 text-center">
                                                        <div class="form-group">
                                                          <label class="col-sm-2 control-label" style="text-align: left; padding-left: 20pt">NIK</label>

                                                          <div class="col-sm-9">
                                                            <input type="text" class="form-control" name="nik_I" value="{{Request::is('data-pasien/view/*') ? $data->nik_ibu:''}}" maxlength="16" >
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
                                                                <option value="{{Request::is('data-pasien/view/*') ? $data->agama_ibu:''}}" hidden>{{Request::is('data-pasien/view/*') ? $data->agama_ibu:''}}</option>
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
                                                              <textarea class="form-control" id="alamatI" rows="3" name="alamat_I">{{Request::is('data-pasien/view/*') ? $data->alamat_ibu:''}}</textarea>
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
                                                            <input type="text" class="form-control" value="{{Request::is('data-pasien/view/*') ? $data->pekerjaan_ibu:''}}" name="pekerjaan_I">
                                                          </div>
                                                        </div>
                                                    </div>
                                                    <!-- ./col -->
                                                    <div class="col-xs-7 col-md-8 text-center">
                                                        <div class="form-group">
                                                          <label class="col-sm-3 control-label" style="text-align: left; padding-left: 153pt">Pend. Terakhir
                                                          </label>
                                                          <div class="col-sm-4" style="padding-left: 47pt; padding-top: 0pt">
                                                            <input type="text" class="form-control" value="{{Request::is('data-pasien/view/*') ? $data->pend_ibu:''}}" name="pendTerakhir_I">
                                                          </div>
                                                    </div>
                                                  </div>
                                                  <!-- /.row -->
                                                  <div class="row">
                                                    <div class="col-xs-7 col-md-6 text-center">
                                                        <div class="form-group">
                                                          <label class="col-sm-3 control-label" style="text-align: left; padding-left: 30pt">No. Telepon</label>

                                                          <div class="col-sm-9" style="padding-left: 5pt">
                                                            <input type="text" class="form-control" value="{{Request::is('data-pasien/view/*') ? $data->tlp_ibu:''}}" name="noTelp_I" maxlength="15" >
                                                          </div>
                                                        </div>
                                                    </div>
                                                    <!-- ./col -->
                                                    <div class="col-xs-7 col-md-6 text-center">
                                                        <div class="form-group">
                                                          <label class="col-sm-2 control-label" style="text-align: left; padding-left: 20pt">Email</label>

                                                          <div class="col-sm-9">
                                                            <input type="email" class="form-control" value="{{Request::is('data-pasien/view/*') ? $data->email_ibu:''}}" name="email_I" maxlength="16" >
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
                                                      <select class="form-control select2" style="width: 100%;" name="assesor" value=" " >
                                                        <option value="@if(Request::is('data-pasien/view/*')) @if ($count==0) @else @endif @endif" hidden>@if(Request::is('data-pasien/view/*')) @if ($count==0)-- Select One -- @else  @endif @endif</option>
                                                        @foreach($kar as $kar)
                                                          <option value="{{$kar->nama}}">{{$kar->nama}}</option>
                                                        @endforeach

                                                      </select>
                                                  </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-7 col-md-4 text-center">
                                                <div class="form-group">
                                                  <label class="col-sm-5 control-label" style="text-align: left; padding-left: 20pt">Jenis Terapi</label>

                                                  <div class="col-sm-7">
                                                      <select class="form-control select2" style="width: 100%;" name="J_terapi" value=" " >
                                                        <option value="@if(Request::is('data-pasien/view/*')) @if ($count==0) @else  @endif @endif" hidden>@if(Request::is('data-pasien/view/*')) @if ($count==0) -- Select One -- @else  @endif @endif</option>
                                                        @foreach($j_terapi as $j_terapi)
                                                        <option value="{{$j_terapi->id_terapi}}">{{$j_terapi->terapi}}</option>
                                                        @endforeach

                                                      </select>
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
                                                        <input type="text" class="form-control pull-right" id="tgl_mulai" name="tgl_mulai_terapi" value="@if(Request::is('data-pasien/view/*')) @if ($count==0) @else {{$isiA->tgl_mulai_terapi}} @endif @endif" >
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
                                                        <input type="text" class="form-control pull-right" id="tgl_selesai" name="tgl_selesai_terapi" value="@if(Request::is('data-pasien/view/*')) @if ($count==0) @else {{$isiA->tgl_selesai_terapi}} @endif @endif" >
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
                                                      <select class="form-control select2" style="width: 100%;" name="status" value=" " >
                                                        <option value="{{Request::is('data-pasien/view/*') ? :''}}" hidden>{{Request::is('data-pasien/view/*') ? :''}}</option>
                                                        @foreach($status as $isi)
                                                        <option value="#">#</option>
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
                                                  <a href="{{url('/data-pasien')}}"><div class="btn btn-danger">Batal</div></a>
                                                </ul>
                                            </div>
                                        <br>
                                        <br>
                                      <!-- ./col -->
                                          </div>
                                        </div>

                                      </form>
          </section>
    <!-- /.content -->
  </div>

@endsection
