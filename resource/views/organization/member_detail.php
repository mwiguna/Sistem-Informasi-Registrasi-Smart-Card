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
					<li><a href="<?= url('logout') ?>">Logout</a></li>
				</ul>
			</div>
		</div>
	</div>
</nav>

<div class="main grey">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-offset-2 col-md-6 section-title">
				Data Anggota
			</div>
		</div>
		<div class="row">
			<div class="col-md-offset-3 col-md-6 content">
				<div class="main-box reg-detail-3">
					<table>
						<tr>
							<th>NIM</th>
							<td>:</td>
							<td><?= $member->nim ?></td>
						</tr>
						<tr>
							<th>Nama</th>
							<td>:</td>
							<td><?= $member->nama ?></td>
						</tr>
						<tr>
							<th>Program Studi</th>
							<td>:</td>
							<td><?= $member->prodi ?></td>
						</tr>
						<tr>
							<th>Fakultas</th>
							<td>:</td>
							<td><?= $member->fakultas ?></td>
						</tr>

						<?php if($_SESSION['privacy']): ?>

							<tr>
								<th>Alamat</th>
								<td>:</td>
								<td><?= $member->alamat ?></td>
							</tr>
							<tr>
								<th>No. Telp</th>
								<td>:</td>
								<td><?= $member->nohp ?></td>
							</tr>
							<tr>
								<th>Email</th>
								<td>:</td>
								<td><a href="mailto:<?= $member->email ?>"><?= $member->email ?></a></td>
							</tr>

						<?php
							endif;
							if(isset($dataAdditional)):
								foreach ($dataAdditional as $data):
						?>

							<tr>
								<td><?= $data->desc ?></td>
								<td>:</td>
								<td><?= $data->val ?></td>
							</tr>

						<?php endforeach; endif; ?>

						</table>

					</div>
				</div>
			</div>
		</div>
	</div>