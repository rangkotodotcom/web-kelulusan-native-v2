<?php 

session_start();

include '../conn.php';

if(!isset($_SESSION['user'])){
	echo"
			<script>
				alert('Anda Belum Login. Silahkan Login Dahulu!!!');
				document.location.href = '../index.php';
			</script>
		";
}else{

$kd = base64_decode(@$_GET['user']);
$sql = mysqli_query($conn, "SELECT * FROM t_luser WHERE user = '$kd' ");
$data = mysqli_fetch_assoc($sql);

	if($data['ganti'] == 'belum'){

 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Pengumuman Kelulusan SMAN 1 2x11 Enam Lingkung</title>
	<link rel="icon" type="img/png" href="../img/tetap/icon.jpg">
	<link href="../css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-image: url(../img/tetap/back.png);">
	<div style="width: 400px; padding-top: 10%;" class="container">
		<center>
			<div class="panel panel-info">
				<div class="panel-heading">
					<h4>Ganti Password Dahulu</h4>
				</div>
				<div class="panel-body">
					<form action="" method="post">
						<div class="form-group">
							<label for="paslam">Password Lama</label>
							<input type="password" name="passlam" id="paslam" class="form-control" >
						</div>
						<div class="form-group">
							<label for="pasbar">Password Baru</label>
							<input type="password" name="pass" id="pasbar" class="form-control" required >
						</div>
						<button name="ganti" class="btn btn-success btn-md"><span class="glyphicon glyphicon-saved"></span> Ganti</button>
						<button type="reset" class="btn btn-danger btn-md"><span class="glyphicon glyphicon-repeat"></span> Reset</button>
						<a href="../logout.php" class="btn btn-warning btn-md"><span class="glyphicon glyphicon-remove"></span> Batal</a>
					</form>
				</div>
				<div class="panel-footer">
					Jangan Terlalu Lama Berpikir
				</div>
			</div>
		</center>
	</div>


	<?php

	$passlam = @$_POST['passlam'];
	$pass = @$_POST['pass'];

	if(isset($_POST['ganti'])){
		if(password_verify($passlam, $data['pass'])){
			if(strlen($pass) > 15 || strlen($pass) < 8 ){
				echo "
						<script>
							alert('Password Minimal 8 karakter dan Maksimal 15 karakter');
							window.location.href='ganti_pass_admin.php?user=".base64_encode($_SESSION['user'])."';
						</script>
					 ";
			}else{

				$password = password_hash($pass , PASSWORD_DEFAULT);

				$edit = mysqli_query($conn, "UPDATE t_luser SET pass = '$password', ganti = 'sudah' WHERE user = '$kd' " );

				if($edit){
					echo "
							<script>
								alert('Berhasil Mengganti Password');
								window.location.href = '../beranda.php';
							</script>
						 ";
				}else{
					echo "
							<script>
								alert('Gagal Mengganti Password');
								window.location.href='ganti_pass_admin.php?user=".base64_encode($_SESSION['user'])."';
							</script>
						 ";
				}
			}
		}else{
			echo "
				<script>
					alert('Password Lama Anda Salah');
					window.location.href='ganti_pass_admin.php?user=".base64_encode($_SESSION['user'])."';
				</script>
			 ";
		}
	}

	 ?>
</body>
</html>

	<?php }else{
		echo "<script>
				window.location.href = '../beranda.php';
			</script>";
	}

} ?>