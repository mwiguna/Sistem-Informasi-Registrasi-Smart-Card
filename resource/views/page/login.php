
<div class="jumbotron">Sistem Informasi Registrasi</div>

<div class="container">
	<div class="row">
		<div class="col-6">
			<h4>Selamat datang di Sistem Informasi Registrasi Universitas Norman.</h4>
			<a href="<?= url('daftar') ?>" class="btn btn-success col-4">Daftar</a>
		</div>
		<div class="col-4 offset-5">
			<div class="col-12">Login</div>
			<form method="POST" action="<?= url('login') ?>">
				<input type="text"     name="username" class="form-control mb-2" placeholder="Username" required>
				<input type="password" name="password" class="form-control mb-2" placeholder="Password" required>
				<input type="submit" class="btn btn-primary" value="Login">
				<?= (isset($msg)) ? $msg : null; ?>
			</form>
		</div>
	</div>
</div>