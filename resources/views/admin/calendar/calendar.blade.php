@extends('template.style')
@section('isi')

  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Main Menu
        <small>Jadwal Terapi</small>
      </h1>
    </section>


    <!-- Main content -->
    <div class="container">
        <br>
      <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active">
          <a href="#cal" aria-controls="cal" role="tab" data-toggle="tab">Kalendar</a>
        </li>
        <li role="presentation">
          <a href="#jadwal" aria-controls="jadwal" role="tab" data-toggle="tab">Atur Penjadwalan</a>
        </li>
      </ul>

      <!-- Tab panes -->
      <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="cal">
          <div class="row">
            <div class="col-md-12">
              <br>
              <div class="panel panel-default pt-3">
                <div class="panel-heading">Kalender Jadwal</div>
                <div class="panel-body">
                  <!-- <div id='calendar'></div> -->
                  {!! $calendar->calendar() !!}
                  {!! $calendar->script() !!}
                </div>
              </div>
            </div>
          </div>
        </div>
        <div role="tabpanel" class="tab-pane" id="jadwal">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-solid col-md-12">
                        <br>
                        <br>
                        <div style="margin-bottom: 10px;" class="row">
                            <div class="col-lg-12">
                                <a class="btn btn-success" href="{{ url('events/create') }}">
                                    Tambah Jadwal
                                </a>
                            </div>
                        </div>
                        <br>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="tabb" class="table table-bordered table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th class="text-center">id</th>
                                            <th class="text-center">ID Asses</th>
                                            <th class="text-center">Nama Pasien</th>
                                            <th class="text-center">Nama Terapis</th>
                                            <th class="text-center">Tgl & Jam Masuk</th>
                                            <th class="text-center">Tgl & Jam Keluar</th>
                                            <th class="text-center">Perulangan Jadwal</th>
                                            <th class="text-center">Keterangan</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($coba as $key => $event)
                                            <tr data-entry-id="{{ $event->id_jadwal }}">
                                                <td class="text-center">{{ $event->id_jadwal ?? '' }}</td>
                                                <td class="text-center">{{ $event->id_asses ?? '' }}</td>
                                                <td class="text-center">{{ $event->namaP ?? '' }}</td>
                                                <td class="text-center">{{ $event->nama ?? '' }}</td>
                                                <td class="text-center">{{ $event->tgl ?? '' }}</td>
                                                <td class="text-center">{{ $event->jam_masuk ?? '' }}</td>
                                                <td class="text-center">{{ App\Event::RECURRENCE_RADIO[$event->recurrence] ?? '' }}</td>
                                                <td class="text-center">{{ $event->keterangan ?? '' }}</td>
                                                <td class="text-center">
                                                    <a class="fa fa-eye btn btn-xs btn-success" href="{{url('events/show')}}/{{$event->id_jadwal}}">
                                                    </a>

                                                    <a class="fa fa-edit btn btn-xs btn-primary" href="{{url('events/edit')}}/{{$event->id_jadwal}}">
                                                    </a>
                                                    
                                                    <form action="{{url('events/destroy')}}/{{$event->id_jadwal}}" method="POST" onsubmit="return confirm('Yakin menghapus data {{$event->id_jadwal}} ini?');">
                                                        @csrf
                                                        @method("DELETE")
                                                        <input type="submit" class="btn btn-xs btn-warning" href="{{$event->id_jadwal}}" value="Del">
                                                    </form>

                                                    <!-- <form action="{{route('events.massdestroy')}}/{{$event->id_jadwal}}" method="POST" onsubmit="return confirm('Apakah anda ingin menghapus jadwal yang berkaitan {{$event->id_jadwal}} lainnya?');">
                                                        @csrf
                                                        @method("DELETE")
                                                        <input type="submit" class="btn btn-xs btn-danger" href="{{$event->id_jadwal}}" value="Relate Del">
                                                    </form> -->
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <br>
                    </div>
                </div>
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
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.css' />
    
    <link href='node_modules/@fullcalendar/core/main.css' rel='stylesheet' />
    <link href='node_modules/@fullcalendar/daygrid/main.css' rel='stylesheet' />
    <link href='node_modules/@fullcalendar/timegrid/main.css' rel='stylesheet' />
    <link href='node_modules/@fullcalendar/list/main.css' rel='stylesheet' />
    <script src='dist/example.js'></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            events={!! json_encode($events) !!};
            var calendarEl = document.getElementById('calendar');
            var calendar = new _fullcalendar_core__WEBPACK_IMPORTED_MODULE_0__["Calendar"](calendarEl, {
                plugins: [ _fullcalendar_interaction__WEBPACK_IMPORTED_MODULE_1__["default"], _fullcalendar_daygrid__WEBPACK_IMPORTED_MODULE_2__["default"], _fullcalendar_timegrid__WEBPACK_IMPORTED_MODULE_3__["default"], _fullcalendar_list__WEBPACK_IMPORTED_MODULE_4__["default"] ],
                header: {
                  left: 'prev,next today',
                  center: 'title',
                  right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
                },
                /*defaultDate: '2018-01-12',
                navLinks: true, // can click day/week names to navigate views
                editable: true,
                eventLimit: true, // allow "more" link when too many events
                */events: events,
            });
            calendar.render();
        });
    </script>                       
    
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.4/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.flash.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.colVis.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.3.0/js/dataTables.select.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/11.0.1/classic/ckeditor.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>

    <script type="text/javascript">
      $(document).ready(function() {
          $('#tabb').DataTable({
            dom: 'Bfrtip',
            buttons:[
              {extend:'excelHtml5',
               title:'Assesment Export'},
              {extend:'pdfHtml5',
               title:'Assesment Export'},
               'print'],
               select:true
          });
          function goBack() {
            window.history.back();
          }
          $('#max').on('keyup click change', function() {
              table.draw();
          } );
      });
    </script>
@endsection
