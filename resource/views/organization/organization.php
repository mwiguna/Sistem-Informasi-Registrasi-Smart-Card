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

						<?php if($organization->id == $auth->id): ?>

							<li><a href="<?= url('') ?>">Daftar Event</a></li>
						
						<?php else: ?>
						
							<li><a href="<?= url('home') ?>">Daftar Organisasi</a></li>	

						<?php endif; ?>

						<li><a href="<?= url('logout') ?>">Logout</a></li>
					</ul>
				</div>
			</div>
		</div>
	</nav>

	<div class="main grey">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-offset-2 col-lg-6 col-md-offset-1 col-md-8 section-title">
					Daftar Event <span class="small-text"><?= $organization->name ?></span>
				</div>

				<?php if($organization->id == $auth->id): ?>

					<div class="col-md-2 col-lg-2 top-button">
						<a href="<?= url('tambah_registrasi') ?>"><button class="button button-top button-green">Tambah event</button></a>
					</div>

				<?php endif; ?>

			</div>
			<div class="row">
				<div class="col-lg-offset-2 col-lg-8 col-md-offset-1 col-md-10 panel panel-default content">

					<?php if(empty($registrations)): ?>

						<div class="main-box add-reg">
							<p class="main-message">Data registrasi masih kosong, silahkan isi menu registrasi.</p>
						</div>

					<?php else: ?>

						<table class="table table-hover main-table">
							<thead>
								<tr>							<th class="col-md-1">No.</th>
									<th class="col-md-5">Perihal</th>
									<th class="col-md-3">Tanggal</th>
									<th class="col-md-3">Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php $i = 1; foreach ($registrations as $registration): ?>
									<tr>
										<td><?= $i ?></td>
										<td><?= $registration->title ?></td>
										<td><?= date('j F Y', strtotime($registration->start_date)) ?></td>
										<td>
											<a href="<?= url('lihat_registrasi/'.Security::encrypt($registration->id)) ?>"><button class="button-small-4 button-green">Lihat</button></a>
											<a href="<?= url('hapus_registrasi/'.Security::encrypt($registration->id)) ?>" onclick="return confirm('Yakin ingin menghapus?')"><button class="button-small-4 button-red">Hapus</button></a>
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