@foreach ($data as $d)
	<div>
		YTh. Bapak/ Ibu <br>
		Di tempat <br> <br>

		Dengan Hormat, <br>
		Berikut kami lampirkan Tagihan terapi Ananda di Liliput Bulan <?php echo date('F'); ?> <br>
		Mohon Bapak dan Ibu untuk cek.<br>
		Pembayaran melalui transfer dapat di lakukan ke No. Rekening: <br>
		MANDIRI <br>
		a/n Yayasan Rumah Rindang <br>
		1260006265580 <br>
		Bukti Pembayaran mohon dapat di Upload di Account Ananda masing" dengan menyertakan jumlah pembeyaran untuk dapat kami Verifikasi di rekening kami. <br>
		Jika bukti pembayaran tidak di Upload maka pembayaran Ananda kami anggap belum dilakukan. <br> <br>

		*Note <br>
		  Account Ananda dapat di download <a href="http://localhost:8000/print/billing/{{ $d->id_bill }}" target="_Blank">di sini</a> atau hubungi 021 7581 6662 untuk informasi lebih lanjut. <br> <br>

		Demikian informasi yang kami sampaikan. <br>
		Atas perhatian Bapak dan Ibu kami sampaikan terimakasih. <br> <br>

		Kind Regards, <br>
		LILIPUT-Helping Hands in Your Child's Development <br> <br> <br>
	</div>
@endforeach