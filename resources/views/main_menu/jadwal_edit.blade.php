@extends('template.style')
@section('isi')
<script>
</script>
  <div class = "content-wrapper">
    <!-- Content Header (Page header) -->
    <section class = "content-header">
      <h1>
        Tambah Jadwal Terapi
        <small>Tambah Jadwal Baru</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class = "content">
   <!-- row -->
      <div class = "row">
        <div class = "col-xs-12">
          <!-- jQuery Knob -->
          <div class = "box box-solid">
            <!-- /.box-header -->
            <form method = "post"  action="{{url('/edit_jadwal/store')}}" enctype="multipart/form-data" class="form-horizontal">
            {{ csrf_field() }}
              <div class = "box-body">
                @if(\Session::has('alert-success'))
                <div class = "alert alert-info alert-dismissible">
                  <button type = "button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h4><i class = "icon fa fa-check"></i> Success!</h4>
                  {{Session::get('alert-success')}}
                </div>
                @endif
                @if(\Session::has('alert'))
                <div class = "alert alert-danger alert-dismissible">
                  <button type = "button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h4><i class = "icon fa fa-check"></i> Warning!</h4>
                  {{Session::get('alert')}}
                </div>
                @endif
                <div class = "row">
                  <div class = "col-xs-7 col-md-12 text-left">
                      <div class = "form-group">
                        <label class = "col-sm-12"><h3>&nbsp;&nbsp;&nbsp;Atur Jadwal {{$tabel->namaP}}</h3>
                        <hr></label>
                      </div>
                  </div>
                   <!-- ./col -->
                </div>      
                <div class = "row">
                  <div class = "col-xs-8 col-md-12 text-left">
                      <div class = "form-group col-md-12">
                          
                          <div class = "col-sm-3">
                            <select class = "form-control select2" style="width: 100%;" name="keterangan" id="keterangan" value="{{$tabel->keterangan}}" required>
                            <option value = "">{{$tabel->keterangan}}</option>
                            <option value = "null">-- Pilih --</option>
                            @foreach($ket as $ket)
                            <option value = "{{$ket}}">{{$ket}}</option>
                            @endforeach
                            </select>
                          </div>

                          <div class = "col-sm-3">
                              <select class = "form-control select2" style="width: 100%;" name="pasien" value="{{$tabel->namaP}}" id="Pasien" required>
                                <option value = "">{{$tabel->namaP}}</option>
                                <option value = "null">-- Pilih --</option>
                                @foreach ($j_terapi as $P)
                                <option value = "{{$P->id_asses}}">{{$P->nama}}</option>    
                                @endforeach
                              </select>
                              <p id="demo"></p>
                              <script>
                                jQuery(document).ready(function(){
                                  $("#Pasien").change(function(e){
                                    e.preventDefault();
                                    var id_asses=$(this).val();
                                    
                                    jQuery.ajax({
                                    url: "{{ url('/jterapi_pasien') }}",
                                    method: 'post',
                                    dataType:'json',
                                    data: {"_token": "{{ csrf_token() }}","id_asses": id_asses},
                                    success: function(result){
                                      $('#J_Terapi').empty();
                                      $('#J_Terapi').append("<option value = 'null'>-- Pilih --</option>");
                                      $.each(result.j_terapi,function(key,value){
                                       $('#J_Terapi').append("<option value = "+value.id_terapipasien+">"+value.id_terapi+"</option>");
                                      });
                                    }});
                                  });
                                });
                              </script>
                          </div>

                          <div class = "col-sm-3">
                            <select class = "form-control select2" style="width: 100%;" name="Jterapi" id="J_Terapi" value="{{$tabel->id_terapipasien}}" required>
                                <option value = "">{{$tabel->id_terapi}}</option>
                                <option value = "null">-- Pilih --</option>
                                
                            </select>
                          </div>
                          <div class = "col-sm-3">
                            <select class = "form-control select2" style="width: 100%;" name="terapis" id="terapiss" value="{{$tabel->nama}}" required>
                              <option value = "">{{$tabel->nama}}</option>
                              <option value = "null">-- Pilih --</option>
                              @foreach($terapis as $isi)
                              <option value = "{{$isi->id_pegawai}}">{{$isi->nama}}</option>
                              @endforeach
                            </select>
                          </div>
                      </div>
                      <div class = "form-group col-md-12">
                        <div class = "col-sm-3">
                          <div class = "input-group date">
                            <div class = "input-group-addon">
                              <i class = "fa fa-calendar"></i>
                            </div>
                            <input type = "text" class="form-control pull-right" value="{{$tabel->tglterapi}}" id="datepicker" placeholder="Tanggal" name="tgl" required>
                          </div>
                        </div>                      
                      
                        <div class = "col-sm-3">
                            <input type = "time" class="form-control pull-right" value="{{$tabel->jam_masuk}}" placeholder="jam Masuk" name="jam_masuk" required>
                        </div>

                        <div class = "col-sm-3">
                            <input type = "time" class="form-control pull-right" value="{{$tabel->jam_keluar}}" placeholder="jam keluar" name="jam_keluar" required>
                        </div>
                        
                        <div class = "col-sm-3">
                            <input type = "text" class="form-control pull-right" placeholder="Biaya" value="{{$tabel->biaya}}" name="biaya" required>
                        </div>
                      </div>
                  </div>
                  <div class = "row col-xs-12 col-md-12" style="padding-top: 20px; padding-bottom: 20px; padding-left: 40px">
                      <div class = "col-sm-1 text-left">
                        <input type = "submit" class="btn btn-success" name="" value="Update">
                      </div>
                      <div class = "col-sm-1 text-left">
                        <a href = "{{url('/jadwal-terapi')}}"><div class="btn btn-danger">Batal</div></a> 
                      </div>
                  </div>
                </div>
              </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </form>

      <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
      <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

      <script>
          $(document).ready(function() {
              $('#tambahjadwal').DataTable();
          });
      </script>

    </section>
    <!-- /.content -->
  </div>
</div>

@endsection
