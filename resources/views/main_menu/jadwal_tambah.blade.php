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
            <form method = ""  action="" enctype="multipart/form-data" class="form-horizontal">
            <div class = "box-body">
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
                            <label class = "col-sm-12"><h3>&nbsp;&nbsp;&nbsp;Atur jadwal Terapi</h3>
                            <hr></label>
                          </div>
                      </div>
                      <!-- ./col -->
              </div>
              
              <div class = "row">
                <div class = "col-xs-8 col-md-12 text-left">
                    <div class = "form-group col-md-12">
                        <div class = "col-sm-2">
                            <select class = "form-control select2" style="width: 100%;" name="pasien" value=" " id="Pasien" required>
                              @foreach ($pasien as $P)
                              <option value = "{{$P->id_asses}}">{{$P->nama}}</option>    
                              @endforeach
                              <option value = "null">-</option>
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
                    $.each(result.j_terapi,function(key,value){
                     $('#J_Terapi').append("<option value = "+value.id_terapipasien+">"+value.terapi+"</option>");
                    });
                    $('#J_Terapi').append("<option value = 'null'>-- Select One --</option>");
                  }});
               });
                            });</script>
                          </div>
                          <div class = "col-sm-2">
                              <select class = "form-control select2" style="width: 100%;" name="Jterapi" id="J_Terapi" value=" " required>
                                <option value = "null">-- Select One --</option>
                              </select>
                            </div>
                      <div class = "col-sm-2">
                        <div class = "input-group date">
                          <div class = "input-group-addon">
                            <i class = "fa fa-calendar"></i>
                          </div>
                          <input type = "text" class="form-control pull-right" value="" id="datepicker" placeholder="Tanggal" name="tgl" required>
                        </div>
                      </div>                      
                    
                      <div class = "col-sm-2">
                          <input type = "time" class="form-control pull-right" value="" placeholder="jam Masuk" name="jam_masuk" required>
                      </div>
                      <div class = "col-sm-2">
                          <input type = "time" class="form-control pull-right" value="" placeholder="jam keluar" name="jam_keluar" required>
                      </div>
                      <div class = "col-sm-2">
                          <select class = "form-control select2" style="width: 100%;" name="terapis" value=" " required>
                          @foreach($terapis as $isi)
                            <option value = "{{$isi->id_pegawai}}">{{$isi->nama}}</option>
                          @endforeach
                            <option value = "null">-</option>
                          </select>
                        </div>
                    </div>
                      <div class = "form-group col-md-12">
                      <div class = "col-sm-2">
                          <input type = "text" class="form-control pull-right" placeholder="Biaya" value="" name="biaya" required>
                      </div>
                    </div>
                </div>
              <div class = "row col-xs-12 col-md-12" style="padding-top: 20px; padding-bottom: 20px">
                  <div class = "col-sm-1 text-left">
                    <input type = "submit" class="btn btn-success" name="" value="Tambah">
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
    </section>
    <!-- /.content -->
  </div>
</div>

@endsection
