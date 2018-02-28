
<table id="csvTable" border="1">
	<?php $col = ($_SESSION['privacy']) ? 8 : 5 ?>

	<tr><td colspan="<?= $col ?>"><?= $registration->title ?></td></tr>
	<tr><td colspan="<?= $col ?>"><?= $registration->description ?></td></tr>
	<tr>
		<td>No.</td>
		<td>NIM</td>
		<td>Nama</td>
		<td>Prodi</td>
		<td>Fakultas</td>

		<?php if($_SESSION['privacy']): ?>

		<td>Alamat</td>
		<td>No. HP</td>
		<td>E-mail</td>

		<?php endif; ?>
	</tr>

	<?php $i = 1; foreach ($members as $member): ?>
			
		<tr>
			<td><?= $i ?></td>
			<td><?= $member->nim ?></td>
			<td><?= $member->nama ?></td>
			<td><?= $member->prodi ?></td>
			<td><?= $member->fakultas ?></td>

			<?php if($_SESSION['privacy']): ?>

			<td><?= $member->alamat ?></td>
			<td><?= $member->nohp ?></td>
			<td><?= $member->email ?></td>

			<?php endif; ?>
		</tr>

	<?php $i++; endforeach; ?>
</table>