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
					<li><a href="<?= url('') ?>">Login</a></li> 
					<li class="atau">atau</li> 
					<li><a href="<?= url('daftar') ?>">Daftar</a></li> 
				</ul>
			</div>
		</div>
	</div>
</nav>

<div class="main grey">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-offset-2 col-lg-8 col-md-offset-1 col-md-10 section-title">
				Pendaftaran Event
			</div>
		</div>
		<div class="row">
			<div class="col-lg-offset-3 col-lg-6 col-md-offset-2 col-md-8 content">
				<div class="main-box reg-detail reg-detail-4">
					<p class="event-title"><?= $event->title ?></p>
					<table>
						<tr>
							<th>Penyelenggara</th>
							<td>:</td>
							<td><?= $event->name ?></td>
						</tr>
						<tr>
							<th>Periode Pendaftaran</th>
							<td>:</td>
							<td>
								<?= 
								date("j F Y", strtotime($event->start_date)) . " - " .
								date("j F Y", strtotime($event->end_date))
								?>
							</td>
						</tr>
					</table>
					<p class="meminta-data">Scan QR Code dibawah ini lalu tap KTM untuk mendaftar </p>
					<img src="<?= url('resource/assets/qrcode/'.basename($key)) ?>.png"">
				</div>
			</div>
		</div>
	</div>
</div>