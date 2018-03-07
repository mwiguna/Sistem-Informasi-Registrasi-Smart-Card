
<div class="container">
	<div class="col-lg-12">
		<a href="<?= url('persetujuan_data') ?>" class="btn btn-success col-lg-2">Persetujuan Data</a>
		<a href="<?= url('logout') ?>" class="btn btn-danger  col-lg-2">Logout</a>
	</div>

	<h3>Daftar Lembaga / Organisasi</h3>

	<table class="table table-striped">
		<tr>
			<td>No.</td>
			<td>Nama Organisasi</td>
			<td>Aksi</td>
		</tr>

		<?php $i = 1; foreach($organizations as $organization): ?>
		<tr>
			<td><?= $i ?></td>
			<td><?= $organization->name ?></td>
			<td>
				<a href="<?= url('detail_organisasi/'.Security::encrypt($organization->id)) ?>" class="btn btn-success">Detail</a>
				<a href="<?= url('lihat_organisasi/'.Security::encrypt($organization->id)) ?>"  class="btn btn-primary">Lihat Registrasi</a>
				<a href="<?= url(' hapus_organisasi/'.$organization->id) ?>"  class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
			</td>
		</tr>
		<?php $i++; endforeach; ?>

	</table>
</div>