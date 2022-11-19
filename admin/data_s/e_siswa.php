<?php

$kd = base64_decode(@$_GET['nisn']);
$sql = mysqli_query($conn, "SELECT * FROM t_ld_siswa WHERE nisn= '$kd' ");
$data = mysqli_fetch_assoc($sql);

?>

<fieldset>
	<legend>Edit Data Siswa</legend>
	<link rel="stylesheet" type="text/css" href="css/tambah.css">

	<form action="" method="post" enctype="multipart/form-data">
		<table class="table table-striped" width="100%">
			<tr>
				<td>Nama Lengkap</td>
				<td>:</td>
				<td><input type="text" name="nama" value="<?= $data['nama']; ?>" /></td>
			</tr>
			<tr>
				<td>Tempat Lahir</td>
				<td>:</td>
				<td><input type="text" name="t_lahir" value="<?= $data['t_lahir']; ?>" /></td>
			</tr>
			<tr>
				<td>Tanggal Lahir</td>
				<td>:</td>
				<td><input type="text" name="tgl_lhr" value="<?= $data['tgl_lhr']; ?>" /></td>
			</tr>
			<tr>
				<td>Nama Orang Tua</td>
				<td>:</td>
				<td><input type="text" name="n_ortu" value="<?= $data['n_ortu']; ?>" /></td>
			</tr>
			<tr>
				<td>NIS</td>
				<td>:</td>
				<td><input type="text" name="nis" value="<?= $data['nis']; ?>" /></td>
			</tr>
			<tr>
				<td>NISN</td>
				<td>:</td>
				<td><input type="text" name="nisn" value="<?= $data['nisn']; ?>" /></td>
			</tr>
			<tr>
				<td>No Peserta</td>
				<td>:</td>
				<td><input type="text" name="no_pes" value="<?= $data['no_pes']; ?>" readonly /></td>
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
					<button name="edit" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-saved"></span> Simpan</button>
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


	if(isset($_POST['edit'])){
		if($nama == "" || $t_lahir == "" || $tgl_lhr == "" || $n_ortu == "" || $nis == "" || $nisn == "" || $no_pes == "" ){
			?>
			<script type="text/javascript"> 
				alert("Data tidak boleh ada yang kosong"); 
				window.location.href="?page=<?= base64_encode("d_siswa"); ?>&action=<?= base64_encode("edit"); ?>&nisn=<?= base64_encode($data['nisn']); ?>";
			</script>

			<?php
		}else{
			if($nama_foto == ""){
				mysqli_query($conn, "UPDATE t_ld_siswa SET nama = '$nama', t_lahir = '$t_lahir', tgl_lhr = '$tgl_lhr', n_ortu = '$n_ortu', nis = '$nis', nisn = '$nisn', no_pes = '$no_pes' WHERE nisn = '$kd' ");
				mysqli_query($conn, "INSERT INTO t_history VALUES('', 'edit data $nama', '$_SESSION[user]', NULL) ");
					?>
					<script type="text/javascript"> alert("Data sudah di edit"); window.location.href="?page=<?= base64_encode("d_siswa"); ?>"; </script>

					<?php 
			}else{
				$foto_awal = $data['foto'];

				unlink('img/siswa/' .$foto_awal);

				$upload = move_uploaded_file($sumber, $target.$nama_foto_baru);

				if($upload){
					mysqli_query($conn, "UPDATE t_ld_siswa SET nama = '$nama', tgl_lhr = '$t_lahir', tgl_lhr = '$tgl_lhr', n_ortu = '$n_ortu', nis = '$nis', nisn = '$nisn', no_pes = '$no_pes', foto = '$nama_foto_baru' WHERE nisn = '$kd' ");
					
					mysqli_query($conn, "INSERT INTO t_history VALUES('', 'edit data $nama', '$_SESSION[user]', NULL) ");
					?>
					<script type="text/javascript"> alert("Data sudah di edit"); window.location.href="?page=<?= base64_encode("d_siswa"); ?>"; </script>

					<?php
				}else{
					?>
					<script type="text/javascript"> 
						alert("Foto Gagal di upload"); 
						window.location.href="?page=<?= base64_encode("d_siswa"); ?>&action=<?= base64_encode("edit"); ?>&nisn=<?= base64_encode($data['nisn']); ?>";
					</script>

					<?php
				}
			}	
		}
	}


	?>


</fieldset>