
@extends('template.style')
@section('isi')
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

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
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Payroll
        <small>View Payroll</small>
      </h1>
      <!--
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-files-o"></i> Main Menu</a></li>
        <li class="active">Assesment</li>
      </ol>
      -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- row -->
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-solid">
            <div class="box-body">

              <div class="col-md-12">
                @foreach ($payroll as $d)
                  <form action="{{ url('/payroll/'.$d->id_payroll) }}" method="post">
                    @csrf
                    {{ method_field('PATCH') }}
                    <table cellspacing="0" cellpadding="0" width="100%">
                      <tr style="text-align: center">
                        <td style="font-weight: bold; font-size: 18pt; padding-top:20px" colspan="2">
                          Slip Gaji Karyawan
                        </td>
                      </tr>
                      <tr style="text-align: center">
                        <td colspan="2">
                          Periode : {{ tglIndonesia(date('F', strtotime($d->tgl))).' '. date('Y', strtotime($d->tgl)) }}
                        </td>
                      </tr>
                      <tr>
                        <td colspan="2">
                          <table cellspacing="0" cellpadding="0" width="100%" style="padding: 15px 0px 10px 0px !important">
                            <tr>
                              <td width="15%">
                                Nama Karyawan
                              </td>
                              <td>
                                &nbsp;: {{ $d->nama }}
                              </td>
                            </tr>
                            <tr>
                              <td width="15%">
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
                                <input type="text" value="{{ $d->gaji }}" style="text-align: right; border:none; font-size: 12pt; background: none; color: black; width:80px !important" disabled>
                              </td>
                            </tr>
                            <tr style="background: #e8e8e8cf">
                              <td>2.</td>
                              <td>Insentives</td>
                              <td>Rp. </td>
                              <td align="right">
                                <input type="text" value="{{ $d->insentif }}" style="text-align: right; border:none; font-size: 12pt; background: none; color: black; width:80px !important" disabled>
                              </td>
                            </tr>
                            <tr>
                              <td>3.</td>
                              <td>Assessment</td>
                              <td>Rp. </td>
                              <td align="right">
                                <input type="text" value="{{ $d->asses }}" style="text-align: right; border:none; font-size: 12pt; background: none; color: black; width:80px !important" disabled>
                              </td>
                            </tr>
                            <tr style="background: #e8e8e8cf">
                              <td>4.</td>
                              <td>Evaluasi</td>
                              <td>Rp. </td>
                              <td align="right">
                                <input type="text" value="{{ $d->evaluasi }}" style="text-align: right; border:none; font-size: 12pt; background: none; color: black; width:80px !important" disabled>
                              </td>
                            </tr>
                            <tr>
                              <td>5.</td>
                              <td>Observasi</td>
                              <td>Rp. </td>
                              <td align="right">
                                <input type="text" value="{{ $d->observasi }}" style="text-align: right; border:none; font-size: 12pt; background: none; color: black; width:80px !important" disabled>
                              </td>
                            </tr>
                            <tr style="background: #e8e8e8cf">
                              <td>7.</td>
                              <td>Transport</td>
                              <td>Rp. </td>
                              <td align="right">
                                <input type="text" value="{{ $d->transport }}" style="text-align: right; border:none; font-size: 12pt; background: none; color: black; width:80px !important" disabled>
                              </td>
                            </tr>
                            <tr>
                              <td>8.</td>
                              <td>Konsumsi</td>
                              <td>Rp. </td>
                              <td align="right">
                                <input type="text" value="{{ $d->konsumsi }}" style="text-align: right; border:none; font-size: 12pt; background: none; color: black; width:80px !important" disabled>
                              </td>
                            </tr>
                            <tr style="background: #e8e8e8cf">
                              <td>9.</td>
                              <td>Bonus</td>
                              <td>Rp. </td>
                              <td align="right">
                                <input type="text" value="{{ $d->bonus }}" style="text-align: right; border:none; font-size: 12pt; background: none; color: black; width:80px !important" disabled>
                              </td>
                            </tr>
                          </table>
                        </td>
                        <td width="50%" style="vertical-align: top">
                          <table cellspacing="0" cellpadding="0" width="100%">
                            <tr style="background: #c1c0c0cf !important">
                              <th width="5%" align="left" style="padding: 5px 8px;">No.</th>
                              <th style="width: 74% !important" align="left">Keterangan</th>
                              <th colspan="2" align="center">Jumlah</th>
                            </tr>
                            <tr>
                              <td style="padding: 0px 8px;">1.</td>
                              <td>PPh 21</td>
                              <td>Rp. </td>
                              <td align="right" class="pengurang">
                                <input type="text" value="{{ $d->pph }}" maxlength="8" style="text-align: right; border:none; font-size: 12pt; width:80px !important" name="pph21" class="var_kurang" onkeypress="return hanyaAngka(event)">
                              </td>
                            </tr>
                            <tr style="background: #e8e8e8cf">
                              <td style="padding: 0px 8px;">2.</td>
                              <td>Asuransi</td>
                              <td>Rp. </td>
                              <td align="right" class="pengurang">
                                <input type="text" value="{{ $d->asuransi }}" maxlength="8" style="text-align: right; border:none; font-size: 12pt; background: none; width:80px !important" name="asuransi" class="var_kurang" onkeypress="return hanyaAngka(event)">
                              </td>
                            </tr>
                            <tr>
                              <td style="padding: 0px 8px;">3.</td>
                              <td>Lain-lain</td>
                              <td>Rp. </td>
                              <td align="right" class="pengurang">
                                <input type="text" value="{{ $d->lainnya }}" maxlength="8" style="text-align: right; border:none; font-size: 12pt; width:80px !important" name="lainnya" class="var_kurang" onkeypress="return hanyaAngka(event)">
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
                                <input type="text" value="{{ $d->gaji_kotor }}" name="ttl_pemasukkan" id="total_pemasukkan" style="text-align: right; border:none; font-size: 12pt; background: none; color: black; width:83px !important" class="" disabled>
                              </td>
                            </tr>
                          </table>
                        </td>
                        <td width="50%">
                          <table cellspacing="0" cellpadding="0" width="100%" style="padding-left:2%">
                            <tr>
                              <td style="padding: 10px 0px 5px 10px; font-weight: bold" colspan="2" width="80%">Total Pengeluaran</td>
                              <td>Rp. </td>
                              <td align="right" class="pengurang">
                                <input type="text" value="{{ $d->total_pengeluaran }}" style="text-align: right; border:none; font-size: 12pt; background: none; color: black; width:82px !important" name="ttl_pengeluaran" id="total_pengeluaran" class="tk " disabled>
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
                                <input type="text" name="total" id="gaji_bersih" style="text-align: right; border:none; font-size: 12pt; background: none; color: black; width:83px !important" value="{{ $d->gaji_bersih }}" disabled>
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                      <tr style="text-align: right">
                        <td style="padding-top: 50px">
                          &nbsp;
                        </td>
                        <td>
                          <input type="submit" name="submit" value="Print" style="padding: 2% 5%; font-weight: bold; border: none; background: #007ec7; color: white; font-size: 12pt">
                          <input type="submit" name="submit" value="Send Email" style="padding: 2% 5%; font-weight: bold; border: none; background: #41af41; color: white; font-size: 12pt">
                        </td>
                      </tr>
                    </table>
                  </form>
                @endforeach
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>

  <script>
    $(document).ready(function($){
    // Format mata uang.
    $( '.uang' ).mask('000,000,000', {reverse: true});
    
    });

    function hanyaAngka(evt) {
      var charCode = (evt.which) ? evt.which : event.keyCode
       if (charCode > 31 && (charCode < 48 || charCode > 57))

        return false;
      return true;
    }

    $('.pengurang').on('input', '.var_kurang', function(){
        var total_min = 0;
        $('.pengurang .var_kurang').each(function(){
            var input_val2 = $(this).val();
            if ($.isNumeric(input_val2)) {
                total_min += parseFloat(input_val2);
            }
        });
        $('#total_pengeluaran').val(total_min);
    });

    $('.pengurang').on('input', function(){
      const formatter = new Intl.NumberFormat('en-US', {
        minimumFractionDigits: 0  
      })


        var total = 0;
        $('.pengurang').each(function(){
            var input_vall = $('#total_pemasukkan').val();
            var input_val2 = $('#total_pengeluaran').val();
            var input_val = input_vall.replace(/,/gi, "");
            if ($.isNumeric(input_val)) {
                total = parseFloat(input_val) - parseFloat(input_val2);
            }
        });
        $('#gaji_bersih').val(total);
    });
  </script>

  @endsection