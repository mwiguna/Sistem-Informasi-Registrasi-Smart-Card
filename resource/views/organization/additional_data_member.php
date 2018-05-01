
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
						<li><a href="<?= url('') ?>">Daftar Event</a></li>
						<li><a href="<?= url('logout') ?>">Logout</a></li>
					</ul>
				</div>
			</div>
		</div>
	</nav>

	<div class="main grey">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-offset-2 col-lg-8 col-md-offset-1 col-md-10 section-title">
					Lengkapi Data Pendaftaran
				</div>
			</div>
			<div class="row">
				<div class="col-lg-offset-2 col-lg-8 col-md-offset-1 col-md-10 content">
					<div class="main-box add-reg">
						<p class="member nama-mhs"><i>(Tap KTM di NFC Reader untuk mendaftar)</i></p>
						<form class="add-form-form" method="POST" action="<?= url('tambah_data_tambahan_member') ?>">
							<input type="hidden" name="nim">

							<?php foreach ($additionals as $additional): ?>

								<input class="form-control a-little-space-2" type="text" name="<?= Security::encrypt($additional->id) ?>" placeholder="<?= $additional->description ?>" />

							<?php endforeach; ?>

							<input type="submit" value="Kirim" class="button button-2 button-blue bh bc submit" disabled>
						</form>
					</div>
				</div>
				<div class="key hide"><?= $_SESSION['key'] ?></div>
			</div>
		</div>
	</div>

	<script src="<?= $GLOBALS['assets'] ?>/js/additionalForm.js"></script>