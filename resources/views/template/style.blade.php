@if (!Session::has('id_pegawai'))
<script>window.location = "{{url('/login')}}";</script>
@endif
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Klinik Liliput</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="{{asset('AdminLTE/bower_components/jquery/dist/jquery.min.js')}}"></script>
    <script src="{{asset('AdminLTE/bower_components/moment/min/moment.min.js')}}"></script>
    <script src="{{asset('AdminLTE/bower_components/fullcalendar/dist/fullcalendar.min.js')}}"></script>
    <link rel="stylesheet" href="{{asset('AdminLTE/bower_components/fullcalendar/dist/fullcalendar.min.css')}}"/>
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{asset('AdminLTE/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('AdminLTE/bower_components/font-awesome/css/font-awesome.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{asset('AdminLTE/bower_components/Ionicons/css/ionicons.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('AdminLTE/dist/css/AdminLTE.min.css')}}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{asset('AdminLTE/dist/css/skins/_all-skins.min.css')}}">
  <!-- Morris chart -->
  <link rel="stylesheet" href="{{asset('AdminLTE/bower_components/morris.js/morris.css')}}">
  <!-- jvectormap -->
  <link rel="stylesheet" href="{{asset('AdminLTE/bower_components/jvectormap/jquery-jvectormap.css')}}">
  <!-- Date Picker -->
  <link rel="stylesheet" href="{{asset('AdminLTE/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{asset('AdminLTE/bower_components/bootstrap-daterangepicker/daterangepicker.css')}}">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="{{asset('AdminLTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('AdminLTE/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('AdminLTE/bower_components/datatables.net/css/jquery.dataTables.min.css')}}">
  <link rel="stylesheet" href="{{asset('AdminLTE/bower_components/datatables.net/css/buttons.dataTables.min.css')}}">
  <!--fullcalendar--><!--
  <link rel="stylesheet" media="print" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/>
-->
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
<link rel="stylesheet" href="{{asset('css/pict.css')}}">

<script type="text/javascript">
    function alamatI(){
        var alamati = document.getElementById("alamatI");
        var alamatp = document.getElementById("alamatP").value;

		if(document.getElementById("cekboxI").checked == true){
			alamati.readOnly = true;
            alamati.innerHTML = alamatp;
		}else{
			alamati.readOnly = false;
            alamati.innerHTML = " ";
		};
  };
</script>
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
@include('template.header')
@include('template.sidebar')
@yield('isi')
@include('template.footer')
@include('template.sidebar_r')

</div>
<!-- ./wrapper -->
<!--javascript-->

<!-- jQuery UI 1.11.4 -->
<script src="{{asset('AdminLTE/bower_components/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="{{asset('AdminLTE/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- Morris.js charts -->
<script src="{{asset('AdminLTE/bower_components/raphael/raphael.min.js')}}"></script>
<script src="{{asset('AdminLTE/bower_components/morris.js/morris.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{asset('AdminLTE/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js')}}"></script>
<!-- jvectormap -->
<script src="{{asset('AdminLTE/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
<script src="{{asset('AdminLTE/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{asset('AdminLTE/bower_components/jquery-knob/dist/jquery.knob.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{asset('AdminLTE/bower_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
<!-- datepicker -->
<script src="{{asset('AdminLTE/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{asset('AdminLTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
<!-- Slimscroll -->
<script src="{{asset('AdminLTE/bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
<!-- FastClick -->
<script src="{{asset('AdminLTE/bower_components/fastclick/lib/fastclick.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('AdminLTE/dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset('AdminLTE/dist/js/pages/dashboard.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('AdminLTE/dist/js/demo.js')}}"></script>
<!--pict js-->
<script type="text/javascript" src="{{asset('js/pict.js')}}"></script>
<!--datatables-->
<script src="{{asset('AdminLTE/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('AdminLTE/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<script src="{{asset('AdminLTE/bower_components/datatables.net/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('AdminLTE/bower_components/datatables.net/js/buttons.flash.min.js')}}"></script>
<script src="{{asset('AdminLTE/bower_components/datatables.net/js/jszip.min.js')}}"></script>
<script src="{{asset('AdminLTE/bower_components/datatables.net/js/pdfmake.min.js')}}"></script>
<script src="{{asset('AdminLTE/bower_components/datatables.net/js/vfs_fonts.js')}}"></script>
<script src="{{asset('AdminLTE/bower_components/datatables.net/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('AdminLTE/bower_components/datatables.net/js/buttons.print.min.js')}}"></script>
<script type="text/javascript">
//date picker
 $(function () {
     $('#datepicker, #datedaftar, #tgl_mulai, #tgl_selesai').datepicker({
         autoclose: true,
         format:'yyyy-mm-dd'
     });
});

//assesment alamat checkbox
$(document).ready(function(){

    $('#cekboxA').click(function(){
        var alamatp = $('#alamatP').val();
        if ($('#cekboxA').is(':checked')){
            $('#alamatA').attr('readonly',true);
            $('#alamatA').val(alamatp);
        }else if ($('#cekboxA').is(':not(:checked)')) {
            $('#alamatA').attr('readonly',false);
            $('#alamatA').val('');
        }
    });

    $('#cekboxI').click(function(){
        var alamatp = $('#alamatP').val();
        if ($('#cekboxI').is(':checked')){
            $('#alamatI').attr('readonly',true);
            $('#alamatI').val(alamatp);
        }else if ($('#cekboxI').is(':not(:checked)')) {
            $('#alamatI').attr('readonly',false);
            $('#alamatI').val('');
        }
    });
});
//datatables assesment
$(function () {
  $('#example1').DataTable({
    dom: 'Bfrtip',
    buttons:[
      {extend:'excelHtml5',
       title:'Assesment Exportaa'},
      {extend:'pdfHtml5',
       title:'Assesment Exportaa'},
       'print'],
       select:true,
        "pageLength": 20
  });
});
//

/* Absensi */
$.fn.dataTable.ext.search.push(
    function( settings, data, dataIndex ) {
        var min = parseInt( $('#min').val(), 10 );
        var max = parseInt( $('#max').val(), 10 );
        var age = parseFloat( data[4] ) || 0; // use data for the age column

        if ( ( isNaN( min ) && isNaN( max ) ) ||
             ( isNaN( min ) && age <= max ) ||
             ( min <= age   && isNaN( max ) ) ||
             ( min <= age   && age <= max ) )
        {
            return true;
        }
        return false;
    }
);

$(document).ready(function() {
    $('#pegawais,#pasiens,#terapiss,#terapi').DataTable({
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
    // Event listener to the two range filtering inputs to redraw on input
    $('#max').on('keyup click change', function() {
        table.draw();
    } );
} );


//format uang
var gaji = document.getElementById('gaji');
var observasi = document.getElementById('observasi');
var asses = document.getElementById('asses');
var konsumsi = document.getElementById('konsumsi');
var bonus = document.getElementById('bonus');
var transport = document.getElementById('transport');
var lembur = document.getElementById('lembur');
gaji.addEventListener('keyup', function(e)
{
  gaji.value = formatRupiah(this.value, 'Rp. ');
});

bonus.addEventListener('keyup', function(e)
{
  bonus.value = formatRupiah(this.value, 'Rp. ');
});
transport.addEventListener('keyup', function(e)
{
  transport.value = formatRupiah(this.value, 'Rp. ');
});
lembur.addEventListener('keyup', function(e)
{
  lembur.value = formatRupiah(this.value, 'Rp. ');
});
konsumsi.addEventListener('keyup', function(e)
{
  konsumsi.value = formatRupiah(this.value, 'Rp. ');
});
asses.addEventListener('keyup', function(e)
{
  asses.value = formatRupiah(this.value, 'Rp. ');
});
observasi.addEventListener('keyup', function(e)
{
  observasi.value = formatRupiah(this.value, 'Rp. ');
});

/* Fungsi */
function formatRupiah(angka, prefix)
{
  var number_string = angka.replace(/[^,\d]/g, '').toString(),
      split    = number_string.split(','),
      sisa     = split[0].length % 3,
      rupiah     = split[0].substr(0, sisa),
      ribuan     = split[0].substr(sisa).match(/\d{3}/gi);

  if (ribuan) {
      separator = sisa ? '.' : '';
      rupiah += separator + ribuan.join('.');
  }

  rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
  return prefix == undefined ? rupiah : (rupiah ? rupiah : '');
}

$(document).ready(function($){
// Format mata uang.
$( '.uang' ).mask('000.000.000', {reverse: true});
});

$(function () {
  $('#datepicker').datepicker({
  autoclose: true
  });
  $('#datedaftar').datepicker({
  autoclose: true
  });
  $('.tanggal').datepicker({
  format: 'dd-mm-yyyy'
  });
});

//jadwal add
/*
*/
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>
</body>
</html>
