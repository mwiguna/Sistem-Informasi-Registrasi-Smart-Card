

<div class="container">

	<table class="table">
		<tr>
			<td>No.</td>
			<td>Judul Event</td>
			<td colspan="2">Organisasi / Lembaga</td>
		</tr>

		<?php $i = 1; foreach($events as $event): ?>

			<tr>
				<td><?= $i ?></td>
				<td><?= $event->title ?></td>
				<td><?= $event->name ?></td>
				<td><a href="<?= url('pendaftaran_event/'. Security::encrypt($event->id)) ?>">Daftar</a></td>
			</tr>

		<?php $i++; endforeach; ?>
	</table>

</div>
