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
    <!-- row -->
              <div class="row">
                <div class="col-xs-12">
                  <!-- jQuery Knob -->
                  <div class="box box-solid">
                    <div class="box-header">
                      <i class="fa fa-bar-chart-o"></i>
                      <h3 class="box-title">Tabel Pasien</h3>
                    </div>

                    <!-- /.box-header -->
                    <div class="box-body">
                      <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>No</th>
                      <th>ID Pasien</th>
                      <th>Nama</th>
                      <th>ID Asses</th>
                      <th>Assesor</th>
                      <th>Status</th>
                      <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                      @php
                          $no=1;
                      @endphp
                      @foreach($data as $data)
                      <tr>
                        <td>{{$no}}</td>
                        <td>{{$data->id_pasien}}</td>
                        <td>{{$data->namaPAS}}</td>
                        <td>{{$data->id_asses}}</td>
                        <td>{{$data->namaPEG}}</td>
                        <td>{{$data->status_pasien}}</td>
                        <td>
                          <div class="btn-group">
                                <a href="{{url('/data-pasien/view')}}/{{$data->id_pasien}}">
                                  <button class="btn btn-info">Edit</button></a>
                                <a href="{{url('/data-pasien/record')}}/{{$data->id_pasien}}">
                                  <button  type="button" class="btn btn-success">Record</button></a>
                                <a href="#">
                                  <button  type="button" class="btn btn-warning" data-toggle="modal" data-target="#{{$data->id_pasien}}">Info</button></a>
                          </div>
                        </td>
                        <!--modals-->
                          <div class="modal fade" id="{{$data->id_pasien}}">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                  <h4 class="modal-title">Info Pasien</h4>
                                </div>
                                <div class="modal-body">
                                  <div class="text-center col-sm-4">
                                    <img src="{{asset('foto/pasien')}}/{{$data->foto}}" alt="{{$data->nama}}" style="width:100%"/>
                                  </div>
                                  <div class="col-sm-8">
                                  <pre>
ID Pasien     : {{$data->id_pasien}}
Nama          : {{$data->namaPAS}}
Tanggal Lahir : {{$data->tgl_lahir}}
Jenis Kelamin : {{$data->jk}}
Agama         : {{$data->agama}}
No Telepon    : {{$data->tlp}}
Alamat        : {{$data->alamat}}
email         : {{$data->email}}
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
                      @php
                          $no++;
                      @endphp    
                      @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>No</th>
                        <th>ID Pasien</th>
                        <th>Nama</th>
                        <th>ID Asses</th>
                        <th>Assesor</th>
                        <th>Status</th>
                        <th>Batal</th>
                    </tr>
                    </tfoot>
                  </table>
                    </div>
                    <!-- /.box-body -->
                  </div>
                </div>
              </div>
          </section>
    <!-- /.content -->
  </div>
</div>
</div>

@endsection
