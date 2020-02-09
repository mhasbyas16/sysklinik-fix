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
            <div class="row">
                <div class="col-md-11">
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
                                <table class=" table table-bordered table-striped table-hover datatable datatable-Event">
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
                                                    <a class="fa fa-eye btn btn-xs btn-primary" href="{{url('events/show')}}/{{$event->id_jadwal}}">
                                                    </a>

                                                    <a class="fa fa-edit btn btn-xs btn-warning" href="{{url('events/edit')}}/{{$event->id_jadwal}}">
                                                    </a>

                                                    <a class="fa fa-trash btn btn-xs btn-danger" href="{{url('events/destroy')}}/{{$event->id_jadwal}}" onclick="return confirm('Data yang lain akan ikut terhapus, Anda Yakin Menghapus Data Ini?')">
                                                    </a>
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

    <script>
        $(document).ready(function () {
          events={!! json_encode($events) !!};
          $('#calendar').fullCalendar({
            // put your options and callbacks here
            events: events,
          })
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

    <script>
    $(function () {
        let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
        
            let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
            let deleteButton = {
                text: deleteButtonTrans,
                url: "{{ url('events.massDestroy') }}",
                className: 'btn-danger',
                action: function (e, dt, node, config) {
                    var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
                    return $(entry).data('entry-id')
                    });

                    if (ids.length === 0) {
                        alert('{{ trans('global.datatables.zero_selected') }}')
                        return
                    }

                    if (confirm('{{ trans('global.areYouSure') }}')) {
                        $.ajax({
                          headers: {'x-csrf-token': _token},
                          method: 'POST',
                          url: config.url,
                          data: { ids: ids, _method: 'DELETE' }
                        })
                        .done(function () { location.reload() })
                    }
                }
            }
            dtButtons.push(deleteButton)
       

    $.extend(true, $.fn.dataTable.defaults, {
        order: [[ 1, 'asc' ]],
        pageLength: 100,
    });
    $('.datatable-Event:not(.ajaxTable)').DataTable({ buttons: dtButtons })
        $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
            $($.fn.dataTable.tables(true)).DataTable()
                .columns.adjust();
        });
    })

</script>
@endsection
