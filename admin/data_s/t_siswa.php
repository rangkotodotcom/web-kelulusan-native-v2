<fieldset>
	<legend>Masukan Data Siswa</legend>
	<link rel="stylesheet" type="text/css" href="css/tambah.css">

	<form action="" method="post" enctype="multipart/form-data">
		<table class="table table-striped" width="100%">
			<tr>
				<td>Nama Lengkap</td>
				<td>:</td>
				<td><input type="text" name="nama" /></td>
			</tr>
			<tr>
				<td>Tempat Lahir</td>
				<td>:</td>
				<td><input type="text" name="t_lahir" /></td>
			</tr>
			<tr>
				<td>Tanggal Lahir</td>
				<td>:</td>
				<td><input type="text" name="tgl_lhr" placeholder="22 September 1998" /></td>
			</tr>
			<tr>
				<td>Nama Orang Tua</td>
				<td>:</td>
				<td><input type="text" name="n_ortu" /></td>
			</tr>
			<tr>
				<td>NIS</td>
				<td>:</td>
				<td><input type="text" name="nis" /></td>
			</tr>
			<tr>
				<td>NISN</td>
				<td>:</td>
				<td><input type="text" name="nisn" /></td>
			</tr>
			<tr>
				<td>No Peserta</td>
				<td>:</td>
				<td><input type="text" name="no_pes" placeholder="12-004-xxx-x" /></td>
			</tr>
			<tr>
				<td>Foto</td>
				<td>:</td>
				<td><input type="file" name="foto" /></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td>
					<button name="tambah" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-saved"></span> Tambah</button>
					<button type="reset" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-repeat"></span> Reset</button>
					<a href="?page=<?= base64_encode("d_siswa"); ?>" class="btn btn-warning btn-sm"><span class="glyphicon glyphicon-remove"></span> Batal</a>
				</td>
			</tr>
		</table>

	</form>

	<?php

	$nama = strtoupper(@$_POST['nama']);
	$t_lahir = ucwords(@$_POST['t_lahir']);
	$tgl_lhr = ucwords(@$_POST['tgl_lhr']);
	$n_ortu = ucwords(@$_POST['n_ortu']);
	$nis = @$_POST['nis'];
	$nisn = @$_POST['nisn'];
	$no_pes = @$_POST['no_pes'];

	$sumber = @$_FILES['foto']['tmp_name'];
	$target = 'img/siswa/';
	$nama_foto = @$_FILES['foto']['name'];

	$pecah = explode('.', $nama_foto);
 	$ujung = end($pecah);
 	$ext = strtolower($ujung);

 	$nama_foto_baru = $nama . '.' . $ext;


	if(isset($_POST['tambah'])){
		if($nama == "" || $t_lahir == "" || $tgl_lhr == "" || $n_ortu == "" || $nis == "" || $nisn == "" || $no_pes == "" || $nama_foto == "" ){
			?>
			<script type="text/javascript"> 
				alert("Data tidak boleh ada yang kosong"); 
				window.location.href="?page=<?= base64_encode("d_siswa"); ?>&action=<?= base64_encode("tambah"); ?>";
			</script>

			<?php
		}else{
			$upload = move_uploaded_file($sumber, $target.$nama_foto_baru);

			if($upload){
				mysqli_query($conn, "INSERT INTO t_ld_siswa VALUES('$nama', '$t_lahir', '$tgl_lhr', '$n_ortu', '$nis', '$nisn',  '$no_pes', '$nama_foto_baru')");
				mysqli_query($conn, "INSERT INTO t_history VALUES('', 'tambah data $nama', '$_SESSION[user]', NULL) ");
				?>
				<script type="text/javascript"> alert("Data sudah di tambah"); window.location.href="?page=<?= base64_encode("d_siswa"); ?>"; </script>

				<?php
			}else{
				?>
				<script type="text/javascript"> 
					alert("Foto Gagal di upload"); 
					window.location.href="?page=<?= base64_encode("d_siswa"); ?>&action=<?= base64_encode("tambah"); ?>";
				</script>

				<?php
			}
		}
	}
	

	?>



</fieldset>