//date picker
 $(function () {
     $('#datepicker, #datedaftar, #tgl_mulai, #tgl_selesai').datepicker({
         autoclose: true,
         format:'yyyy-mm-dd'
     })
})

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
       title:'Assesment Export'},
      {extend:'pdfHtml5',
       title:'Assesment Export'},
       'print'],
       select:true,
        "pageLength": 20
  })
})

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
    var table = $('#example_P,#example_K,#example_T,#pegawais,#pasiens,#terapiss,#terapi').DataTable({
      dom: 'Bfrtip',
      buttons:[
        {extend:'excelHtml5',
         title:'Assesment Export'},
        {extend:'pdfHtml5',
         title:'Assesment Export'},
         'print'],
         select:true
    });

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
