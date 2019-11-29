@foreach ($data as $d)
	<div>
		Dear, Orangtua {{ $d->nama }},<br><br><br>
		Billing kamu di klinik liliput sudah keluar lho...<br><br>
		Download dengan klik link di bawah ini yaa :<br>
	    <a href="http://localhost:8000/print/billing/{{ $d->id_bill }}" target="_Blank">Download Disini</a>
	    <br><br><br>
	    Best Regards,<br><br>
	    Klinik Liliput
	</div>
@endforeach