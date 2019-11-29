@extends('template.style')
@section('isi')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Setting
        <small>Account</small>
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
            <form class="form-horizontal" action="{{ url('/setting/'.$data->id_pegawai) }}" method="post">
              @csrf
              {{ method_field('PATCH') }}
              <div class="box-body">
                <div class="row">
                  <div class="col-xs-7 col-md-12 text-left">
                      <div class="form-group">
                        <label class="col-sm-12"><h3>Setting Account</h3><hr></label>
                      </div>
                  </div>
                  <!-- ./col -->
                </div>

                <div class="row">
                  <div class="col-xs-7 col-md-8 text-center">
                      <div class="form-group">
                        <label class="col-sm-4 control-label" style="text-align: left; padding-left: 40pt">Nama</label>

                        <div class="col-sm-7">
                          <input type="text" class="form-control" name="nama_P" @if($status == "") disabled @endif value="{{ $data->nama }}">
                        </div>
                      </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-xs-7 col-md-8 text-center">
                      <div class="form-group">
                        <label class="col-sm-4 control-label" style="text-align: left; padding-left: 40pt">Jabatan</label>

                        <div class="col-sm-7">
                          <select name="id_jabatan" class="form-control" @if($status == "") disabled @endif>
                            @foreach ($jabatan as $j)
                              <option value="{{ $j->id_jabatan }}"  @if($data->id_jabatan == $j->id_jabatan) selected @endif>{{ $j->jabatan }}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                  </div>
                </div> 

                {{-- <div class="row">
                  <div class="col-xs-7 col-md-8 text-center">
                      <div class="form-group">
                        <label class="col-sm-4 control-label" style="text-align: left; padding-left: 40pt">Email</label>

                        <div class="col-sm-7">
                          <input type="email" class="form-control" name="email" @if($status != "edit") disabled @endif value="{{ $data->email }}">
                        </div>
                      </div>
                  </div>
                </div> --}}

                <div class="row">
                  <div class="col-xs-7 col-md-8 text-center">
                      <div class="form-group">
                        <label class="col-sm-4 control-label" style="text-align: left; padding-left: 40pt">Password</label>

                        <div class="col-sm-7">
                            <input type="password" class="form-control" name="password" @if($status == "") disabled @endif value="{{ $data->password }}">
                        </div>
                      </div>
                  </div>
                </div>             
                
                @if ($status == "")
                  <div class="button">
                    <ul class="left" style="padding-left: 450pt ">
                      <a class="btn btn-primary" href="{{ url('/setting/'.$data->id_pegawai.'/edit') }}">Edit</a>
                    </ul>
                  </div>
                @elseif ($status == "edit")
                  <div class="button">
                    <ul class="left" style="padding-left: 450pt ">
                      <button class="btn btn-primary" type="submit">Update</button>
                    </ul>
                  </div>
                @endif

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

@endsection
