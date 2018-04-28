

<div class="container">

	<table class="table">
		<tr>
			<td>No.</td>
			<td>Judul Event</td>
			<td colspan="2">Organisasi / Lembaga</td>
		</tr>

		<?php
			$i = 1; foreach($events as $event):

		    $now   = new DateTime(date('Y-m-d'));
		    $start = new DateTime($event->start_date);
		    $end   = new DateTime($event->end_date);

			$diffLeft  = $now->diff($end);
			$diffStart = $now->diff($start);

			$diffStart = (integer) $diffStart->format( "%R%a");
			$diffLeft  = (integer) $diffLeft->format( "%R%a");
		?>

			<tr>
				<td><?= $i ?></td>
				<td><?= $event->title ?></td>
				<td><?= $event->name ?></td>
				<td>
					<?php 
						if($diffStart < 0){
					 		if($diffLeft < 0){ 
					 ?>
							<div>Pendaftaran sudah tutup</div>

							<?php } else { ?>
				
							<a href="<?= url('pendaftaran_event/'. Security::encrypt($event->id)) ?>">Daftar</a>
				
					<?php } } else { ?>

						<div>Pendaftaran dibuka pada <?= date('j F Y', strtotime($event->start_date)) ?></div>

					<?php } ?>
				</td>
			</tr>

		<?php $i++; endforeach; ?>
	</table>

</div>
