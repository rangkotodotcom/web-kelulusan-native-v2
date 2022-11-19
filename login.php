<?php

session_start();

include 'conn.php';
include 'functions.php';

if (isset($_SESSION['user'])) {
	echo "<script>window.location='beranda.php'</script>";
}

$_SESSION['n1'] = rand(1, 9);
$_SESSION['n2'] = rand(1, 9);
$_SESSION['n3'] = rand(1, 9);
$_SESSION['hasil'] = $_SESSION['n1'] + $_SESSION['n2'];
$_SESSION['hasil2'] = $_SESSION['n2'] + $_SESSION['n1'];

$akses = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM t_izin_login "));

$time = date("M j, Y H:i:s", strtotime($akses['waktu_mundur']));

?>

<!DOCTYPE html>
<html>

<head>
	<title>Login | Pengumuman Kelulusan SMAN 1 2x11 Enam Lingkung</title>
	<link rel="icon" type="img/jpg" href="img/tetap/icon.jpg">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/dscountdown.css" media="all">
	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/dscountdown.min.js"></script>
	<script>
		jQuery(document).ready(function($) {

			$('.buka').dsCountDown({
				endDate: new Date("<?= $data['waktu_mundur']; ?>"),
				theme: 'black'
			});

		});
	</script>
	<style type="text/css">
		.panel {
			box-shadow: 7px 7px 10px 8px rgba(90, 170, 90, .75);
		}
	</style>


</head>

