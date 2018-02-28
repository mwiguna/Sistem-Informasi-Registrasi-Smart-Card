
<div class="container">
	<h3>Persetujuan Data</h3>
	<table class="table">
		<tr>
			<td>No.</td>
			<td>Perihal</td>
			<td>Tanggal</td>
			<td>Aksi</td>
		</tr>

		<?php if(empty($registrations)): ?> 

			<div class="alert alert-info">Belum ada registrasi yang membutuhkan persetujuan</div>

		<?php endif; $i = 1; foreach($registrations as $registration): ?>
		
		<tr>
			<td><?= $i ?></td>
			<td><?= $registration->title ?></td>
			<td><?= date('j F Y', strtotime($registration->date)) ?></td>
			<td><a href="<?= url('detail_persetujuan/'.Security::encrypt($registration->id)) ?>" class="btn btn-primary">Lihat</a></td>
		</tr>

		<?php $i++; endforeach; ?>

	</table>
</div>