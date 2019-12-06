<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Print Kwitansi</title>
	
</head>
<body>

<?php

    function tglIndonesia($str){
       $tr   = trim($str);
       $str    = str_replace(array('Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', '01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'), array('Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum\'at', 'Sabtu', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'), $tr);
       return $str;
   }

   function penyebut($nilai) {
    $nilai = abs($nilai);
    $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
    $temp = "";
    if ($nilai < 12) {
      $temp = " ". $huruf[$nilai];
    } else if ($nilai <20) {
      $temp = penyebut($nilai - 10). " belas";
    } else if ($nilai < 100) {
      $temp = penyebut($nilai/10)." puluh". penyebut($nilai % 10);
    } else if ($nilai < 200) {
      $temp = " seratus" . penyebut($nilai - 100);
    } else if ($nilai < 1000) {
      $temp = penyebut($nilai/100) . " ratus" . penyebut($nilai % 100);
    } else if ($nilai < 2000) {
      $temp = " seribu" . penyebut($nilai - 1000);
    } else if ($nilai < 1000000) {
      $temp = penyebut($nilai/1000) . " ribu" . penyebut($nilai % 1000);
    } else if ($nilai < 1000000000) {
      $temp = penyebut($nilai/1000000) . " juta" . penyebut($nilai % 1000000);
    } else if ($nilai < 1000000000000) {
      $temp = penyebut($nilai/1000000000) . " milyar" . penyebut(fmod($nilai,1000000000));
    } else if ($nilai < 1000000000000000) {
      $temp = penyebut($nilai/1000000000000) . " trilyun" . penyebut(fmod($nilai,1000000000000));
    }     
    return $temp;
  }

  function terbilang($nilai) {
    if($nilai<0) {
      $hasil = "minus ". trim(penyebut($nilai));
    } else {
      $hasil = trim(penyebut($nilai));
    }         
    return $hasil;
  }
      
 ?>

	<div class="container">
	    <div class="row">
	    	<div class="col-md-12">
	    		<h3>Klinik Liliput</h3>
	    		<p>Jl. Cipete IV No. 6, Jakarta Selatan<br>
	    		Telp. & WhatsApp : +6221 7581 666 2 / 0857 8100 2759</p>
	    	</div>
	    </div>
	    <div>
	    	<table width="100%">
	        	@foreach ($kwitansi as $k)
		    		<tr>
		    			<td style="text-align: center">
		    				<h3>BUKTI PEMBAYARAN</h3>
		    			</td>
		    		</tr>
		    		<tr>
		    			<td>
		    				<table width="100%">
		    					<tr>
		    						<td>
		    							NAMA
		    						</td>
		    						<td>
		    							: {{ $k->nama }}
		    						</td>
		    					</tr>
		    					<tr>
		    						<td>
		    							TERBILANG
		    						</td>
		    						<td style="text-transform: capitalize">
		    							: {{ terbilang($k->jumlah).' Rupiah' }}
		    						</td>
		    					</tr>
		    					<tr>
		    						<td>
		    							KETERANGAN
		    						</td>
		    						<td style="text-transform: capitalize">
		    							: {{ $k->keterangan }}
		    						</td>
		    					</tr>
		    					<tr>
		    						<td>
		    							JUMLAH
		    						</td>
		    						<td>
		    							: {{ 'Rp. '.number_format($k->jumlah, 0) }}
		    						</td>
		    					</tr>
		    				</table>
		    			</td>
		    		</tr>
		    		<tr>
		    			<td style="text-align: right; padding-top: 3%">
		    				{{  'Jakarta, '.date('d').' '.tglIndonesia(date('m', strtotime(now()))).' '.date('Y')}}
		    			</td>
		    		</tr>
	    		@endforeach
	    	</table>
	    </div>
	</div>
    <div style="color: #9c9c9c; bottom:0; font-size: 10pt; position:fixed; text-align:center">
    	*note : ini adalah bukti pembayaran yang dibuat otomatis oleh system, dan tidak memerlukan tanda tangan
    </div>
</body>
</html>