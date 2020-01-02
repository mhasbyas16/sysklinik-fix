@extends('template.style')
@section('isi')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Main Menu
        <small>Jadwal Terapi</small>
      </h1>
      <!--
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-files-o"></i> Main Menu</a></li>
        <li class="active">Assesment</li>
      </ol>
    -->
    </section>


    <!-- Main content -->
    <div class="container">
      <div class="row">
          <div class="col-md-10 col-xs-offset-1 ">
              <div class="panel panel-default">
                  <div class="panel-heading">Kalender Jadwal Keseluruhan</div>

                  <div class="panel-body">
                      {!! $calendar->calendar() !!}
                      {!! $calendar->script() !!}
                  </div>
              </div>
          </div>
      </div>
      <div>
      <br>
      <!-- Nav tabs -->
      <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active">
          <a href="#home" aria-controls="home" role="tab" data-toggle="tab">
            Jadwal Keseluruhan
            
          </a>
        </li>
        <li role="presentation">
          <a href="#assessment" aria-controls="profile" role="tab" data-toggle="tab">
            Asses Pasien
          @if($countassessment>=1)
            <span class="label label-info">{{$countassessment}}</span>
          @endif
          </a>
        </li>
        <li role="presentation">
          <a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">
            Request Jadwal Terapis
            @if($countrterapis>=1)
              <span class="label label-success">{{$countrterapis}}</span>
            @endif
          </a>
        </li>
        <li role="presentation">
          <a href="#izinT" aria-controls="profile" role="tab" data-toggle="tab">
            Request Izin Terapis
            @if($countizinrterapis>=1)
              <span class="label label-success">{{$countizinrterapis}}</span>
            @endif
            </a>
        </li>
        <li role="presentation">
          <a href="#profiles" aria-controls="profile" role="tab" data-toggle="tab">
            Request Izin Pasien
            @if($countrpasien>=1)
              <span class="label label-success">{{$countrpasien}}</span>
            @endif
          </a>
        </li>
      </ul>

      <!-- Tab panes -->
      <div class="tab-content">
        @include('main_menu.jadwalterapi-modal.jadwal-keseluruhan')
        @include('main_menu.jadwalterapi-modal.asses-pasien')
        @include('main_menu.jadwalterapi-modal.req-jadwal-terapis')
        @include('main_menu.jadwalterapi-modal.req-izin-terapis')
        @include('main_menu.jadwalterapi-modal.req-izin-pasien')
      </div>
      <!-- End Nav tabs -->

      </div>
    </div>
    <!-- /.content -->
  </div>

@endsection
