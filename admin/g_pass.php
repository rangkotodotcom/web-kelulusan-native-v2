<?php

$kd = base64_decode(@$_GET['user']);
$sql = mysqli_query($conn, "SELECT * FROM t_luser WHERE user = '$kd' ");
$data = mysqli_fetch_assoc($sql);

 ?>
<fieldset>
	
	<div style="width: 50%; margin-top: 80px;" class="panel panel-default">
		<div class="panel-heading">
			<h4>Ganti Password</h4>
		</div>
		<div class="panel-body">
			<form action="" method="post">
				<div class="form-group">
					<label for="paslam">Password Lama</label>
					<input type="password" name="passlam" id="paslam" class="form-control" required>
				</div>
				<div class="form-group">
					<label for="pasbar">Password Baru</label>
					<input type="password" name="pass" id="pasbar" class="form-control" required>
				</div>
				<button name="ganti" class="btn btn-success btn-md"><span class="glyphicon glyphicon-saved"></span> Ganti</button>
				<button type="reset" class="btn btn-danger btn-md"><span class="glyphicon glyphicon-repeat"></span> Reset</button>
				<a href="beranda.php" class="btn btn-warning btn-md"><span class="glyphicon glyphicon-remove"></span> Batal</a>

				
			</form>
		</div>
		<div class="panel-footer">
			Jangan Terlalu Lama Berpikir
		</div>
	</div>

	<?php

	$passlam = @$_POST['passlam'];
	$pass = @$_POST['pass'];

	if(isset($_POST['ganti'])){
		if($passlam == $data['pass']){
			if(strlen($pass) > 15 || strlen($pass) < 8 ){
				echo "
						<script>
							alert('Password Minimal 8 karakter dan Maksimal 15 karakter');
							window.location.href='?page=".base64_encode("g_pass")."&user=".base64_encode($_SESSION['user'])."';
						</script>
					 ";
			}else{
				$edit = mysqli_query($conn, "UPDATE t_luser SET pass = '$pass' WHERE user = '$kd' " );

				if($edit){
					echo "
							<script>
								alert('Password Sudah Di Ganti');
								window.location.href = 'logout.php';
							</script>
						 ";
				}else{
					echo "
							<script>
								alert('Gagal Mengganti Password');
								window.location.href='?page=".base64_encode("g_pass")."&user=".base64_encode($_SESSION['user'])."';
							</script>
						 ";
				}
			}
		}else{
			echo "
				<script>
					alert('Password Lama Anda Salah');
					window.location.href='?page=".base64_encode("g_pass")."&user=".base64_encode($_SESSION['user'])."';
				</script>
			 ";
		}
	}

	 ?>
</fieldset>