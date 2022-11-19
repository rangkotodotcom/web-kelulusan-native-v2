<?php

if(isset($_POST['ok'])){
	$drop = @$_POST['drop'];

	if($drop == ''){
		echo "<script>
				alert('Tidak Ada yang dikosongkan');
				window.location.href='?page=".base64_encode("db")."';
			</script>";
	}else if($drop == 't_adm'){
		$truncate = "TRUNCATE TABLE t_adm";
		mysqli_query($conn, $truncate);

		echo "<script>
				alert('Tabel Adm Sudah Kosong');
				window.location.href='?page=".base64_encode("db")."';
			</script>";

	}else if($drop == 't_ld_siswa'){
		$truncate = "TRUNCATE TABLE t_ld_siswa";
		mysqli_query($conn, $truncate);

		echo "<script>
				alert('Tabel Data Siswa Sudah Kosong');
				window.location.href='?page=".base64_encode("db")."';
			</script>";

	}else if($drop == 't_linfo'){
		$truncate = "TRUNCATE TABLE t_linfo";
		mysqli_query($conn, $truncate);

		echo "<script>
				alert('Tabel Info Sudah Kosong');
				window.location.href='?page=".base64_encode("db")."';
			</script>";

	}else if($drop == 't_linfo_a'){
		$truncate = "TRUNCATE TABLE t_linfo_a";
		mysqli_query($conn, $truncate);

		echo "<script>
				alert('Tabel Info_a Sudah Kosong');
				window.location.href='?page=".base64_encode("db")."';
			</script>";

	}else if($drop == 't_ln_siswa'){
		$truncate = "TRUNCATE TABLE t_ln_siswa";
		mysqli_query($conn, $truncate);

		echo "<script>
				alert('Tabel Nilai Sudah Kosong');
				window.location.href='?page=".base64_encode("db")."';
			</script>";

	}else if($drop == 't_luser'){
		$truncate = "DELETE FROM t_luser WHERE level = 'siswa' ";
		mysqli_query($conn, $truncate);

		echo "<script>
				alert('Tabel User Sudah Kosong');
				window.location.href='?page=".base64_encode("db")."';
			</script>";

	}else if($drop == 't_saran'){
		$truncate = "TRUNCATE TABLE t_saran";
		mysqli_query($conn, $truncate);

		echo "<script>
				alert('Tabel Saran Sudah Kosong');
				window.location.href='?page=".base64_encode("db")."';
			</script>";
	}
}

 ?>

<fieldset>
	<legend>Kosongkan Database</legend>
	<form action="" method="post" style="width: 30%; text-align: justify;">
		<div class="form-group">
			<div class="checkbox">
                <label>
                    <input type="checkbox" name="drop" value="t_adm"><b>Kosongkan Tabel Adm</b>
                </label>
            </div> 
		</div>
		<div class="form-group">
			<div class="checkbox">
                <label>
                    <input type="checkbox" name="drop" value="t_ld_siswa"><b>Kosongkan Tabel Data Siswa</b>
                </label>
            </div>
		</div>
		<div class="form-group">
			<div class="checkbox">
                <label>
                    <input type="checkbox" name="drop" value="t_linfo"><b>Kosongkan Tabel Info</b>
                </label>
            </div>
		</div>
		<div class="form-group">
			<div class="checkbox">
                <label>
                    <input type="checkbox" name="drop" value="t_linfo_a"><b>Kosongkan Tabel Info Admin</b>
                </label>
            </div>
		</div>
		<div class="form-group">
			<div class="checkbox">
                <label>
                    <input type="checkbox" name="drop" value="t_ln_siswa"><b>Kosongkan Tabel Nilai Siswa</b>
                </label>
            </div>
		</div>
		<div class="form-group">
			<div class="checkbox">
                <label>
                    <input type="checkbox" name="drop" value="t_luser"><b>Kosongkan Tabel User Siswa</b>
                </label>
            </div>
		</div>
		<div class="form-group">
			<div class="checkbox">
                <label>
                    <input type="checkbox" name="drop" value="t_saran"><b>Kosongkan Tabel Saran</b>
                </label>
            </div>
		</div>
		<button onclick="return confirm('Yakin Drop Database?')" name="ok" class="btn btn-success">
		<span class="glyphicon glyphicon-trash"></span> OK
		</button>
		<a href="beranda.php" class="btn btn-warning btn-sm"><span class="glyphicon glyphicon-remove"></span> Batal </a>
	</form>
</fieldset>