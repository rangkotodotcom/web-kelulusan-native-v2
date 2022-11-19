<fieldset>
	<legend>Masukan Data User</legend>
	<link rel="stylesheet" type="text/css" href="css/tambah.css">

	<form action="" method="post">
		<table class="table table-striped" width="100%">
			<tr>
				<td>Nama Siswa</td>
				<td>:</td>
				<td>
					<input type="text" name="nama" autocomplete="off" />
				</td>
			</tr>
			<tr>
				<td>Username</td>
				<td>:</td>
				<td>
					<input type="text" name="user" placeholder="12-004-xxx-x" autocomplete="off" />
				</td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td>
					<button name="tambah" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-saved"></span> Tambah</button>
					<button type="reset" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-repeat"></span> Reset</button>
					<a href="?page=<?= base64_encode("d_user"); ?>" class="btn btn-warning btn-sm"><span class="glyphicon glyphicon-remove"></span> Batal</a></td>
			</tr>
		</table>

	</form>

	<?php

	$nama = ucwords(@$_POST['nama']);
	$user = @$_POST['user'];
	$pass = kodeAcak(8);

	if(isset($_POST['tambah'])){
		if($nama == "" || $user == ""){
			?>
			<script type="text/javascript"> 
				alert("Data tidak boleh ada yang kosong"); 
				window.location.href="?page=<?= base64_encode("d_user"); ?>&action=<?= base64_encode("tambah_u"); ?>";
			</script>

			<?php
		}else{
				mysqli_query($conn, "INSERT INTO t_luser VALUES('$nama', '$user', '$pass', 'non-aktif', 'siswa', 'belum')");
				mysqli_query($conn, "INSERT INTO t_history VALUES('', 'tambah user $nama', '$_SESSION[user]', NULL) ");	

			?>

			<script type="text/javascript"> 
				alert("User Berhasil di Tambah"); 
				window.location.href="?page=<?= base64_encode("d_user"); ?>";
			</script>

			<?php
		}

	}		
	?>



</fieldset>