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
		<br> Berikut adalah file kuesioner yang Anda request. Silahkan untuk diunduh dan diisi dengan data sebenarnya. Harap file kuesioner yang telah Anda isi tersebut, dibawa saat Anda melakukan assessment di Klinik Liliput. Terimakasih.
		<br>
		<br> Best Regards,
		<br> Admin Klinik Liliput
		@endforeach
	</div>
</body>
</html>