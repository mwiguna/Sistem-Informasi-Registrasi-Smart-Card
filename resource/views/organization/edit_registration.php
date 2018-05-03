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
					Edit Event
				</div>
			</div>
			<div class="row">
				<div class="col-lg-offset-3 col-lg-6 col-md-offset-2 col-md-8 content">
					<div class="main-box add-reg">
						<p class="nama-org">
							Data Event
						</p>
						<form method="POST" action="<?= url('proses_edit_registrasi') ?>">
							
							<input type="text" name="title" class="form-control mb-2 add-title" placeholder="Judul" pattern=".{1,80}" title="Judul Maksimum 80 Karakter" value="<?= $registration->title ?>" required>
							
							<textarea name="description" class="form-control mb-2 add-desc" placeholder="Deskripsi" pattern=".{1,255}" title="Deskripsi Maksimum 255 Karakter" required><?= $registration->description ?></textarea>

							Batas Peserta : 
							<input type="number" name="max" class="form-control mb-2 add-title" placeholder="Batas Peserta (Isi 0 Bila tidak dibatasi)" value="<?= $registration->max_peserta ?>" required>

							Jadwal Pendaftaran Dibuka :
							<input type="date" name="start" class="form-control mb-2 add-title" placeholder="yyyy-mm-dd" title="Judul Maksimum 80 Karakter" value="<?= $registration->start_date ?>" required>

							Jadwal Pendaftaran Ditutup :
							<input type="date" name="end" class="form-control mb-2 add-title" placeholder="yyyy-mm-dd" title="Judul Maksimum 80 Karakter" value="<?= $registration->end_date ?>" required>
							
							<?php $isNeedPrivate = ($registration->privacy == 1) ? "checked" : ""; ?>

							<input type="checkbox" name="privacy" <?= $isNeedPrivate ?>> <span class="add-priv"> Membutuhkan data private*</span>
							
							<button class="button button-blue button-middle-2 button-add-event">Edit</button>
							<p class="priv-desc">* Untuk mendapatkan data private dibutuhkan persetujuan dari pihak LPTIK. Data private meliputi nomor telepon, email, dan alamat mahasiswa.</p>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>