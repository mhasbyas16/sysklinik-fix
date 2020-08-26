@extends('template.style')
@section('isi')

  <script type="text/javascript">
    window.onload=function(){
        $("#datepicker").on("change", function() {
            var dob = new Date(this.value);
            var today = new Date();
            var age = Math.floor((today-dob)/(365.25 * 24 * 60 * 60 * 1000));
            $("#umur").val(age+" tahun");
        });
        $('#alamatrumah').on('change', function() {
            var alamat = document.getElementById("alamatrumah").value;
            $('#alamatA').val(alamat);
            $('#alamatI').val(alamat);
        });
    }
  </script>

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Main Menu
        <small>Register List / Pendaftaran Baru</small>
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
            <form method="post" action="{{url('/toregist/save')}}" enctype="multipart/form-data" class="form-horizontal">
              {{csrf_field()}}
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
                              <label class="col-sm-12"><h3>Data Pribadi</h3>
                              <hr>
                              </label>
                            </div>
                        </div>
                        <!-- ./col -->
                </div>
                <?php
                  $datenow = date('yy-m-d');
                  
                  $angka=range(0,9);
                  shuffle($angka);
                  $id=array_rand($angka,3);
                  $idstring=implode($id);
                  $id_asses=$idstring;

                  $now = date('dmy');
                  $dataakhir = \App\m_Hpasien::max('id_pasien');
                  $no = $dataakhir;
                  $lama = substr($no, 0, 6);
                  $rplc = str_replace($lama, $now, $id_asses);
                  $idnew = $now.$rplc;
                ?>
                <input type="text" name="id_pasien" value="{{$idnew}}"  />

                <div class="row">
                  <div class="col-xs-7 col-md-8 text-center">
                      <div class="form-group">
                        <label class="col-sm-2 control-label" style="text-align: left; padding-left: 20pt">Nama</label>

                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="nama_P" required>
                        </div>
                      </div>
                  </div>
                  <!-- ./col -->
                  <div class="col-xs-7 col-md-4 text-center" >
                      <div class="form-group">
                        <label class="col-sm-5 control-label" style="text-align: left; padding-left: 20pt">Jenis Kelamin</label>

                        <div class="col-sm-6">
                            <select class="form-control select2" style="width: 100%;" name="jk" required>
                              <option value="Pilih">Pilih</option>
                              <option value="Laki-laki">Laki-Laki</option>
                              <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                      </div>
                  </div>
                  <!-- ./col -->
                </div>

                <div class="row">
                  <div class="col-xs-7 col-md-4 text-center">
                      <div class="form-group">
                        <label class="col-sm-4 control-label" style="text-align: left; padding-left: 20pt">Tempat Lahir</label>

                        <div class="col-sm-7">
                          <input type="text" class="form-control" name="tempat_lahir" required>
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
                              <input type="text" class="form-control pull-right" id="datepicker" name="tanggal_lahir" required>
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
                          <input type="text" class="form-control" name="umur" id="umur" maxlength="3" required>
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
                          <input type="text" class="form-control" name="notelp_P" maxlength="15" required>
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
                              <input type="text" class="form-control pull-right" id="datedaftar" name="tanggal_daftar" disabled="true" value="{{$datenow}}">
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
                              <option value="Pilih">Pilih</option>
                              <option value="Islam">Islam</option>
                              <option value="Kristen">Kristen</option>
                              <option value="Katolik">Katolik</option>
                              <option value="Protestan">Protestan</option>
                              <option value="Hindu">Hindu</option>
                              <option value="Buddha">Buddha</option>
                            </select>
                        </div>
                      </div>
                  </div>
                </div>

                <div>
                  <div class="row">
                    <div class="col-xs-7 col-md-8 text-center">
                        <div class="form-group">
                          <label class="col-sm-2 control-label" style="text-align: left; padding-left: 20pt">Alamat Rumah</label>

                          <div class="col-sm-10">
                              <textarea class="form-control" rows="3" name="alamatrumah" id="alamatrumah" required></textarea>
                          </div>
                        </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-xs-7 col-md-8 text-center">
                        <div class="form-group">
                          <label class="col-sm-2 control-label" style="text-align: left; padding-left: 20pt">Alamat Sekolah</label>

                          <div class="col-sm-10">
                              <textarea class="form-control" rows="3" name="alamatsekolah"></textarea>
                          </div>
                        </div>
                    </div>
                  </div>
                </div>
                
                <div class="row">
                  <div class="col-xs-7 col-md-8 text-center">
                      <div class="form-group">
                        <label class="col-sm-2 control-label" style="text-align: left; padding-left: 20pt">Keluhan</label>

                        <div class="col-sm-10">
                            <textarea class="form-control" rows="3" name="keluhan" required></textarea>
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
                                <input type="text" class="form-control" name="Nfoto" readonly>
                            </div>
                            
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

                                <div class="col-sm-9" style="padding-left: 45pt">
                                  <input type="text" class="form-control" name="nama_A" required>
                                </div>
                              </div>
                          </div>
                          <!-- ./col -->
                          <div class="col-xs-7 col-md-6 text-center">
                              <div class="form-group">
                                <label class="col-sm-2 control-label" style="text-align: left; padding-left: 20pt">NIK</label>

                                <div class="col-sm-9">
                                  <input type="text" class="form-control" name="nik_A" maxlength="16" required>
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

                                <div class="col-sm-9" style="padding-left: 45pt">
                                    <select class="form-control select2" style="width: 100%;" name="agama_A" value=" ">
                                      <option value="Pilih">Pilih</option>
                                      <option value="Islam">Islam</option>
                                      <option value="Kristen">Kristen</option>
                                      <option value="Katolik">Katolik</option>
                                      <option value="Protestan">Protestan</option>
                                      <option value="Hindu">Hindu</option>
                                      <option value="Buddha">Buddha</option>
                                    </select>
                                </div>
                              </div>
                          </div>
                          <!-- ./col -->
                          <div class="col-xs-7 col-md-6 text-center">
                              <div class="form-group">
                                <label class="col-sm-2 control-label" style="text-align: left; padding-left: 175pt">Alamat</label>

                                <div class="col-sm-7" style="padding-left: 55pt; padding-right: 0pt">
                                    <textarea class="form-control" id="alamatA" rows="3" name="alamat_A"></textarea>
                                </div>
                              </div>
                          </div>

                        </div>
                        <!-- /.row -->
                        <div class="row">
                          <div class="col-xs-7 col-md-6 text-center">
                              <div class="form-group">
                                <label class="col-sm-3 control-label" style="text-align: left; padding-left: 20pt">Pekerjaan</label>

                                <div class="col-sm-9" style="padding-left: 5pt">
                                  <input type="text" class="form-control" name="pekerjaan_A" maxlength="15" required>
                                </div>
                              </div>
                          </div>
                          <!-- ./col -->
                          <div class="col-xs-7 col-md-6 text-center">
                              <div class="form-group">
                                <label class="col-sm-2 control-label" style="text-align: left; padding-left: 20pt">Pendidikan</label>

                                <div class="col-sm-9">
                                  <input type="text" class="form-control" name="pendTerakhir_A" required>
                                </div>
                              </div>
                          </div>
                          <!-- ./col -->
                        </div>
                        <!-- /.row -->
                        <div class="row">
                          <div class="col-xs-7 col-md-6 text-center">
                              <div class="form-group">
                                <label class="col-sm-3 control-label" style="text-align: left; padding-left: 20pt">No. Telepon</label>

                                <div class="col-sm-9" style="padding-left: 5pt">
                                  <input type="text" class="form-control" name="noTelp_A" maxlength="15" required>
                                </div>
                              </div>
                          </div>
                          <!-- ./col -->
                          <div class="col-xs-7 col-md-6 text-center">
                              <div class="form-group">
                                <label class="col-sm-2 control-label" style="text-align: left; padding-left: 20pt">Email</label>

                                <div class="col-sm-9">
                                  <input type="email" class="form-control" name="email_A" required>
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

                                <div class="col-sm-9" style="padding-left: 45pt">
                                  <input type="text" class="form-control" name="nama_I" required>
                                </div>
                              </div>
                          </div>
                          <!-- ./col -->
                          <div class="col-xs-7 col-md-6 text-center">
                              <div class="form-group">
                                <label class="col-sm-2 control-label" style="text-align: left; padding-left: 20pt">NIK</label>

                                <div class="col-sm-9">
                                  <input type="text" class="form-control" name="nik_I" maxlength="16" required>
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

                                <div class="col-sm-9" style="padding-left: 45pt">
                                    <select class="form-control select2" style="width: 100%;" name="agama_I" value=" ">
                                      <option value="Pilih">Pilih</option>
                                      <option value="Islam">Islam</option>
                                      <option value="Kristen">Kristen</option>
                                      <option value="Katolik">Katolik</option>
                                      <option value="Protestan">Protestan</option>
                                      <option value="Hindu">Hindu</option>
                                      <option value="Buddha">Buddha</option>
                                    </select>
                                </div>
                              </div>
                          </div>
                          <!-- ./col -->
                          <div class="col-xs-7 col-md-6 text-center">
                              <div class="form-group">
                                <label class="col-sm-2 control-label" style="text-align: left; padding-left: 175pt">Alamat</label>

                                <div class="col-sm-7" style="padding-left: 55pt; padding-right: 0pt">
                                    <textarea class="form-control" id="alamatI" rows="3" name="alamat_I"></textarea>
                                </div>
                              </div>
                          </div>

                        </div>
                        <!-- /.row -->
                        <div class="row">
                          <div class="col-xs-7 col-md-6 text-center">
                              <div class="form-group">
                                <label class="col-sm-3 control-label" style="text-align: left; padding-left: 20pt">Pekerjaan</label>

                                <div class="col-sm-9" style="padding-left: 5pt">
                                  <input type="text" class="form-control" name="pekerjaan_I" maxlength="15" required>
                                </div>
                              </div>
                          </div>
                          <!-- ./col -->
                          <div class="col-xs-7 col-md-6 text-center">
                              <div class="form-group">
                                <label class="col-sm-2 control-label" style="text-align: left; padding-left: 20pt">Pendidikan</label>

                                <div class="col-sm-9">
                                  <input type="text" class="form-control" name="pendTerakhir_I" required>
                                </div>
                              </div>
                          </div>
                          <!-- ./col -->
                        </div>
                        <!-- /.row -->
                        <div class="row">
                          <div class="col-xs-7 col-md-6 text-center">
                              <div class="form-group">
                                <label class="col-sm-3 control-label" style="text-align: left; padding-left: 20pt">No. Telepon</label>

                                <div class="col-sm-9" style="padding-left: 5pt">
                                  <input type="text" class="form-control" name="noTelp_I" maxlength="15" required>
                                </div>
                              </div>
                          </div>
                          <!-- ./col -->
                          <div class="col-xs-7 col-md-6 text-center">
                              <div class="form-group">
                                <label class="col-sm-2 control-label" style="text-align: left; padding-left: 20pt">Email</label>

                                <div class="col-sm-9">
                                  <input type="email" class="form-control" name="email_I" required>
                                </div>
                              </div>
                          </div>
                          <!-- ./col -->
                        </div>
                    </div>
                    <!-- end data ibu-->


                    <div class="box-body">
                      <div class="row">
                        <div class="col-xs-7 col-md-12 text-left">
                            <div class="form-group">
                              <label class="col-sm-12"><h3>Data Pelengkap</h3><hr></label>
                            </div>
                        </div>
                      </div>

                        <div class="row">
                              <div class="form-group">
                                <label class="col-sm-2 control-label" style="text-align: left; padding-left: 20pt">Hasil Tes IQ</label>

                                <div class="col-sm-4">
                                  <input type="text" class="form-control" name="iq">
                                </div>
                              </div>
                        </div>
                        <div class="row">
                              <div class="form-group">
                                <label class="col-sm-2 control-label" style="text-align: left; padding-left: 20pt">Nilai Mapel (-)</label>

                                <div class="col-sm-4">
                                  <input type="text" class="form-control" name="mapel">
                                </div>
                              </div>
                        </div>
                        <div class="row">
                              <div class="form-group">
                                <label class="col-sm-2 control-label" style="text-align: left; padding-left: 20pt">Mengulang Kelas</label>

                                <div class="col-sm-4">
                                  <input type="text" class="form-control" name="ulang">
                                </div>
                              </div>
                        </div>
                    </div>
                    <!-- end data pelengkap-->

                    <div class="box-body">
                      <div class="row">
                        <div class="col-xs-7 col-md-12 text-left">
                            <div class="form-group">
                              <label class="col-sm-12"><h3>Pengisi Kuesioner</h3><hr></label>
                            </div>
                        </div>
                      </div>

                        <div class="row">
                          <div class="col-xs-7 col-md-6 text-center">
                              <div class="form-group">
                                <label class="col-sm-2 control-label" style="text-align: left; padding-left: 20pt">Nama</label>

                                <div class="col-sm-9" style="padding-left: 30pt">
                                  <input type="text" class="form-control" name="isinama">
                                </div>
                              </div>
                          </div>
                          <div class="col-xs-7 col-md-6 text-center">
                              <div class="form-group">
                                <label class="col-sm-2 control-label" style="text-align: left; padding-left: 20pt">Selaku</label>

                                <div class="col-sm-9" style="padding-left: 30pt">
                                  <input type="text" class="form-control" name="isiselaku">
                                </div>
                              </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-xs-7 col-md-6 text-center">
                              <div class="form-group">
                                <label class="col-sm-2 control-label" style="text-align: left; padding-left: 20pt">Pendidikan</label>

                                <div class="col-sm-9" style="padding-left: 30pt">
                                  <input type="text" class="form-control" name="isipendidikan">
                                </div>
                              </div>
                          </div>
                          <div class="col-xs-7 col-md-6 text-center">
                              <div class="form-group">
                                <label class="col-sm-2 control-label" style="text-align: left; padding-left: 20pt">Pekerjaan</label>

                                <div class="col-sm-9" style="padding-left: 30pt">
                                  <input type="text" class="form-control" name="isipekerjaan">
                                </div>
                              </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-xs-7 col-md-6 text-center">
                              <div class="form-group">
                                <label class="col-sm-2 control-label" style="text-align: left; padding-left: 20pt">Alamat</label>

                                <div class="col-sm-9" style="padding-left: 30pt">
                                  <textarea name="isialamat" rows="3" class="form-control"></textarea>
                                </div>
                              </div>
                          </div>
                        </div>
                    </div>
                    <!-- end data pengisi-->

                
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
