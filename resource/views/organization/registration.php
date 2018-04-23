
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
					
					<?php if($registration->id_organization == 1): ?>
					
						<li><a href="<?= url('home') ?>">Daftar Organisasi</a></li>	
					
					<?php else: ?>

						<li><a href="<?= url('') ?>">Daftar Event</a></li>	

					<?php endif; ?>

					<li><a href="<?= url('logout') ?>">Logout</a></li>
				</ul>
			</div>
		</div>
	</div>
</nav>

<div class="main grey">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-offset-2 col-md-6">
				<div class="row">
					<div class="col-md-12 section-title">
						<?= $registration->title ?>
					</div>
					<div class="col-md-12">
						<?= $registration->description ?>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 panel panel-default content">

						<?php if($registration->privacy == 1 && $registration->verify == 0): ?>

							<div class="main-box add-reg">
								<p class="main-message regis">Registrasi ini memerlukan data privasi, maka perlu menunggu persetujuan dari pihak LPTIK agar registrasi ini dapat digunakan.</p>
							</div>

						<?php else: ?>

							<table class="table table-hover main-table">
								<thead>
									<tr>
										<th class="col-md-1">No.</th>
										<th class="col-md-2">NIM</th>
										<th class="col-md-6">Nama</th>
										<th class="col-md-3">Aksi</th>
									</tr>
								</thead>

								<?php if(empty($members)): ?>

									<div class="col-12 alert alert-info nodata">Belum ada anggota terdaftar</div>

								<?php else: ?>

									<tbody>

									<?php $i = 1; foreach ($members as $member): ?>
										<tr>
											<td><?= $i ?></td>
											<td><?= $member->nim ?></td>
											<td><?= $member->nama ?></td>
											<td>
												<a href="<?= url('lihat_anggota/'.Security::encrypt($member->nim)) ?>"><button class="button-small-3 button-green">Lihat</button></a>
												<a href="<?= url('hapus_anggota/'.Security::encrypt($member->nim)) ?>" onclick="return confirm('Yakin ingin menghapus?')"><button class="button-small-3 button-red">Hapus</button></a>
											</td>
										</tr>

									<?php $i++; endforeach?>

									</tbody>

								<?php endif; ?>

							</table>

						<?php endif; ?>

						</div>

					</div>
				</div>
				<div class="col-md-2 key-mt">
					<p class="scan-desc">Scan QR code atau gunakan kode di bawah ini untuk setting pada Pembaca Kartu</p>
					<img src="<?= url('resource/assets/qrcode/'.basename($_SESSION['key'])) ?>.png" />
					
					<div>
						<input type="text" value="<?= $_SESSION['key'] ?>" class="key form-control input-sm">
						<button class="copyKey copy-btn button button-medium button-blue">Copy</button>
						<div class="msgKey"></div>
					</div>
					
					<div class="clear"></div>
					
					<a href="<?= url('dokumentasi_api') ?>"><button class="button button-medium button-green full-width doc-api a-little-space">Dokumentasi API</button></a>
					
					<a href="<?= url('data_tambahan/'.$_SESSION['key']) ?>"><button class="button button-medium button-blue full-width a-little-space">Data Tambahan</button></a>
					
					<div class="hiddenTable"></div>
					
					<button class="button button-medium button-purple full-width download_csv">Download CSV</button>
				

				</div>
			</div>

		</div>
	</div>