<?php

$kd = base64_decode(@$_GET['user']);
$sql = mysqli_query($conn, "SELECT * FROM t_luser WHERE user = '$kd' ");
$data = mysqli_fetch_assoc($sql);

 ?>

<fieldset>
	<legend>Tulis Saran dan Kritik</legend>

	<form action="" method="post">
		<div class="form-group">
			<label for="nama"></label>
			<input type="hidden" name="nama" id="nama" class="form-control" value="<?= $data['nama']; ?>">
		</div>
		<div class="form-group">
			<label for="kritik">Kritik</label>
			<textarea name="kritik" id="kritik" class="form-control" placeholder="tulis kritik di sini" required></textarea>
		</div>
		<div class="form-group">
			<label for="saran">Saran</label>
			<textarea name="saran" id="saran" class="form-control" placeholder="tulis saran di sini" required></textarea>
		</div>
		<button name="kirim" class="btn btn-success btn-md">
			<span class="glyphicon glyphicon-send"></span> Kirim
		</button>
		<button type="reset" class="btn btn-danger btn-md">
			<span class="glyphicon glyphicon-repeat"></span> Reset
		</button>
		<a href="beranda.php" class="btn btn-warning btn-md">
			<span class="glyphicon glyphicon-remove"></span> Batal
		</a>
	</form>


	<?php

	$nama = @$_POST['nama'];
	$kritik = htmlspecialchars(@$_POST['kritik']);
	$saran = htmlspecialchars(@$_POST['saran']);

	if(isset($_POST['kirim'])){
		$kirim = mysqli_query($conn, "INSERT INTO t_saran VALUES('$nama', '$kritik', '$saran', NULL) " );

		if($kirim){
			echo "
				<script>
					alert('Kritik dan Saran Telah Terkirim');
					document.location.href = '?page=".base64_encode("saran")."';
				</script>
			 ";
		}else{
			echo "
				<script>
					alert('Gagal Mengirim Kritik dan Saran');
					document.location.href = '?page=".base64_encode("saran")."';
				</script>
			 ";
		}
	}

	 ?>

	 <script>
		CKEDITOR.replace( 'kritik' );
		CKEDITOR.replace( 'saran' );
	</script>

</fieldset>