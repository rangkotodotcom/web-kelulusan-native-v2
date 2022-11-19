<?php

$kd = base64_decode(@$_GET['user']);
$sql = mysqli_query($conn, "SELECT * FROM t_luser WHERE user = '$kd' ");
$data = mysqli_fetch_assoc($sql);

$kode = $data['nama'];

 ?>

 <fieldset>
 	<legend>Upload Berkas</legend>
 	<style>
 		form input[type=text]{
 			width: 300px;
 			height: 25px;
 		}
 		form select{
 			width: 304px;
 			height: 25px;
 		}
 		form input[type=submit]{
 			width: 100px;
 			height: 25px;
 			cursor: pointer;
 		}

 	</style>

 	<form action="" method="post" enctype="multipart/form-data">
 		<div class="form-group">
 		<input type="text" name="nama" class="form-control" value="<?= $data['nama'] ?>" readonly />
 		</div>
 		<div class="form-group">
 		<select name="jenis" required class="form-group">
 			<option value="">Pilih Jenis File</option>
 			<option value="Komite">Kartu Registrasi Adm</option>
 			<option value="Pustaka">Kartu Bebas Pustaka</option>
 		</select>
 		</div>
 		<div class="form-group" style="width: 35%;">
 		<input type="file" class="form-control" name="bukti" required />
 		</div>

 		<?php 

 		$ck = mysqli_fetch_assoc(mysqli_query($conn, " SELECT * FROM t_adm WHERE nama = '$kode' " ));

 		if($ck['pustaka'] == ''){

 		?>

 		<button name="upload" class="btn btn-success btn-md">
 			<span class="glyphicon glyphicon-upload"></span> Upload
 		</button>
 		<a href="beranda.php" class="btn btn-warning btn-md">
 			<span class="glyphicon glyphicon-remove"></span> Batal
 		</a>

 		<?php }else{ ?>

		
 		<a href="beranda.php" class="btn btn-warning btn-md">
 			<span class="glyphicon glyphicon-remove"></span> Batal
 		</a>

 		<?php } ?>

 		<br><br>
 		<p>Hati-hati dalam mengupload, Karena File yang sudah di Upload Tidak Bisa di Ubah.</p>
 		<p>File berekstensi jpg atau png dan berukuran 3x4 atau ukuran maksimal 100kb.</p>
 		<i>Upload File Secara Berurutan.</i>
 	</form><br><br>

 	<div class="bukti">
 	<div class="table-responsive">
 	<table width="100%" class="table table-bordered">
 		<thead>
			<tr class="info">
				<th>Nama</th>
				<th>Kartu Registrasi Adm</th>
				<th>Kartu Bebas Pustaka</th>
							
			</tr>
		</thead>	

		<?php

		$tb = mysqli_query($conn, "SELECT * FROM t_adm WHERE nama = '$kode' " );

		$cek = mysqli_num_rows($tb);

		if($cek < 1 ){
			?>
				<tr>
					<td colspan="4" align="center" style="padding: 10px;">Data tidak di temukan</td>
				</tr>
			<?php
		}else{
			$data = mysqli_fetch_assoc($tb)

			?>

		<tbody>
			<tr class="warning">
				<td align="center"><?= $data['nama']; ?></td>
				<td align="center">
					<img src="img/adm/<?= $data['komite']; ?>" width="80px" alt="bukti iuran komite" />
				</td>
				<td align="center">
					<img src="img/adm/<?= $data['pustaka']; ?>" width="80px" alt="bukti bebas pustaka" />
				</td>
			</tr>
		</tbody>	

			<?php
			}
		 ?>

	</table>	
	</div>
	</div>

 	<?php

 	$nama = @$_POST['nama'];
	$jenis = @$_POST['jenis'];
	$valid_ext = array('jpg','jpeg','png');

	$file_name = @$_FILES['bukti']['name'];
	$tmp_name = @$_FILES['bukti']['tmp_name'];
	$size = @$_FILES['bukti']['size'];
	
 	$pecah = explode('.', $file_name);
 	$ujung = end($pecah);
 	$ext = strtolower($ujung);
 	$nama_file = $nama . '-' . $jenis . '.' . $ext;

 	if(isset($_POST['upload'])){

 		if($size < 100000){

 			if(in_array($ext, $valid_ext)){
 				$upload = move_uploaded_file($tmp_name, "img/adm/".$nama_file);	

		 		if($upload){
		 			if($jenis == 'Komite' ){

		 				if($cek < 1 ){
		 					mysqli_query($conn, "INSERT INTO t_adm VALUES('$nama', '$nama_file', '' ) ");
		 				}else{
		 					echo "<script>
									alert('File Sudah Ada');
									window.location.href='?page=".base64_encode("adm")."&user=".base64_encode($_SESSION['user'])."';
								</script>
								";
		 				}
		 			}else{
		 				mysqli_query($conn, "UPDATE t_adm SET pustaka = '$nama_file' WHERE nama = '$nama' " );
		 				$_SESSION['aktif'] = time();
		 			}

		 			echo "<script>
							alert('File Sudah Di Upload');
							document.location.href = '?page=".base64_encode("adm")."&user=".base64_encode($_SESSION['user'])."';
						</script>
						";
		 		}else{
		 			echo "<script>
							alert('File Gagal Di Upload');
							window.location.href='?page=".base64_encode("adm")."&user=".base64_encode($_SESSION['user'])."';
						</script>
						";
		 		}
		 	}else{
		 		echo "<script>
						alert('Ekstensi File tidak Di izinkan');
						window.location.href='?page=".base64_encode("adm")."&user=".base64_encode($_SESSION['user'])."';
					</script>
					";
		 	}
 		}else{
 			echo "<script>
					alert('Ukuran File Terlalu Besar');
					window.location.href='?page=".base64_encode("adm")."&user=".base64_encode($_SESSION['user'])."';
				</script>
					";
 		}

	 		
 	}
 	
 	if(isset($_SESSION['aktif'])){
 		if($_SESSION['aktif'] + 30 * 60 < time()){
 			mysqli_query($conn, "UPDATE t_luser SET status = 'aktif' WHERE user = '$kd' ");
 		}
 	}


 	 ?>

 </fieldset>