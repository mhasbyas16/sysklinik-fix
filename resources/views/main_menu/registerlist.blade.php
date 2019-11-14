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
`   <!-- row -->
      <div class="row">
        <div class="col-xs-12">
          <!-- jQuery Knob -->
          <div class="box box-solid">
            <div class="box-body">
              @if(\Session::has('alert'))
              <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> Success!</h4>
                {{Session::get('alert')}}
              @endif
              </div>
                <section class="content">
              <div class="row">
                <div class="col-xs-12">
                  <!-- jQuery Knob -->
                  <div class="box box-solid">
                    <div class="box-header">
                      <i class="fa fa-bar-chart-o"></i>
                      <h3 class="box-title">Tabel Register List</h3>
                    </div>

                    <!-- /.box-header -->
                    <div class="box-body">
                      <!--
                    <form method="post" action="{{url('/register-list/filter-date')}}">
                      <table border="0" cellspacing="5" cellpadding="5">
                        <tbody><tr>
                          <td>Dari </td>
                          <td> : </td>
                          <td><div class="input-group date">
                              <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                              </div>
                                <input type="date" class="form-control" name="min" required>
                              </div>
                          </td>
                          <td>-</td>
                          <td><div class="input-group date">
                              <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                              </div>
                              <input type="date" class="form-control" name="max" required>
                            </div>
                        </td>
                        <td><select class="form-control" name="pilih" value=" " required>
                          <option value="tgl_daftar">Tanggal Daftar</option>
                          <option value="tgl_asses">Tanggal Asses</option>
                        </select></td>
                        <td>&nbsp;&nbsp;&nbsp;</td>
                        <td><button type="submit" class="btn btn-information"><i class="fa fa-search"></i></button></td>
                        </form>
                        <td>&nbsp;&nbsp;&nbsp;</td>
                        <td><a href="{{url('/register-list')}}"><button type="button" class="btn btn-success">Clear</button></a></td>
                        </tr>
                      </tbody></table>
-->
                      <br>
                      <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>Nama</th>
                      <th>ID Asses</th>
                      <th>Status</th>
                      <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                      @foreach($isi as $data)
                      <tr>
                        <td>{{$data->nama}}</td>
                        <td>{{$data->id_asses}}</td>
                        <td><a href="{{url('/register-list')}}/{{$data->id_pasien}}">{{$data->status_pasien}}</a></td>
                        <td><div class="btn-group">
                        </div></td>
                      </tr>
                      @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Nama</th>
                        <th>ID Asses</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                    </tfoot>
                  </table>
                    </div>
                    <!-- /.box-body -->
                  </div>
                </div>
              </div>
          </section>
            </div>
          </div>
        </div>
      </div>
@endsection
