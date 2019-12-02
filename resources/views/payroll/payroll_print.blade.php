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
<body style="margin: 1% 2% !important">

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
  
      function TI($str){
         $tr   = trim($str);
         $str    = str_replace(array('1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12'), array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'), $tr);
         return $str;
     }
?>

  @foreach ($payroll as $d)
		<table cellspacing="0" cellpadding="0" width="100%">
      <tr>
        <td colspan="2" style="border-bottom-width: 5px; border-bottom-style: double; border-bottom-color: black;">
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
        <td style="font-weight: bold; font-size: 18pt; padding-top:20px" colspan="2">
          Slip Gaji Karyawan
        </td>
      </tr>
      <tr style="text-align: center">
        <td colspan="2">
          Periode : {{ TI(date('F', strtotime($d->tgl))).' '. date('Y', strtotime($d->tgl)) }}
        </td>
      </tr>
      <tr>
        <td colspan="2">
          <table cellspacing="0" cellpadding="0" width="100%" style="padding: 15px 0px 10px 0px !important">
            <tr>
              <td width="20%">
                Nama Karyawan
              </td>
              <td>
                &nbsp;: {{ $d->nama }}
              </td>
            </tr>
            <tr>
              <td width="20%">
                Jabatan
              </td>
              <td>
                &nbsp;: {{ $d->jabatan }}
              </td>
            </tr>
          </table>
        </td>
      </tr>
      <tr>
        <th width="50%"><h4>Penghasilan</h4></th>
        <th width="50%" style="padding-left: 15px !important;"><h4>Pengeluaran</h4></th>
      </tr>
      <tr>
        <td width="50%">
          <table cellspacing="0" cellpadding="0" style="width: 100% !important">
            <tr style="background: #c1c0c0cf !important">
              <th width="5%" align="left" style="padding: 5px 0%;">No.</th>
              <th width="74%" align="left">Keterangan</th>
              <th colspan="2" align="center">Jumlah</th>
            </tr>
            <tr>
              <td>1.</td>
              <td>Gaji Pokok</td>
              <td>Rp. </td>
              <td align="right">
                <input type="text" value="{{ number_format($d->gaji) }}" style="text-align: right; border:none; font-size: 12pt; background: none; color: black; width:80px !important"  class="uang" disabled>
              </td>
            </tr>
            <tr style="background: #e8e8e8cf">
              <td>2.</td>
              <td>Insentives</td>
              <td>Rp. </td>
              <td align="right">
                <input type="text" value="{{ number_format($d->insentif) }}" style="text-align: right; border:none; font-size: 12pt; background: none; color: black; width:80px !important"  class="uang" disabled>
              </td>
            </tr>
            <tr>
              <td>3.</td>
              <td>Assessment</td>
              <td>Rp. </td>
              <td align="right">
                <input type="text" value="{{ number_format($d->asses) }}" style="text-align: right; border:none; font-size: 12pt; background: none; color: black; width:80px !important"  class="uang" disabled>
              </td>
            </tr>
            <tr style="background: #e8e8e8cf">
              <td>4.</td>
              <td>Evaluasi</td>
              <td>Rp. </td>
              <td align="right">
                <input type="text" value="{{ number_format($d->evaluasi) }}" style="text-align: right; border:none; font-size: 12pt; background: none; color: black; width:80px !important"  class="uang" disabled>
              </td>
            </tr>
            <tr>
              <td>5.</td>
              <td>Observasi</td>
              <td>Rp. </td>
              <td align="right">
                <input type="text" value="{{ number_format($d->observasi) }}" style="text-align: right; border:none; font-size: 12pt; background: none; color: black; width:80px !important" class="uang" disabled>
              </td>
            </tr>
            <tr style="background: #e8e8e8cf">
              <td>6.</td>
              <td>Transport</td>
              <td>Rp. </td>
              <td align="right">
                <input type="text" value="{{ number_format($d->transport) }}" style="text-align: right; border:none; font-size: 12pt; background: none; color: black; width:80px !important"  class="uang" disabled>
              </td>
            </tr>
            <tr>
              <td>7.</td>
              <td>Konsumsi</td>
              <td>Rp. </td>
              <td align="right">
                <input type="text" value="{{ number_format($d->konsumsi) }}" style="text-align: right; border:none; font-size: 12pt; background: none; color: black; width:80px !important"  class="uang" disabled>
              </td>
            </tr>
            <tr style="background: #e8e8e8cf">
              <td>8.</td>
              <td>Bonus</td>
              <td>Rp. </td>
              <td align="right">
                <input type="text" value="{{ number_format($d->bonus) }}" style="text-align: right; border:none; font-size: 12pt; background: none; color: black; width:80px !important"  class="uang" disabled>
              </td>
            </tr>
          </table>
        </td>
        <td width="50%" style="vertical-align: top">
          <table cellspacing="0" cellpadding="0" width="100%" style="padding-left: 15px !important;">
            <tr style="background: #c1c0c0cf !important">
              <th width="5%" align="left" style="padding: 5px 0%;">No.</th>
              <th style="width: 74% !important" align="left">Keterangan</th>
              <th colspan="2" align="center">Jumlah</th>
            </tr>
            <tr>
              <td>1.</td>
              <td>PPh 21</td>
              <td>Rp. </td>
              <td align="right" class="pengurang">
                <input type="text" value="{{ number_format($d->pph) }}" style="text-align: right; border:none; font-size: 12pt; width:80px !important" name="pph21" class="var_kurang uang">
              </td>
            </tr>
            <tr style="background: #e8e8e8cf">
              <td>2.</td>
              <td>Asuransi</td>
              <td>Rp. </td>
              <td align="right" class="pengurang">
                <input type="text" value="{{ str_replace(',','', number_format($d->asuransi)) }}" style="text-align: right; border:none; font-size: 12pt; background: none; width:80px !important" name="asuransi" class="var_kurang uang">
              </td>
            </tr>
            <tr>
              <td>3.</td>
              <td>Lain-lain</td>
              <td>Rp. </td>
              <td align="right" class="pengurang">
                <input type="text" value="{{ str_replace(',','', number_format($d->lainnya)) }}" style="text-align: right; border:none; font-size: 12pt; width:80px !important" name="lainnya" class="var_kurang uang">
              </td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
          </table>
        </td>
      </tr>
      <tr>
        <td width="50%">
          <table cellspacing="0" cellpadding="0" width="100%">
            <tr>
              <td style="padding: 10px 0px 5px 0px; font-weight: bold" colspan="2" width="79%">Total Pemasukkan</td>
              <td>Rp. </td>
              <td align="right" class="pengurang">
                <input type="text" value="{{ number_format($d->gaji_kotor, 0) }}" name="ttl_pemasukkan" id="total_pemasukkan" style="text-align: right; border:none; font-size: 12pt; background: none; color: black; width:83px !important" class="uang">
              </td>
            </tr>
          </table>
        </td>
        <td width="50%">
          <table cellspacing="0" cellpadding="0" width="100%" style="padding-left:2%">
            <tr>
              <td style="padding: 10px 0px 5px 10px; font-weight: bold" colspan="2" width="79%">Total Pengeluaran</td>
              <td>Rp. </td>
              <td align="right" class="pengurang">
                <input type="text" value="{{ number_format($d->total_pengeluaran, 0) }}" style="text-align: right; border:none; font-size: 12pt; background: none; color: black; width:83px !important" name="ttl_pengeluaran" id="total_pengeluaran" class="tk uang" disabled>
              </td>
            </tr>
          </table>
        </td>
      </tr>
      <tr>
        <td colspan="2" width="100%">
          <table cellspacing="0" cellpadding="0" width="100%" style="background: #e8e8e8cf">
            <tr style="background: #e8e8e8cf">
              <td style="padding: 10px 0px; font-weight: bold" width="90%">Gaji Bersih</td>
              <td>Rp. </td>
              <td align="right">
                <input type="text" name="total" id="gaji_bersih" style="text-align: right; border:none; font-size: 12pt; background: none; color: black; width:82px !important" value="{{ number_format($d->gaji_bersih, 0) }}" disabled>
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