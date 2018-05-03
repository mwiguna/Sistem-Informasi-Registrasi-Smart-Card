
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
					
					<?php 
					$nav = ($this->user()->role == 1) ? "Daftar Organisasi" : "Daftar Event";
					if($registration->id_organization == 1):
						?>
						<li><a href="<?= url('home') ?>">Daftar Organisasi</a></li>	

					<?php else: ?>

						<li><a href="<?= url('') ?>"><?= $nav ?></a></li>	

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
			<div class="col-md-offset-1 col-md-7 col-lg-offset-2 col-lg-6">
				<div class="row">
					<div class="col-lg-10 col-md-9">
						<div class="row">
							<div class="col-md-12 section-title">
								<?= $registration->title ?>
							</div>
							<div class="col-md-12">
								<?= $registration->description ?>
							</div>
							<div class="col-md-12"> Jadwal Pendaftaran :
								<?= 
								date("j F Y", strtotime($registration->start_date)) . " - " .
								date("j F Y", strtotime($registration->end_date))
								?>
							</div>
						</div>
					</div>
					<div class="refreshsh col-lg-2 col-md-3">
						<a class="pull-right" href="<?= url('lihat_registrasi/' . $_SESSION['key']) ?>"><button class="button button-refresh button-green">Refresh</button></a>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 panel panel-default content">

						<?php if($registration->privacy == 1 && $registration->verify == 0){ ?>

						<div class="main-box add-reg">
							<p class="main-message regis">Registrasi ini memerlukan data privasi, maka perlu menunggu persetujuan dari pihak LPTIK agar registrasi ini dapat digunakan.</p>
						</div>

						<?php } else if($registration->privacy == 1 && $registration->verify == 2) { ?>

						<div class="main-box add-reg">
							<p class="main-message regis">Persetujuan data privasi untuk event ini telah ditolak. <br /> Silahkan edit event tanpa data privasi.</p>
						</div>

						<?php } else { ?>

						<table id="member" class="table table-hover main-table">
							<thead>
								<tr>
									<th class="col-md-1">No.</th>
									<th class="col-md-2">NIM</th>
									<th class="col-md-6">Nama</th>
									<th class="col-md-3">Aksi</th>
								</tr>
							</thead>
							<tbody>

								<?php if(empty($members)): ?>

									<div class="col-12 alert alert-info nodata">Belum ada anggota terdaftar</div>

								<?php else: ?>

									<?php $i = 1; foreach ($members as $member): ?>
									<tr>
										<td class="number"><?= $i ?></td>
										<td><?= $member->nim ?></td>
										<td><?= $member->nama ?></td>
										<td>
											<a href="<?= url('lihat_anggota/'.Security::encrypt($member->nim)) ?>"><button class="button-small-3 button-green">Lihat</button></a>
											<a href="<?= url('hapus_anggota/'.Security::encrypt($member->nim)) ?>" onclick="return confirm('Yakin ingin menghapus?')"><button class="button-small-3 button-red">Hapus</button></a>
										</td>
									</tr>

									<?php $i++; endforeach?>

								<?php endif; ?>

							</tbody>


						</table>

						<?php } ?>

					</div>

				</div>
			</div>
			<div class="col-md-3 col-lg-2 key-mt">
				<p class="scan-desc">Scan QR code atau gunakan kode di bawah ini untuk setting pada Pembaca Kartu</p>
				<img src="<?= url('resource/assets/qrcode/'.basename($_SESSION['key'])) ?>.png" />

				<div>
					<input type="text" value="<?= $_SESSION['key'] ?>" class="key form-control input-sm">
					<button class="copyKey copy-btn button button-medium button-blue">Copy</button>
					<div class="msgKey"></div>
				</div>

				<div class="clear"></div>

				<a href="<?= url('dokumentasi_api') ?>"><button class="button button-medium button-green full-width doc-api a-little-space">Dokumentasi API</button></a>

				<a href="<?= url('edit_registrasi/'.$_SESSION['key']) ?>"><button class="button button-medium button-blue-2 full-width a-little-space">Edit Informasi Event</button></a>

				<a href="<?= url('data_tambahan/'.$_SESSION['key']) ?>"><button class="button button-medium button-blue full-width a-little-space">Data Tambahan</button></a>

				<div class="hiddenTable"></div>

				<button class="button button-medium button-purple full-width download_csv">Download CSV</button>
				

			</div>
		</div>

	</div>
</div>

<script src="<?= $GLOBALS['assets'] ?>/js/api_newMember.js"></script>