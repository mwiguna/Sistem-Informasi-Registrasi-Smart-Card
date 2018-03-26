
<div class="container">
	<h3>Persetujuan Organisasi</h3>
	<table class="table">
		<tr>
			<td>No.</td>
			<td>Nama Organisasi</td>
			<td>Tanggal Mendaftar</td>
			<td>Aksi</td>
		</tr>

		<?php $i = 1; foreach($organizations as $organization): ?>
		<tr>
			<td><?= $i ?></td>
			<td><?= $organization->name ?></td>
			<td><?= date('j F Y', strtotime($organization->date) ); ?></td>
			<td>
				<?php if($organization->verify == 1): ?>
				
				<a href="<?= url('detail_organisasi/'.Security::encrypt($organization->id)) ?>" class="btn btn-primary">Lihat</a>

				<?php else: ?> Belum Verifikasi
				<?php endif; ?>

				<a href="<?= url(' hapus_organisasi/'.$organization->id) ?>"  class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
			</td>
		</tr>
		<?php $i++; endforeach; ?>
	
	</table>
</div>