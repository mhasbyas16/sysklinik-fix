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
		<table cellspacing="0" cellpadding="0" width="100%">
      <tr>
        <td style="border-bottom-width: 5px; border-bottom-style: double; border-bottom-color: black;">
          <table cellspacing="0" cellpadding="0" width="100%">
            <tr>
              <td width="25%">
                <img src="<?php echo public_path().'\foto\logo_liliput_edit.png'?>" alt="Logo">
              </td>
              <td width="75%">
                <table cellspacing="0" cellpadding="0">
                  <tr>
                    <td style="font-weight: bold; font-size: 24pt">
                      Liliput
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <i style="font-size: 14pt">Helping hands in your child’s development</i>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      Jl. Cipete IV No. 6 Jakarta Selatan
                    </td>
                  </tr>
                  <tr>
                    <td>
                      Telp. (+62-21) 7581 6662/ 32692552
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>
        </td>
      </tr>
      <tr style="text-align: center">
        <td style="font-weight: bold; font-size: 18pt; padding-top:20px">
          Laporan Keuangan
        </td>
      </tr>
      <tr style="text-align: center">
        <td>
          Periode : {{ tglIndonesia(date('F', strtotime($d->tgl))).' '. date('Y', strtotime($d->tgl)) }}
        </td>
      </tr>
      <tr>
        <td>
          <table cellspacing="0" cellpadding="0" width="80%" align="center">
            <tr>
              <td>
                <table cellpadding="0" cellspacing="0" width="100%"> 
                  <tr>
                    <td colspan="6">
                      <h4>Pemasukkan</h4>
                    </td>
                  </tr>
                  <tr>
                    <td rowspan="6" width="2%">
                      &nbsp;
                    </td>
                    <td colspan="3">
                      <table style="border-bottom: 2px solid black" width="94%">
                        <tr>
                          <td style="padding:3px 0px" width="67%">
                            Saldo
                          </td>
                          <td width="2%">
                            Rp.
                          </td>
                          <td align="right">
                            {{ number_format($d->saldo_awal,0) }}
                          </td>
                        </tr>
                        <tr>
                          <td style="padding:3px 0px" width="67%">
                            Billing
                          </td>
                          <td width="2%">
                            Rp.
                          </td>
                          <td align="right">
                            {{ number_format($d->billing,0) }}
                          </td>
                        </tr>
                        <tr>
                          <td style="padding:3px 0px" width="67%">
                            Uang Pangkal
                          </td>
                          <td width="2%">
                            Rp.
                          </td>
                          <td align="right">
                            {{ number_format($d->uang_pangkal,0) }}
                          </td>
                        </tr>
                        <tr>
                          <td style="padding:3px 0px" width="67%">
                            Assessment
                          </td>
                          <td width="2%">
                            Rp.
                          </td>
                          <td align="right">
                            {{ number_format($d->assesment,0) }}
                          </td>
                        </tr>
                        <tr style="border:2px solid black">
                          <td style="padding: 3px">
                            BB/Cashbon
                          </td>
                          <td width="2%">
                            Rp.
                          </td>
                          <td align="right">
                            {{ number_format($d->piutang,0) }}
                          </td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                  <tr valign="bottom">
                    <td colspan="3" width="69%" style="font-size:12pt; font-weight: bold; padding: 10px 0px;">
                      Total Pemasukkan
                    </td>
                    <td style="padding:10px 0px" width="2%">
                      Rp.
                    </td>
                    <td style="padding:10px 0px" align="right">
                      {{ number_format($d->total_pemasukan,0) }}
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td>
                <table cellpadding="0" cellspacing="0" width="100%"> 
                  <tr>
                    <td colspan="6">
                      <h4>Pengeluaran</h4>
                    </td>
                  </tr>
                  <tr>
                    <td rowspan="8" width="2%">
                      &nbsp;
                    </td>
                    <td colspan="3">
                      <table style="border-bottom: 2px solid black" width="94%">
                        <tr>
                          <td style="padding: 3px 0px" width="67%">
                            Listrik
                          </td>
                          <td width="2%">
                            Rp.
                          </td>
                          <td align="right">
                            {{ number_format($d->listrik,0) }}
                          </td>
                        </tr>
                        <tr>
                          <td style="padding: 3px 0px" width="67%">
                            Telkom
                          </td>
                          <td width="2%">
                            Rp.
                          </td>
                          <td align="right">
                            {{ number_format($d->telkom,0) }}
                          </td>
                        </tr>
                        <tr>
                          <td style="padding: 3px 0px" width="67%">
                            Pajak
                          </td>
                          <td width="2%">
                            Rp.
                          </td>
                          <td align="right">
                            {{ number_format($d->uang_pangkal,0) }}
                          </td>
                        </tr>
                        <tr>
                          <td style="padding: 3px 0px" width="67%">
                            Insentif Terapi
                          </td>
                          <td width="2%">
                            Rp.
                          </td>
                          <td align="right">
                            {{ number_format($d->insentif_terapis,0) }}
                          </td>
                        </tr>
                        <tr>
                          <td style="padding: 3px 0px" width="67%">
                            Fee
                          </td>
                          <td width="2%">
                            Rp.
                          </td>
                          <td align="right">
                            {{ number_format($d->fee,0) }}
                          </td>
                        </tr>
                        <tr>
                          <td style="padding: 3px 0px" width="67%">
                            Bonus
                          </td>
                          <td width="2%">
                            Rp.
                          </td>
                          <td align="right">
                            {{ number_format($d->bonus,0) }}
                          </td>
                        </tr>
                        <tr style="border-bottom:2px solid black !important">
                          <td style="padding: 3px 0px" width="67%">
                            Lainnya
                          </td>
                          <td width="2%">
                            Rp.
                          </td>
                          <td align="right">
                            {{ number_format($d->lainnya,0) }}
                          </td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                  <tr valign="bottom">
                    <td colspan="3" width="69%" style="font-size:12pt; font-weight: bold; padding: 10px 0px;">
                      Total Pengeluaran
                    </td>
                    <td style="padding:10px 0px" width="2%">
                      Rp.
                    </td>
                    <td style="padding:10px 0px" align="right">
                      {{ number_format($d->total_pengeluaran,0) }}
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td>
                <table cellpadding="0" cellspacing="0" width="100%">
                  <tr>
                    <td width="2%">
                      &nbsp;
                    </td>
                    <td>
                      <table cellpadding="0" cellspacing="0" width="100%" style="border-top: 3px double black;">
                        <tr>
                          <td width="71%">
                            <h4>Saldo Akhir</h4>
                          </td>
                          <td>
                            Rp.
                          </td>
                          <td align="right">
                            {{ number_format($d->saldo_akhir,0) }}
                          </td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
	@endforeach

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>

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