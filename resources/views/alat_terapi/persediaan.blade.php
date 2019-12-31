@extends('template.style')
@section('isi')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Alat Terapi
        <small>Persediaan Alat Terapi</small>
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
            <form class="form-horizontal">
            <div class="box-body">
              <div class="row">
                <div class="col-xs-7 col-md-12 text-left">
                    <div class="form-group">
                      <label class="col-sm-12"><h3>Tabel Persediaan Alat Terapi</h3><hr></label>
                    </div>
                </div>
              </div>

            <div class="box-body">
              <table id="pegawais" class="table table-bordered table-striped text-center">
                <thead>
                <tr>
                  <th>No</th>
                  <th>ID Barang</th>
                  <th>Nama Barang</th>
                  <th>Stok Awal</th>
                  <th>Stok</th>

                </tr>
                </thead>
                <tbody>
                  @php
                    $no=1;
                  @endphp
                  @foreach($at as $x)
                <tr>
                  <td>{{$no}}</td>
                  <td>{{$x->id_barang}}</td>
                  <td>{{$x->nama_barang}}</td>
                  <td>{{$x->stok_awal}}</td>
                  <td>{{$x->stok}}</td>
                </tr>
                  @php
                    $no++;
                  @endphp
                  @endforeach
                </tbody>
                <tfoot>
                <tr>
                  <th>No</th>
                  <th>ID Barang</th>
                  <th>Nama Barang</th>
                  <th>Stok Awal</th>
                  <th>Stok</th>
                </tr>
                </tfoot>
              </table>
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

@endsection
