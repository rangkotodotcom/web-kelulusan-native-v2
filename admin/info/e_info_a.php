<?php

$kd = base64_decode(@$_GET['id']);
$sql = mysqli_query($conn, "SELECT * FROM t_linfo_a WHERE id = '$kd' ");
$data = mysqli_fetch_assoc($sql);

?>
<fieldset>
	<legend>Edit Pengumuman Admin</legend>

	<form action="" method="post">
		<div class="form-group" style="width: 35%;">
			<input type="text" name="subjek" class="form-control" autocomplete="off" value="<?= $data['subjek']; ?>">
		</div>
		<div class="form-group">
			<textarea name="info" id="info" class="form-control" rows="13"><?= $data['info']; ?></textarea>
		</div>
			<button name="edit" class="btn btn-success btn-sm">
				<span class="glyphicon glyphicon-saved"></span> Edit
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

	if(isset($_POST['edit'])){
		if($subjek == "" || $info == ""){
			?>
			<script type="text/javascript"> 
				alert("Jangan Dikirim Kalau Kosong"); 
				window.location.href="?page=<?= base64_encode("info_a"); ?>&action=<?= base64_encode("e_info_a"); ?>&id=<?= base64_encode($data['id']); ?>";
			</script>

			<?php
		}else{
			mysqli_query($conn, "UPDATE t_linfo_a SET subjek = '$subjek', info = '$info', tanggal = NULL WHERE id = '$kd' ");
			?>
			<script type="text/javascript"> alert("Info Sudah Di Update"); window.location.href="?page=<?= base64_encode("info_a"); ?>"; </script>

			<?php
		}
	}

	?>

	<script>
		CKEDITOR.replace( 'info' );
	</script>

</fieldset>