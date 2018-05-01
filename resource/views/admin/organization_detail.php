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
				Data Organisasi
			</div>
		</div>
		<div class="row">
			<div class="col-lg-offset-3 col-lg-6 col-md-offset-2 col-md-8 content">
				<div class="main-box reg-detail-2">
					<p class="event-title"><?= $organization->name ?></p>
					<table>
						<tr>
							<th>Penanggung Jawab</th>
							<td>:</td>
							<td><a target="_blank" href="<?= url('lihat_anggota/'.Security::encrypt($organization->nim)) ?>"><?= $user->nama ?></td>
							</tr>
							<tr>
								<th>Email</th>
								<td>:</td>
								<td><?= $organization->email ?></td>
							</tr>
							<tr>
								<th>No. Telp</th>
								<td>:</td>
								<td><?= $organization->phone ?></td>
							</tr>
							<tr>
								<th>Tgl. Daftar</th>
								<td>:</td>
								<td><?= date('j F Y', strtotime($organization->date)) ?></td>
							</tr>
						</table>
						<p class="meminta-data bold"><a href="<?= $GLOBALS['assets'].'/file/'.Security::encrypt($organization->id).'.pdf' ?>" target="_blank">Lihat Berkas</a></p>

						<?php if($organization->verify == 0){ ?>

						<div class="middle">Organisasi belum verifikasi KTM</div>

						<?php } else if($organization->verify == 1){ ?>

						<a href="<?= url('approve_organization/'.$organization->id) ?>" onclick="return confirm('Yakin?')"><button class="button button-blue button-middle button-2 bh">Setujui</button></a>

						<?php } ?>
						
					</div>
				</div>
			</div>
		</div>
	</div>