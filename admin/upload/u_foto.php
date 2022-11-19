<fieldset>
	<legend>Upload Foto Siswa</legend>

	<form action="" method="post" enctype="multipart/form-data">
		<p>Maksimal 20 foto sekaligus</p>
		<div class="form-group" style="width: 50%;">
			<input type="file" name="foto[]" multiple class="form-control" required>
		</div>
		<button name="upload" class="btn btn-success btn-md">
			<span class="glyphicon glyphicon-saved"></span> Upload
		</button>
		<a href="?page=<?= base64_encode("d_siswa"); ?>" class="btn btn-warning btn-md">
			<span class="glyphicon glyphicon-remove"></span> Batal
		</a>

	</form>

<?php 

	if (isset($_POST["upload"])) {

		$jumlah = count($_FILES['foto']['name']);

		if ($jumlah > 0) {
			for ($i=0; $i < $jumlah; $i++) { 
				$valid_ext = array('jpg','jpeg','png');

				$file_name = $_FILES['foto']['name'][$i];
				$tmp_name = $_FILES['foto']['tmp_name'][$i];

				$pecah = explode('.', $file_name);
 				$ujung = end($pecah);
 				$ext = strtolower($ujung);

				if(in_array($ext, $valid_ext)){				
					$upload = move_uploaded_file($tmp_name, "img/siswa/".$file_name);

					if($upload){
						echo "
							<script>
								alert('Foto Berhasil Di Upload');
								document.location.href = '?page=".base64_encode("d_siswa")."';
							</script>
							 ";
						}else{
								echo "
									<script>
										alert('Foto Gagal Di Upload');
										document.location.href = '?page=".base64_encode("d_siswa")."&action=".base64_encode("u_foto")."';
									</script>
									 ";
						}
				}else{
					echo "
						<script>
							alert('Ada ekstensi File yang tidak Diizinkan');
							document.location.href = '?page=".base64_encode("d_siswa")."&action=".base64_encode("u_foto")."';
						</script>
						 ";
				}
			}
			
		}	
	}
?>

</fieldset>