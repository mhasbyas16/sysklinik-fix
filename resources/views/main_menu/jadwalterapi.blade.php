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
      <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active">
          <a href="#masuk" aria-controls="Masuk" role="tab" data-toggle="tab">Kalendar</a>
        </li>
        <li role="presentation">
          <a href="#keluar" aria-controls="keluar" role="tab" data-toggle="tab">Atur Penjadwalan</a>
        </li>
      </ul>

      <!-- Tab panes -->
      <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="masuk">
          <div class="row">
            <div class="col-md-10 col-xs-offset-1 ">
              <br>
              <br>
              <div class="panel panel-default pt-3">
                <div class="panel-heading">Kalender Baru</div>
                <div class="panel-body">
                  <div id='calendar'></div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div role="tabpanel" class="tab-pane" id="keluar">
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
      </div>
      <!-- End Nav tabs -->
    </div>
    <!-- /.content -->
  </div>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.css' />
  <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.js'></script>
  <script>
    $(document).ready(function () {
        // page is now ready, initialize the calendar...
      events={!! json_encode($events) !!};
      $('#calendar').fullCalendar({
        // put your options and callbacks here
        events: events,
      })
    });
  </script>
@endsection
