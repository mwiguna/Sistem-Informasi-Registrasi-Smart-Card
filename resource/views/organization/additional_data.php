<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-offset-2 col-md-8">
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
				<div class="col-md-offset-2 col-md-8 section-title">
					Data Tambahan
				</div>
			</div>
			<div class="row add-form">
				<div class="col-md-offset-2 col-md-8">
					<form method="POST" action="<?= url('tambah_data_tambahan') ?>">
						<input class="form-control" type="text" name="data" placeholder="Masukkan data tambahan yang diperlukan" required>
						<button class="button button-2 button-blue">Tambah</button>
					</form>
				</div>
			</div>
			<div class="row">
				<div class="col-md-offset-2 col-md-8 panel panel-default content-2">
					<table class="table table-hover main-table">
						<thead>
							<tr>
								<th class="col-md-1">No.</th>
								<th class="col-md-9">Data</th>
								<th class="col-md-2">Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php $i = 1; foreach ($additionals as $additional): ?>
							<tr>
								<td><?= $i ?></td>
								<td><?= $additional->description ?></td>
								<td>
									<a href="<?= url('hapus_tambahan/'.Security::encrypt($additional->id)) ?>"><button class="button-small-2 button-red" onclick="return confirm('Yakin?')">Hapus</button></a>
								</td>
							</tr>
							<?php $i++; endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
			<div class="row">
				<div class="col-md-offset-2 col-md-8">
					<a href="<?= url('halaman_pendaftar/'.$_SESSION['key']) ?>"><button class="button button-2 button-blue pendaftar-button">Halaman Pendaftar &raquo;</button></a>
				</div>
			</div>
		</div>
	</div>