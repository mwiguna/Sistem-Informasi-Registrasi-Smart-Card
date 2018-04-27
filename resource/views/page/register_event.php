
<div class="container">

	<table class="table">
		<tr>
			<td width="25%">Nama Event</td>
			<td>:</td>
			<td><?= $event->title ?></td>
		</tr>
		<tr>
			<td>Organisasi / Lembaga Penyelenggara </td>
			<td>:</td>
			<td><?= $event->name ?></td>
		</tr>
		<tr>
			<td>Periode Pendaftaran </td>
			<td>:</td>
			<td>
				<?= 
					date("j F Y", strtotime($event->start_date)) . " - " .
					date("j F Y", strtotime($event->end_date))
				?>
			</td>
		</tr>
	</table>

	<div>
		Scan QR Code dibawah ini lalu tap KTM untuk mendaftar 
		<img src="<?= url('resource/assets/qrcode/'.basename($key)) ?>.png"">
	</div>

</div>