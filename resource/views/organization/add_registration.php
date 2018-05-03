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
					Event Baru
				</div>
			</div>
			<div class="row">
				<div class="col-lg-offset-3 col-lg-6 col-md-offset-2 col-md-8 content">
					<div class="main-box add-reg">
						<p class="nama-org">
							Data Event
						</p>
						<form method="POST" action="<?= url('proses_tambah_registrasi') ?>">
							
							<input type="text" name="title" class="form-control mb-2 add-title" placeholder="Judul" pattern=".{1,80}" title="Judul Maksimum 80 Karakter" required>
							
							<textarea name="description" class="form-control mb-2 add-desc" placeholder="Deskripsi" required></textarea>

							<input type="number" name="max" class="form-control mb-2 add-title" placeholder="Batas Peserta (Isi 0 Bila tidak dibatasi)" required>

							Jadwal Pendaftaran Dibuka :
							<input type="date" name="start" class="form-control mb-2 add-title" placeholder="yyyy-mm-dd" title="Judul Maksimum 80 Karakter" required>

							Jadwal Pendaftaran Ditutup :
							<input type="date" name="end" class="form-control mb-2 add-title" placeholder="yyyy-mm-dd" title="Judul Maksimum 80 Karakter" required>


							
							<input type="checkbox" name="privacy"> <span class="add-priv"> Membutuhkan data private*</span>
							
							<button class="button button-blue button-middle-2 button-add-event">Tambah</button>
							<p class="priv-desc">* Untuk mendapatkan data private dibutuhkan persetujuan dari pihak LPTIK. Data private meliputi nomor telepon, email, dan alamat mahasiswa.</p>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>