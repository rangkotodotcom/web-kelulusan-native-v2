<?php 

$sql = mysqli_query($conn, "SELECT * FROM t_luser WHERE level = 'siswa' ");

 ?>
<fieldset>
	<legend><?= $_SESSION['nama']; ?></legend>
	<link rel="stylesheet" type="text/css" href="css/tambah.css">

	<form action="" method="post">
		<table class="table table-striped" width="100%">
			<tr>
				<td>Penerima</td>
				<td>:</td>
				<td>
					<select name="penerima" required>
			 			<option value="">Tujuan</option>
			 			<?php while($data = mysqli_fetch_assoc($sql)){ ?>
			 			<option value="<?= $data['nama']; ?>"><?= $data['nama']; ?></option>
			 			<?php } ?>
			 		</select>
				</td>
			</tr>
			<tr>
				<td>Pesan</td>
				<td>:</td>
				<td>
					<textarea name="isi" rows="4" id="isi"></textarea>
				</td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td>
					<button name="kirim" class="btn btn-success btn-sm">
						<span class="glyphicon glyphicon-send"></span> Kirim
					</button>
					<button type="reset" class="btn btn-danger btn-sm">
						<span class="glyphicon glyphicon-repeat"></span> Reset
					</button>
					<a href="?page=<?= base64_encode("pesan"); ?>" class="btn btn-warning btn-sm">
						<span class="glyphicon glyphicon-remove"></span> Batal
					</a>
				</td>
			</tr>
		</table>

	</form>

	<?php

	$pengirim = $_SESSION['nama'];
	$penerima = @$_POST['penerima'];
	$isi = @$_POST['isi'];

	if(isset($_POST['kirim'])){
		if($penerima == "" || $isi == ""){
			?>
			<script type="text/javascript"> 
				alert("Tidak boleh ada yang kosong"); 
				window.location.href="?page=<?= base64_encode("pesan"); ?>&action=<?= base64_encode("b_pesan"); ?>";
			</script>

			<?php
		}else{
				mysqli_query($conn, "INSERT INTO t_pesan VALUES('', '$pengirim', '$penerima', '$isi', NULL, 'belum')");

			?>

			<script type="text/javascript"> 
				alert("Pesan Terkirim"); 
				window.location.href="?page=<?= base64_encode("pesan"); ?>";
			</script>

			<?php
		}

	}		
	?>

	<script>
		CKEDITOR.replace( 'isi' );
	</script>

</fieldset>