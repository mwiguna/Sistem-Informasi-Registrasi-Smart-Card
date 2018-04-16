
<div class="container">
	<div class="row">
		<h3 class="col-12">Lengkapi Data Pendaftaran :</h3>
		<form class="col-12" method="POST" action="<?= url('tambah_data_tambahan_member') ?>">
			<div class="member"><i>(Tap KTM di NFC Reader untuk mendaftar)</i></div>

			<input type="hidden" name="nim">

			<?php foreach ($additionals as $additional): ?>
			
				<input type="text" class="form-control" name="<?= Security::encrypt($additional->id) ?>"  placeholder="<?= $additional->description ?>">
			
			<?php endforeach; ?>
			
			<input type="submit" value="Kirim" class="col-1 btn btn-primary submit" disabled>
		</form>
	</div>
	<div class="key hide"><?= $_SESSION['key'] ?></div>
</div>

<script src="<?= $GLOBALS['assets'] ?>/js/additionalForm.js"></script>