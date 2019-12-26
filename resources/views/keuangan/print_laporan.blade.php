<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<link rel="stylesheet" href="">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</head>
<body style="margin: 1% 2% !important; padding:0% 2% !important">

    <?php
    header("Content-type: application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename=Laporan_Keuangan.xls");
    ?>
  <style>
    body{
      font-family: "Times New Roman", Times, serif;
      font-size: 12pt
    }
    input{
      font-family: "Times New Roman", Times, serif;
    }
  </style>

<?php  
  
      function tglIndonesia($str){
         $tr   = trim($str);
         $str    = str_replace(array('Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12'), array('Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum\'at', 'Sabtu', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'), $tr);
         return $str;
     }
?>

  @foreach ($data as $d)
		<table cellspacing="0" cellpadding="0" width="60%">
      <tr>
        <td colspan="4" rowspan="4" width="45%">
          <img src="<?php echo public_path().'\foto\logo_liliput_edit.png'?>" alt="Logo">
        </td>
        <td colspan="3">
          <h2>Liliput</h2>
        </td>
      </tr>
      <tr>
        <td colspan="3">
          <i style="font-size: 14pt">Helping hands in your child’s development</i>
        </td>
      </tr>
      <tr>
        <td colspan="3">
          Jl. Cipete IV No. 6 Jakarta Selatan
        </td>
      </tr>
      <tr>
        <td colspan="3">
          Telp. (+62-21) 7581 6662/ 32692552
        </td>
      </tr>

      <tr>
        <td colspan="6">
          &nbsp;
        </td>
      </tr>

      <tr>
        <td colspan="6" style="text-align: center; font-weight: bold; font-size: 18pt; padding-top:20px">
          Laporan Keuangan
        </td>
      </tr>
      
      <tr>
        <td colspan="6" style="text-align: center">
          Periode : {{ tglIndonesia(date('F', strtotime($d->tgl))).' '. date('Y', strtotime($d->tgl)) }}
        </td>
      </tr>

      <tr>
        <td colspan="6">
          <h4>Pemasukan</h4>
        </td>
      </tr>

      <tr>
        <td rowspan="6" width="2%">
          &nbsp;
        </td>
        <td>
          Saldo
        </td>
        <td>
          Rp. 
        </td>
        <td align="right" width="10%">
          {{ number_format($d->saldo_awal,0) }}
        </td>
        <td rowspan="5" width="1%">
          &nbsp;
        </td>
        <td rowspan="5">
          &nbsp;
        </td>
      </tr>

      <tr>
        <td>
          Billing
        </td>
        <td>
          Rp. 
        </td>
        <td align="right">
          {{ number_format($d->billing,0) }}
        </td>
      </tr>

      <tr>
        <td>
          Uang Pangkal
        </td>
        <td>
          Rp. 
        </td>
        <td align="right">
          {{ number_format($d->uang_pangkal,0) }}
        </td>
      </tr>

      <tr>
        <td>
          Assessment
        </td>
        <td>
          Rp. 
        </td>
        <td align="right">
          {{ number_format($d->assesment,0) }}
        </td>
      </tr>

      <tr>
        <td>
          BB/Cashbon
        </td>
        <td>
          Rp. 
        </td>
        <td align="right">
          {{ number_format($d->piutang,0) }}
        </td>
      </tr>

      <tr>
        <td colspan="3" style="border-top: 2px solid black;">
          Total Pemasukan
        </td>
        <td style="border-top: 2px solid black;">
          Rp. 
        </td>
        <td align="right" style="border-top: 2px solid black;">
          {{ number_format($d->total_pemasukan,0) }}
        </td>
      </tr>

      <tr>
        <td colspan="6">
          <h4>Pengeluaran</h4>
        </td>
      </tr>

      <tr>
        <td rowspan="8" width="2%">
          &nbsp;
        </td>
        <td>
          Listrik
        </td>
        <td>
          Rp. 
        </td>
        <td align="right">
          {{ number_format($d->listrik,0) }}
        </td>
        <td rowspan="5">
          &nbsp;
        </td>
        <td rowspan="5">
          &nbsp;
        </td>
      </tr>

      <tr>
        <td>
          Telkom
        </td>
        <td>
          Rp. 
        </td>
        <td align="right">
          {{ number_format($d->telkom,0) }}
        </td>
      </tr>

      <tr>
        <td>
          Pajak
        </td>
        <td>
          Rp. 
        </td>
        <td align="right">
          {{ number_format($d->uang_pangkal,0) }}
        </td>
      </tr>

      <tr>
        <td>
          Insentif Terapi
        </td>
        <td>
          Rp. 
        </td>
        <td align="right">
          {{ number_format($d->insentif_terapis,0) }}
        </td>
      </tr>

      <tr>
        <td>
          Fee
        </td>
        <td>
          Rp. 
        </td>
        <td align="right">
          {{ number_format($d->fee,0) }}
        </td>
      </tr>

      <tr>
        <td>
          Bonus
        </td>
        <td>
          Rp. 
        </td>
        <td align="right">
          {{ number_format($d->bonus,0) }}
        </td>
      </tr>

      <tr>
        <td>
          Lainnya
        </td>
        <td>
          Rp. 
        </td>
        <td align="right">
          {{ number_format($d->lainnya,0) }}
        </td>
      </tr>

      <tr>
        <td colspan="3" style="border-top: 2px solid black;">
          Total Pengeluaran
        </td>
        <td style="border-top: 2px solid black;">
          Rp. 
        </td>
        <td align="right" style="border-top: 2px solid black;">
          {{ number_format($d->total_pengeluaran,0) }}
        </td>
      </tr>

      <tr>
        <td width="2%">
          &nbsp;
        </td>
        <td colspan="3" style="border-top: 3px double black;">
          <h4>Saldo Akhir</h4>
        </td>
        <td style="border-top: 3px double black;">
          Rp. 
        </td>
        <td align="right" style="border-top: 3px double black;">
          {{ number_format($d->total_pengeluaran,0) }}
        </td>
      </tr>

    </table>
	@endforeach

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.5/jquery.mask.js"></script>

  <script>
    $(document).ready(function($){
    // Format mata uang.
    $( '.uang' ).mask('000,000,000', {reverse: true});
    
    });

    $('.pengurang').on('input', '.var_kurang', function(){
      const formatter = new Intl.NumberFormat('en-US', {
        minimumFractionDigits: 0  
      })
        var total_min = 0;
        $('.pengurang .var_kurang').each(function(){
            var input_vall = $(this).val();
            var input_val2 = input_vall.replace(/,/gi, "");
            if ($.isNumeric(input_val2)) {
                total_min += parseFloat(input_val2);
            }
        });
        $('#total_pengeluaran').val(formatter.format(total_min));
    });

    $('.pengurang').on('input', function(){
      const formatter = new Intl.NumberFormat('en-US', {
        minimumFractionDigits: 0  
      })


        var total = 0;
        $('.pengurang').each(function(){
            var input_vall = $('#total_pemasukkan').val();
            var input_valll = $('#total_pengeluaran').val();
            var input_val = input_vall.replace(/,/gi, "");
            var input_val2 = input_valll.replace(/,/gi, "");
            if ($.isNumeric(input_val)) {
                total = parseFloat(input_val) - parseFloat(input_val2);
            }
        });
        $('#gaji_bersih').val(formatter.format(total));
    });
  </script>
</body>
</html>