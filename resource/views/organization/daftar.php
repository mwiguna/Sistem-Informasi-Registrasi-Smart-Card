
<div class="container">
	<div class="row">
		<div class="col-12">
			<h4>Pendaftaran Organisasi Sistem Informasi Registrasi</h4>
		</div>
		<div class="col-4 offset-5">
			<form method="POST" action="<?= url('register') ?>" enctype="multipart/form-data">
				<input type="text"     name="name" class="form-control mb-2" placeholder="Nama Organisasi" required pattern=".{1,60}" title="Nama Organisasi Maksimum 60 Karakter">
				<input type="text"     name="nim"  class="form-control mb-2" placeholder="NIP / NIM Penanggung Jawab" required pattern=".{9,18}" title="Mohon masukkan NIP / NIM yang valid">
				<input type="number"   name="phone"   class="form-control mb-2" placeholder="Nomor Telepon" required>
				<input type="text"     name="email"    class="form-control mb-2" placeholder="E-mail" required >
				<input type="text"     name="username" class="form-control mb-2 validate-username" placeholder="Username" required pattern=".{1,40}" title="Username Maksimum 40 Karakter">
				<div class="msg-username"></div>

				<input type="password" name="password" class="form-control mb-2" placeholder="Password" required>
				<input type="password" name="validate" class="form-control mb-2 validate-password" placeholder="Ulangi Password" required>
				<div class="msg-password"></div>
				Berkas Organisasi : <input type="file" name="berkas" accept="application/pdf" required>
				<input type="submit" class="btn btn-primary" value="Daftar">
			</form>
		</div>
	</div>
</div>