<fieldset>
	<legend>Tulis Pengumuman Admin</legend>

	<form action="" method="post">
		<div class="form-group" style="width: 35%;">
			<input type="text" name="subjek" class="form-control" autocomplete="off" placeholder="Subjek">
		</div>
		<div class="form-group">
			<textarea name="info" id="info" class="form-control" rows="13" placeholder="Isi Pengumuman"></textarea>
		</div>
			<button name="kirim" class="btn btn-success btn-sm">
				<span class="glyphicon glyphicon-saved"></span> Kirim
			</button>
			<button type="reset" class="btn btn-danger btn-sm">
				<span class="glyphicon glyphicon-repeat"></span> Reset
			</button>
			<a href="?page=<?= base64_encode("info_a"); ?>" class="btn btn-warning btn-sm">
				<span class="glyphicon glyphicon-remove"></span> Batal
			</a>
	</form>
	

	<?php
	$subjek = ucwords(@$_POST['subjek']);
	$info = @$_POST['info'];

	if(isset($_POST['kirim'])){
		if($subjek == "" || $info == ""){
			?>
			<script type="text/javascript"> 
				alert("Jangan Dikirim Kalau Kosong"); 
				window.location.href="?page=<?= base64_encode("info_a"); ?>&action=<?= base64_encode("t_info_a"); ?>";
			</script>

			<?php
		}else{
			mysqli_query($conn, "INSERT INTO t_linfo_a VALUES('', '$subjek', '$info', NULL) ");
			?>
			<script type="text/javascript"> alert("Info Sudah Dikirim"); window.location.href="?page=<?= base64_encode("info_a"); ?>"; </script>

			<?php
		}
	}

	?>

	<script>
		CKEDITOR.replace( 'info' );
	</script>

</fieldset>