<fieldset>
	<legend>Masukan Data Admin</legend>
	<link rel="stylesheet" type="text/css" href="css/tambah.css">

	<form action="" method="post">
		<table class="table table-striped" width="100%">
			<tr>
				<td>Nama Admin</td>
				<td>:</td>
				<td><input type="text" name="nama" autocomplete="off" /></td>
			</tr>
			<tr>
				<td>Username</td>
				<td>:</td>
				<td><input type="text" name="user" autocomplete="off" /></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td>
					<button name="tambah" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-saved"></span> Tambah</button>
					<button type="reset" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-repeat"></span> Reset</button>
					<a href="?page=<?= base64_encode("d_admin"); ?>" class="btn btn-warning btn-sm"><span class="glyphicon glyphicon-remove"></span> Batal</a>
				</td>
			</tr>
		</table>

	</form>

	<?php

	$nama = ucwords(@$_POST['nama']);
	$user = @$_POST['user'];
	$pas = kodeAcak(8);
	$pass = password_hash($pas, PASSWORD_DEFAULT);

	if(isset($_POST['tambah'])){
		if($nama == "" || $user == "" || $pass == ""){
			?>
			<script type="text/javascript"> 
				alert("Data tidak boleh ada yang kosong");
				window.location.href="?page=<?= base64_encode("d_admin"); ?>&action=<?= base64_encode("tambah_a"); ?>"; 
			</script>

			<?php
		}else{
				mysqli_query($conn, "INSERT INTO t_luser VALUES('$nama', '$user', '$pass', 'non-aktif', 'admin', 'belum')");

				$_SESSION['aktif_user_admin'] = time();
				$_SESSION['nama_admin'] = $nama;

			echo "
				<script>
					alert('Admin sudah di tambah. Password ".$nama." adalah ".$pas." ');
					document.location.href = '?page=".base64_encode('d_admin')." ';
				</script>
				 ";
			}
		}		
	?>



</fieldset>