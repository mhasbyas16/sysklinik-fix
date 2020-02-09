<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<link rel="stylesheet" href="">
</head>
<body>
	<div>
		@foreach($data as $data)
		Hi {{$data->nama}}!
		<br>
		<br> Kami memberitahukan bahwa permintaan Anda untuk assessment baru telah kami terima. Terimakasih atas kunjungan Anda Sebelumnya.
		<br>
		<br> Best Regards,
		<br> Admin Klinik Liliput
		<br>
		<br> 
		<div style="font-size: 10px; color: blue;">
			*Email ini merupakan email otomatis dari system
		</div>
		@endforeach
	</div>
</body>
</html>