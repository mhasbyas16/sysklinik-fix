@extends('template.style')
@section('isi')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Jadwal Evaluasi
        <small>Status Pasien</small>
      </h1>
      <!--
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-files-o"></i> Main Menu</a></li>
        <li class="active">Assesment</li>
      </ol>
      -->
    </section>

    <div class="container">
      <br>
      <div class="row">
                <div class="col-md-11">
                    <div class="box box-solid col-md-12">
                        <br>
                        <br>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="satu" class=" table table-bordered table-striped">
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
                                        @foreach($ambil as $event)
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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  <script>
    /*$(".confirm-form").on('submit', function(event) {
        event.preventDefault();
        var $button = $(this).find('button');
        var data = $(this).serialize();
        $.ajax({
            type: "post",
            url: "https://jsonplaceholder.typicode.com/todos/",
            dataType: "json",
            data: data,
        }).done(function () {
          $button.prop('disabled', true)
        });
    });*/

    $(document).ready(function() {
      $('#satu,#dua').DataTable({
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
