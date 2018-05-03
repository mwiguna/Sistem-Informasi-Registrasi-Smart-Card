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
					<li><a href="<?= url('home') ?>">Daftar Organisasi</a></li>
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
				Persetujuan Data
			</div>
		</div>
		<div class="row">
			<div class="col-lg-offset-3 col-lg-6 col-md-offset-2 col-md-8 content">
				<div class="main-box reg-detail">
					<p class="event-title"><?= $registration->title ?></p>
					<table>
						<tr>
							<th>Organisasi</th>
							<td>:</td>
							<td><?= $organization->name ?></td>
						</tr>
						<tr>
							<th>Deskripsi</th>
							<td>:</td>
							<td><?= $registration->description ?></td>
						</tr>
					</table>
					<p class="meminta-data">Meminta data untuk:</p>
					<div class="data-list">
						<p>Data pribadi mahasiswa yang meliputi:</p>
						- No telepon <br />
						- Email <br />
						- Alamat <br />
					</div>
					<div class="button-group">
						<a href="<?= url('approve_event/'.$registration->id) ?>" onclick="return confirm('Yakin?')"><button class="button button-blue button-middle button-2 bh">Setujui</button></a>
						<a href="<?= url('unapprove_event/'.$registration->id) ?>" onclick="return confirm('Yakin?')"><button class="button button-red button-middle button-2 bh">Tidak Setuju</button></a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>