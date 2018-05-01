<nav class="navbar navbar-default">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-offset-1 col-md-10 col-lg-offset-2 col-lg-8">
				<div class="navbar-header">
					<a class="navbar-brand" href="<?= url('') ?>">
						<img src="<?= url('resource/assets/images/logo.png') ?>">
						<span class="logo-text">SIREG Universitas X</span>
					</a>
				</div>
				<ul class="nav navbar-nav navbar-right">
					<li><a href="<?= url('') ?>">Login</a></li> 
					<li class="atau">atau</li> 
					<li><a href="<?= url('daftar') ?>">Daftar</a></li> 
				</ul>
			</div>
		</div>
	</div>
</nav>

<div class="main grey">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-offset-2 col-lg-8 col-md-offset-1 col-md-10 section-title">
				Daftar Event Universitas
			</div>

		</div>
		<div class="row">
			<div class="col-lg-offset-2 col-lg-8 col-md-offset-1 col-md-10 panel panel-default content">

				<?php if(empty($events)): ?>

					<div class="main-box add-reg">
						<p class="main-message">Registrasi masih kosong.</p>
					</div>

				<?php else: ?>

					<table class="table table-hover main-table">
						<thead>
							<tr>
								<th class="col-md-1">No.</th>
								<th class="col-md-5">Judul Event</th>
								<th class="col-md-3">Organisasi</th>
								<th class="col-md-3">Keterangan</th>
							</tr>
						</thead>
						<tbody>
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
											<div style="color: red">Pendaftaran sudah tutup</div>

											<?php } else { ?>

											<a href="<?= url('pendaftaran_event/'. Security::encrypt($event->id)) ?>"><button class="button-small-4 button-blue">Daftar</button></a>

											<?php } } else { ?>

											<div style="color: green">Pendaftaran dibuka pada <?= date('j F Y', strtotime($event->start_date)) ?></div>

											<?php } ?>
										</td>
									</tr>

									<?php $i++; endforeach; ?>

								</tbody>
							</table>

						<?php endif; ?>

					</div>
				</div>
			</div>
		</div>