@extends('template.style')
@section('isi')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data Master
        <small>Pegawai</small>
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
                    <div class="box-header">
                      <i class="fa fa-bar-chart-o"></i>
                      <h3 class="box-title">Tabel Pegawai</h3>
                    </div>

                    <!-- /.box-header -->
                    <div class="box-body">
                      @if(\Session::has('alert'))
                      <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-check"></i> Success!</h4>
                        {{Session::get('alert')}}
                      </div>
                      @elseif (\Session::has('alertwarn'))
                      <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-check"></i> Success!</h4>
                        {{Session::get('alertwarn')}}
                      </div>
                      @endif
                      <table id="pegawais" class="table table-bordered table-striped text-center">
                        <thead>
                        <tr>
                          <th>ID Karyawan</th>
                          <th>Nama</th>
                          <th>Jabatan</th>
                          <th>Alamat</th>
                          <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                          @foreach($data as $data)
                        <tr>
                          <td>{{$data->id_pegawai}}</td>
                          <td>{{$data->nama}}</td>
                          <td>{{$data->jabatan}}</td>
                          <td>{{$data->alamat}}</td>
                          <td><div class="btn-group">
                              <a href="{{url('/karyawan/edit-data')}}/{{$data->id_pegawai}}">
                                <button type="button" class="btn btn-success">Edit</button></a>
                              <a href="{{url('/karyawan/hapus-data')}}/{{$data->id_pegawai}}" onclick="return confirm('Apakah Anda Yakin Menghapus Data Ini?')">
                                <button type="button" class="btn btn-danger">Delete</button></a>
                              <a href="#">
                                <button  type="button" class="btn btn-info" data-toggle="modal" data-target="#{{$data->id_pegawai}}">Info</button></a>
                          </div></td>

                          <!--modals-->
                          <div class="modal fade" id="{{$data->id_pegawai}}">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                  <h4 class="modal-title">Info karyawan</h4>
                                </div>
                                <div class="modal-body">
                                  <div class="text-center col-sm-4">
                                    <img src="{{asset('foto/pegawai')}}/{{$data->foto}}" alt="{{$data->nama}}" style="width:100%"/>
                                  </div>
                                  <div class="col-sm-8">
                                  <pre>
Nama          : {{$data->nama}}
NIK           : {{$data->nik}}
ID Karyawan   : {{$data->id_pegawai}}
Jabatan       : {{$data->jabatan}}
Jenis Terapi  : {{$data->terapi}}
Tanggal Lahir : {{$data->tgl_lahir}}
Jenis Kelamin : {{$data->jk}}
Agama         : {{$data->agama}}
No Telepon    : {{$data->tlp}}
Alamat        : {{$data->alamat}}
Pend Terakhir : {{$data->pend_akhir}}
Tanggal Masuk : {{$data->tgl_masuk}}
NO. BPJS      : {{$data->bpjs}}
NO. NPWP      : {{$data->npwp}}
                                  </pre>
                                </div>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>

                                </div>
                              </div>
                              <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                          </div>
                          <!-- /.modal -->
                        </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>ID Karyawan</th>
                            <th>Nama</th>
                            <th>Jabatan</th>
                            <th>Alamat</th>
                            <th>Aksi</th>
                        </tr>
                        </tfoot>
                      </table>
                      <div class="col-xs-3">
                      <a href="{{url('karyawan/tambah-data/terapis')}}" class="btn btn-block btn-social btn-google">
                        <i class="fa fa-user-plus"></i>Tambah Terapis
                      </a>
                    </div>
                    </div>
                    <!-- /.box-body -->
                  </div>
                </div>
              </div>
          </section>
    <!-- /.content -->
  </div>

@endsection
