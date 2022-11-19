<?php

if(isset($_POST['ok'])){
	$drop = @$_POST['drop'];

	if($drop == 'siswa'){
		$files = glob('img/siswa/*');
		foreach ($files as $file) {
			if(is_file($file))
				unlink($file);
		}
		echo "<script>
			alert('Directory Siswa sudah kosong');
			window.location.href='?page=".base64_encode("kosong")."';
		</script>";

	}else if($drop == 'adm'){
		$files = glob('img/adm/*');
		foreach ($files as $file) {
			if(is_file($file))
				unlink($file);
		}
		echo "<script>
			alert('Directory Adm sudah kosong');
			window.location.href='?page=".base64_encode("kosong")."';
		</script>";
	}else if($drop == ''){
		echo "<script>
			alert('Tidak Ada Directory yang Dikosongkan');
			window.location.href='?page=".base64_encode("kosong")."';
		</script>";
	}
}


 ?>

<fieldset>
	<legend>Kosongkan Directory Img</legend>
	<form action="" method="post">
		<div class="form-group">
			<div class="checkbox">
                <label>
                    <input type="checkbox" name="drop" value="siswa"><b>Kosongkan Directory Siswa</b>
                </label>
            </div> 
		</div>
		<div class="form-group">
			<div class="checkbox">
                <label>
                    <input type="checkbox" name="drop" value="adm"><b>Kosongkan Directory Adm</b>
                </label>
            </div>
		</div>
		<button onclick="return confirm('Yakin Drop Directory?')" name="ok" class="btn btn-success">
		<span class="glyphicon glyphicon-trash"></span> OK
		</button>
		<a href="beranda.php" class="btn btn-warning btn-sm"><span class="glyphicon glyphicon-remove"></span> Batal </a>
	</form>
</fieldset>