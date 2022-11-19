<fieldset>
	<legend>Assalamu'alaikum <b><?= $_SESSION['nama'];?></b></legend>

	<?php
		$sql = mysqli_query($conn, "SELECT * FROM t_linfo ORDER BY id DESC");
		while ($data = mysqli_fetch_assoc($sql)){

	?>

	<div style="width: 90%" class="panel panel-info" >
		<div class="panel-heading">
			<span style="font-size: 20px; font-family: all;">
				<?= $data['subjek']; ?>
			</span>
		</div>
		<div class="panel-body" align="left">
			<span style="font-family: calibri; font-size: 17px;">
				<?= $data['info']; ?>
			</span>
		</div>
		<div class="panel-footer" align="right">
			<span style="font-size: 10px; text-align: left;">
				Di Tulis pada tanggal <b><?= tanggal(date("j F Y H:i:s", strtotime($data['tanggal']))); ?></b>
			</span>
		</div>
	</div>

	<?php } ?> 

</fieldset>