<body style="background-image: url(img/tetap/back.png);">
	<div style="width: 450px; padding-top: 12%;" class="container">
		<center>
			<div class="panel panel-info">
				<div class="panel-heading">
					<h4 style="font-size: 20px;"><b>
							<marquee><?= tanggal(date('D, j F Y')); ?></marquee>
						</b></h4>
				</div>
				<div class="panel-body" style="height: 240px;">
					<div style="line-height: 170px;">
						<button class="btn btn-success btn-lg" data-toggle="modal" data-target="#admin">
							<span class="glyphicon glyphicon-user"></span> Admin
						</button> &nbsp; &nbsp;
						<?php

						if ($akses['akses'] == 'buka') {

						?>

							<button class="btn btn-warning btn-lg" data-toggle="modal" data-target="#siswa">
								<span class="glyphicon glyphicon-user"></span> Siswa
							</button>

						<?php } else { ?>

							<button class="btn btn-warning btn-lg" data-toggle="modal" data-target="#kunci">
								<span class="glyphicon glyphicon-user"></span> Siswa
							</button>

						<?php } ?>

					</div>
					<button class="btn btn-default btn-md" data-toggle="modal" data-target="#lupa"> Lupa Password</button>
				</div>
				<div class="panel-footer">
					&copy 2018 <i>Kali</i>
				</div>
			</div>
		</center>
	</div>

	<!-- modal admin -->
	<div id="admin" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title" align="center"><b>Halaman Login Admin</b></h4>
				</div>
				<div class="modal-body" style="height: 250px;">
					<form action="" method="post">
						<div class="input-group" style="margin: 15px 0;">
							<span class="input-group-addon">
								<i class="glyphicon glyphicon-user"></i>
							</span>
							<input type="text" name="user" class="form-control" placeholder="Username" required autocomplete="off">
						</div>
						<div class="input-group" style="margin: 15px 0;">
							<span class="input-group-addon">
								<i class="glyphicon glyphicon-lock"></i>
							</span>
							<input type="password" name="pass" class="form-control" placeholder="Password">
						</div>
						<div class="input-group" style="margin: 15px 0;">
							<span class="input-group-addon">
								<b>Berapa Hasil Dari <?= $_SESSION['n1'] ?> + <?= $_SESSION['n2'] ?></b>
							</span>
							<input type="text" name="cap" class="form-control" autocomplete="off" placeholder="Hasil">
							<input type="hidden" name="cap2" value="<?= $_SESSION['hasil'] ?>">
						</div>
						<button name="login" class="btn btn-primary">
							<span class="glyphicon glyphicon-log-in"></span> Login
						</button>
						<button type="reset" class="btn btn-warning">
							<span class="glyphicon glyphicon-repeat"></span> Reset
						</button>
					</form>

					<?php

					if (isset($_POST['login'])) {
						$user = $_POST['user'];
						$pass = $_POST['pass'];
						$cap = $_POST['cap'];
						$cap2 = $_POST['cap2'];

						$data_user = mysqli_query($conn, "SELECT * FROM t_luser WHERE user = '$user' ");
						$r = mysqli_fetch_assoc($data_user);
						$nama = $r['nama'];
						$username = $r['user'];
						$password = $r['pass'];
						$status = $r['status'];
						$level = $r['level'];

						$cek = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM t_online WHERE user = '$user' "));
						$cek_user = $cek['user'];

						if ($user == $cek_user) {
							echo "
								<script>
								alert('User Tersebut Sudah Login');
								window.location.href='index.php';
								</script>
							";
						} else {

							if ($user == $username) {
								if (password_verify($pass, $password)) {
									if ($cap == $cap2) {
										if ($status == 'aktif') {

											$_SESSION['nama'] = $nama;
											$_SESSION['user'] = $username;
											$_SESSION['level'] = $level;

											if ($user != 'admin') {

												mysqli_query($conn, "INSERT INTO t_online VALUES('$_SESSION[nama]', '$_SESSION[user]', '$_SESSION[level]', 'ONLINE', NULL) ");
											}

											echo "
												<script>
												alert('Login Sukses');
												document.location.href = 'beranda.php';
												</script>
											";
										} else {
											echo "
													<script>
													alert('User Anda Belum Aktif. Tunggu Beberapa Menit!');
													window.location.href='index.php';
													</script>
												";
										}
									} else {
										echo "
											<script>
											alert('Jawaban Anda Salah');
											window.location.href='index.php';
											</script>
										";
									}
								} else {
									echo "
										<script>
										alert('Password anda salah');
										window.location.href='index.php';
										</script>
									";
								}
							} else {
								echo "
									<script>
									alert('Username anda salah');
									window.location.href='index.php';
									</script>
								";
							}
						}
					}

					?>

				</div>
				<div class="modal-footer">
					<button class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
				</div>
			</div>
		</div>
	</div>
	<!-- /.modal admin -->

	<!-- modal siswa -->
	<div id="siswa" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title" align="center"><b>Halaman Login Siswa</b></h4>
				</div>
				<div class="modal-body" style="height: 250px;">
					<form action="" method="post">
						<div class="input-group" style="margin: 15px 0;">
							<span class="input-group-addon">
								<i class="glyphicon glyphicon-user"></i>
							</span>
							<input type="text" name="user" class="form-control" placeholder="12-004-xxx-x" required autocomplete="off">
						</div>
						<div class="input-group" style="margin: 15px 0;">
							<span class="input-group-addon">
								<i class="glyphicon glyphicon-lock"></i>
							</span>
							<input type="password" name="pass" class="form-control" placeholder="Password" required>
						</div>
						<div class="input-group" style="margin: 15px 0;">
							<span class="input-group-addon">
								<b>Berapa Hasil Dari <?= $_SESSION['n2'] ?> + <?= $_SESSION['n1'] ?></b>
							</span>
							<input type="text" name="cap" class="form-control" autocomplete="off" placeholder="Hasil">
							<input type="hidden" name="cap2" value="<?= $_SESSION['hasil2'] ?>">
						</div>
						<button name="login_s" class="btn btn-primary">
							<span class="glyphicon glyphicon-log-in"></span> Login
						</button>
						<button type="reset" class="btn btn-warning">
							<span class="glyphicon glyphicon-repeat"></span> Reset
						</button>
					</form>

					<?php

					if (isset($_POST['login_s'])) {
						$user = $_POST['user'];
						$pass = $_POST['pass'];
						$cap = $_POST['cap'];
						$cap2 = $_POST['cap2'];

						$data_user = mysqli_query($conn, "SELECT * FROM t_luser WHERE user = '$user' AND pass = '$pass' ");
						$r = mysqli_fetch_assoc($data_user);
						$nama = $r['nama'];
						$username = $r['user'];
						$password = $r['pass'];
						$level = $r['level'];

						$online = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM t_online WHERE level = 'siswa' "));

						$cek = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM t_online WHERE user = '$user' "));
						$cek_user = $cek['user'];

						if ($user == $cek_user) {
							echo "
								<script>
								alert('User Tersebut Sudah Login');
								window.location.href='index.php';
								</script>
							";
						} else {

							if ($user == $username && $pass == $password) {
								if ($cap == $cap2) {
									if ($online <= 75) {

										$_SESSION['nama'] = $nama;
										$_SESSION['user'] = $username;
										$_SESSION['level'] = $level;

										mysqli_query($conn, "INSERT INTO t_online VALUES('$_SESSION[nama]', '$_SESSION[user]', '$_SESSION[level]', 'ONLINE', NULL) ");

										echo "
										<script>
										alert('Login Sukses');
										document.location.href = 'beranda.php';
										</script>
									";
									} else {
										echo "
											<script>
											alert('Harap Bersabar. Server Lagi Penuh');
											window.location.href='index.php';
											</script>
										";
									}
								} else {
									echo "
										<script>
										alert('Jawaban Anda Salah');
										window.location.href='index.php';
										</script>
									";
								}
							} else {
								echo "
									<script>
									alert('Username / password anda salah');
									window.location.href='index.php';
									</script>
								";
							}
						}
					}

					?>

				</div>
				<div class="modal-footer">
					<button class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
				</div>
			</div>
		</div>
	</div>
	<!-- /.modal siswa -->

	<!-- modal kunci -->
	<div id="kunci" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title" align="center"><b>Halaman Login Siswa</b></h4>
				</div>
				<div class="modal-body" style="height: 250px;">
					<!-- <p style="font-size: 30px;" align="center">
						Sabar Dulu Ya!!!<br>
						Akses Login Siswa Sementara Di Tutup<br>
						Akan Dibuka Kembali Setelah Pesan-pesan Berikut ini!!<br>
						Pantengin Terus Web Kita Ya!!
					</p> -->
					<table width="100%" align="center">
						<tr>
							<td colspan="2" align="center">
								<h1>Login Dibuka Dalam Waktu</h1>
							</td>
						</tr>
						<tr>
							<td>
								<div class="buka"></div>
							</td>
							<td>
								<img src="img/tetap/doraemon.gif" width="120px" align="right">
							</td>
						</tr>
					</table>
				</div>
				<div class="modal-footer">
					<button class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Tutup</button>
				</div>
			</div>
		</div>
	</div>
	<!-- /.modal kunci -->

	<!--  modal lupa -->
	<div id="lupa" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title" align="center"><b>Lupa Password</b></h4>
				</div>
				<div class="modal-body" style="height: 200px;">
					<div class="col-md-6 col-sm-12 col-xs-12">
						<p style="font-size: 25px;">Bagi Siswa yang lupa password Silahkan Hubungi <img src="img/tetap/wa.png"> 082285861876</p>
					</div>
					<div class="col-md-6 col-sm-12 col-xs-12">
						<p style="font-size: 25px; text-align: right;">Bagi Admin yang lupa password Silahkan Hubungi <img src="img/tetap/wa.png"> 082285861876</p>
					</div>
				</div>
				<div class="modal-footer">
					<button class="btn btn-danger btn-md" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Tutup</button>
				</div>
			</div>
		</div>
	</div>
	<!-- /.modal lupa -->


</body>

</html>