@extends('template.style')
@section('isi')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Alat Terapi
        <small>Daftar Alat Terapi</small>
      </h1>
    </section>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            $('#jenisterapi').on('change', function(e){
                var id = e.target.value;
                var idd = $('#idd').val(); 
                $('#idat').val(id+idd);
            });
        });
    </script>

    <!-- Main content -->
    <section class="content">

      <!-- row -->
      <div class="row">
        <div class="col-xs-12">
          <!-- jQuery Knob -->
          <div class="box box-solid">

            <!-- begin data alat-->
            @if(ISSET($namaat))
              @foreach($namaat as $nama)
                <form class="form-horizontal" action="{{url('alatterapi/'.$nama->id_barang)}}" method="post">
                  @csrf
                  @method("PATCH")
                  <div class="box-body">
                    <div class="row">
                      <div class="col-xs-7 col-md-12 text-left">
                          <div class="form-group">
                            <label class="col-sm-12"><h3>Input Alat Terapi</h3><hr></label>
                          </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-xs-7 col-md-8 text-center">
                          <div class="form-group">
                            <label class="col-sm-4 control-label" style="text-align: left; padding-left: 40pt">Jenis Terapi</label>

                            <div class="col-sm-7">
                              <select class="form-control select2" name="jenisterapi " id="jenisterapi" onchange="readURL(this);">
                                <option selected hidden disabled>Jenis Terapi</option>
                                @foreach($jenis as $namajenis)
                                <option value="{{$namajenis->id_terapi}}">{{$namajenis->id_terapi}}</option>
                                @endforeach
                              </select>
                            </div>
                          </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-xs-7 col-md-8 text-center">
                          <div class="form-group">
                            <label class="col-sm-4 control-label" style="text-align: left; padding-left: 40pt">ID Alat Terapi</label>
                            <div class="col-sm-7">
                               <input type="text" name="idd" id="idd" value="{{$acak}}" hidden="true">
                               <input type="text" class="form-control" name="idat" id="idat" value="{{$nama->id_barang}}" readonly>
                            </div>
                          </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-xs-7 col-md-8 text-center">
                          <div class="form-group">
                            <label class="col-sm-4 control-label" style="text-align: left; padding-left: 40pt">Nama Alat Terapi</label>

                            <div class="col-sm-7">
                                <input type="text" class="form-control" name="namaat" value="{{$nama->nama_barang}}" required>
                            </div>
                          </div>
                      </div>
                    </div>     

                    <div class="row">
                  <div class="col-xs-7 col-md-8 text-center">
                      <div class="form-group">
                        <label class="col-sm-4 control-label" style="text-align: left; padding-left: 40pt">Stok Awal</label>

                        <div class="col-sm-7">
                            <input type="text" class="form-control" name="stokawal" required>
                        </div>
                      </div>
                  </div>
                </div>
                    
                    <div class="button">
                      <ul class="left" style="padding-left: 385pt ">
                        <button class="btn btn-success" href="#">Simpan</button>
                        <button class="btn btn-secondary" href="#">Batal</button>
                      </ul>
                    </div>
                  </div>
                </form>
                @endforeach
            @else
            <form class="form-horizontal" action="{{url('alatterapi')}}" method="post">
              @csrf
              <div class="box-body">
                <div class="row">
                  <div class="col-xs-7 col-md-12 text-left">
                      <div class="form-group">
                        <label class="col-sm-12"><h3>Input Alat Terapi</h3><hr></label>
                      </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-xs-7 col-md-8 text-center">
                      <div class="form-group">
                        <label class="col-sm-4 control-label" style="text-align: left; padding-left: 40pt">Jenis Terapi</label>
                        <div class="col-sm-7">
                          <select class="form-control select2" name="jenisterapi" id="jenisterapi" onchange="readURL(this);">
                            <option selected hidden disabled>Jenis Terapi</option>
                            @foreach($jenis as $namajenis)
                            <option value="{{$namajenis->id_terapi}}">{{$namajenis->id_terapi}}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-xs-7 col-md-8 text-center">
                      <div class="form-group">
                        <label class="col-sm-4 control-label" style="text-align: left; padding-left: 40pt">ID Alat Terapi</label>

                        <div class="col-sm-7">
                          <input type="text" name="idd" id="idd" value="{{$acak}}" hidden="true">
                          <input type="text" class="form-control" name="idat" id="idat" readonly>
                        </div>
                      </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-xs-7 col-md-8 text-center">
                      <div class="form-group">
                        <label class="col-sm-4 control-label" style="text-align: left; padding-left: 40pt">Nama Alat Terapi</label>

                        <div class="col-sm-7">
                            <input type="text" class="form-control" name="namaat" required>
                        </div>
                      </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-xs-7 col-md-8 text-center">
                      <div class="form-group">
                        <label class="col-sm-4 control-label" style="text-align: left; padding-left: 40pt">Stok Awal</label>

                        <div class="col-sm-7">
                            <input type="text" class="form-control" name="stokawal" required>
                        </div>
                      </div>
                  </div>
                </div>              
                
                <div class="button">
                  <ul class="left" style="padding-left: 385pt ">
                    <button class="btn btn-success" href="#">Simpan</button>
                    <button class="btn btn-secondary" href="#">Batal</button>
                  </ul>
                </div>
              </div>
            </form>
            @endif
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- row -->
      <div class="row">
        <div class="col-xs-12">
          <!-- jQuery Knob -->
          <div class="box box-solid">
            <div class="box-header">
              <i class="fa fa-bar-chart-o"></i>
              <h3 class="box-title">Tabel Alat Terapi</h3>
            </div>
            
            <div class="box-body">
              <table id="pegawais" class="table table-bordered table-striped text-center">
                <thead>
                <tr>
                  <th>ID Barang</th>
                  <th>Nama Barang</th>
                  <th>Stok Awal</th>
                  <th>Aksi</th>

                </tr>
                </thead>
                <tbody>
                @foreach($at as $x)
                <tr>
                  <td><a href="{{url('alatterapi/'. $x->id_barang.'/edit')}}">{{$x->id_barang}}</a></td>
                  <td><a href="{{url('alatterapi/'. $x->id_barang.'/edit')}}">{{$x->nama_barang}}</a></td>
                  <td><a href="{{url('alatterapi/'. $x->id_barang.'/edit')}}">{{$x->stok_awal}}</a></td>
                  <td>
                    <form action="{{ url('alatterapi', $x->id_barang) }}" method="post">
                        @csrf
                        @method("DELETE")
                        <input type="submit" class="btn btn-danger btn-sm" href="{{ $x->id_barang }}" value="Delete">
                    </form>
                  </td>
                </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                  <th>ID Barang</th>
                  <th>Nama Barang</th>
                  <th>Stok Awal</th>
                  <th>Aksi</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->

    <script type="text/javascript">
      $(document).ready(function() {
          $('.js-example-basic-multiple').select2();
      });
    </script>
  </div>

@endsection
