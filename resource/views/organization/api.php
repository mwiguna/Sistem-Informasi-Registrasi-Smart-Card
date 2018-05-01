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
					<p>Dokumentasi API</p>
					<p class="api-desc">Halaman ini dikhususkan bagi <strong>Developer</strong> yang ingin mengakses data ke sistem yang dibuat</p>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-offset-2 col-lg-8 col-md-offset-1 col-md-10 content content-api">
					<div class="main-box reg-detail">
						<div class="api-section">
							<p class="event-title api">API</p>
							<div class="api-sub-section">
								<p class="sub">Data Registrasi</p>
								<pre>
url : <a href="<?= url('api/get/'.$token) ?>">https://sireg.unja.ac.id/api/get/<?= $token ?></a>
method : GET
								</pre>
								<p>Data yang disediakan merupakan data mahasiswa terdaftar pada registrasi gather</p>	
							</div>
							<div class="api-sub-section">
								<p class="sub">Hapus Data Registrasi</p>
								<pre>
url : https://sireg.unja.ac.id/api/delete 
method : POST
body: 
{
	key: <?= $token ?>

	nim: NIM Mahasiswa
}
								</pre>	
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-offset-2 col-lg-8 col-md-offset-1 col-md-10 content content-api">
					<div class="main-box reg-detail">
						<div class="api-section">
							<p class="event-title api">WebHook</p>
							<div class="api-sub-section">

								<form class="webhook" method="POST">
									<input class="form-control wh-input" type="text" name="url" placeholder="URL anda" value="<?= Security::decrypt($registration->url) ?>">
									<button class="button button-blue wh-button">Submit</button>
									<div class="clear"></div>
									<div class="response"></div>
								</form>

								<div class="clear"></div>
								<p class="run-out-of-name-idea">Data akan dikirimkan setiap terdapat data baru yang masuk ke registrasi <strong>Pendaftaran Perpustakaan 2018</strong></p>	
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>