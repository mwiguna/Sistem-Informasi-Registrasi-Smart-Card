
<div class="container">
	<h3>Persetujuan Organisasi</h3>
	<table class="table">
		<tr>
			<td>No.</td>
			<td>Nama Organisasi</td>
			<td>Tanggal</td>
			<td>Aksi</td>
		</tr>

		<?php $i = 1; foreach($organizations as $organization): ?>
		<tr>
			<td><?= $i ?></td>
			<td><?= $organization->name ?></td>
			<td><?= date('j F Y', strtotime($organization->date) ); ?></td>
			<td>
				<a href="<?= url('detail_organisasi/'.$organization->id) ?>" class="btn btn-primary">Lihat</a>
			</td>
		</tr>
		<?php $i++; endforeach; ?>
	
	</table>
</div>