<?php

session_start();

include 'conn.php';
include 'functions.php';

if(isset($_SESSION["lastActivity"])){
	if($_SESSION['lastActivity'] + 10 * 60 < time()){
		
		echo "
				<script>
					alert('Sesi anda sudah Habis. Silahkan login Kembali!');
					document.location.href = 'logout.php';
				</script>
			 ";
	}
}

$_SESSION["lastActivity"] = time();


if(!isset($_SESSION['user'])){
	echo"
			<script>
				alert('Anda Belum Login. Silahkan Login Dahulu!!!');
				document.location.href = 'index.php';
			</script>
		";
}

$kd = @$_SESSION['user'];
$sql = mysqli_query($conn, "SELECT * FROM t_ld_siswa WHERE no_pes = '$kd' " );
$data = mysqli_fetch_assoc($sql);

$cek_g_pass = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM t_luser WHERE user = '$kd' " ));

if($cek_g_pass['ganti'] != 'sudah'){
	if($_SESSION['level'] == 'siswa'){
		echo "<script>window.location.href= 'password/siswa.php?user=".base64_encode($_SESSION['user'])."'</script>";
	}else{
		echo "<script>window.location.href= 'password/admin.php?user=".base64_encode($_SESSION['user'])."'</script>";
	}
}

$logged = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM t_online "));

$pesan_baru = mysqli_num_rows(mysqli_query($conn, "SELECT DISTINCT pengirim FROM t_pesan WHERE penerima = '$_SESSION[nama]' AND baca = 'belum' "));

?>



<!DOCTYPE html>
<html>
<head>
	<title><?= $_SESSION['nama'] ?> | Pengumuman Kelulusan SMAN 1 2x11 Enam Lingkung</title>
	<link rel="icon" type="img/jpg" href="img/tetap/icon.jpg">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/beranda.css">
	<script src="js/jquery.js"></script>
	<script src="js/jquery-3.3.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/ckeditor/ckeditor.js"></script>
	<script src="js/ckeditor/build-config.js"></script>
	<script src="js/ckeditor/config.js"></script>
	<script src="js/ckeditor/contents.js"></script>
	<script src="js/ckeditor/styles.js"></script>
</head>
<body style="background-image: url(img/tetap/back.png);">
	<div style="padding: 20px 0;" class="container">
		<center>
			<div class="header">
				<h4><marquee>Portal Pengumuman Kelulusan SMAN 1 2x11 Enam Lingkung</marquee></h4>
			</div>
			<div class="content cf">
					<div class="sidebar">
						<div class="profil">
							<?php

							$level = $_SESSION['level'] == 'admin';
							if($level){
								
								if($_SESSION['nama'] == 'Jamilur Rusydi Al Miichtari'){

									?>

									<img src="img/tetap/myfoto.jpg" alt="Foto Belum Ada" width="100px" /><br>

								<?php }else{ ?>

									<img src="img/tetap/profil.jpg" alt="Foto Belum Ada" width="100px" /><br>

								<?php }  ?>
							
							<?php }else{ ?>

							<img src="img/siswa/<?= $data['foto']; ?>" alt="Foto Belum Ada" width="100px" height="109px" /><br>

							<?php } ?>

							<a href="logout.php">
								<button class="btn btn-warning btn-xs" style="margin-bottom: 5px;">Loguot 
									<span class="glyphicon glyphicon-log-out"></span>
								</button>
							</a>
						</div>
						<div class="menu">
							<a href="beranda.php">Beranda</a><br>

							<?php 

							$level = $_SESSION['level'] == 'siswa';
							if($level){
							
							?>

							<a href="?page=<?= base64_encode("hasil"); ?>&user=<?= base64_encode($_SESSION['user']);?>">Hasil
							</a><br>
							<a href="?page=<?= base64_encode("diri"); ?>&user=<?= base64_encode($_SESSION['user']);?>">Data Diri
							</a><br>
							<a href="?page=<?= base64_encode("un"); ?>&user=<?= base64_encode($_SESSION['user']);?>">Nilai UN
							</a><br>
							<a href="?page=<?= base64_encode("adm"); ?>&user=<?= base64_encode($_SESSION['user']);?>">Administrasi
							</a><br>
							<a href="?page=<?= base64_encode("pesan_s"); ?>&user=<?= base64_encode($_SESSION['user']);?>">
									Pesan (<?= $pesan_baru ?>)
							</a><br>
							<a href="?page=<?= base64_encode("saran"); ?>&user=<?= base64_encode($_SESSION['user']);?>">Kritik dan Saran
							</a><br>

							<?php }else{ ?>

							<a href="?page=<?= base64_encode("d_siswa"); ?>">Data Siswa</a><br>
							<a href="?page=<?= base64_encode("d_nilai"); ?>">Data Nilai</a><br>
							<a href="?page=<?= base64_encode("nilai_r"); ?>">Nilai Rapor</a><br>
							<a href="?page=<?= base64_encode("nilai_us"); ?>">Nilai USBN</a><br>
							<a href="?page=<?= base64_encode("cetak"); ?>">Cetak SKL</a><br>
							<a href="?page=<?= base64_encode("d_user"); ?>">Data User</a><br>
							<a href="?page=<?= base64_encode("u_on"); ?>">User Online</a><br>
							<a href="?page=<?= base64_encode("info"); ?>">Info Siswa</a><br>
							<a href="?page=<?= base64_encode("b_adm"); ?>">Bukti Adm</a><br>
							<a href="?page=<?= base64_encode("pesan"); ?>">
									Pesan (<?= $pesan_baru ?>)
							</a><br>
							<a href="?page=<?= base64_encode("k_saran"); ?>">Kotak Saran</a><br>

							<?php }

							if($_SESSION['nama'] == 'Admin'){
								
							?>

							<a href="?page=<?= base64_encode("d_admin"); ?>">Data Admin</a><br>
							<a href="?page=<?= base64_encode("a_on"); ?>">Admin Online</a><br>
							<a href="?page=<?= base64_encode("info_a"); ?>">Info Admin</a><br>
							<a href="?page=<?= base64_encode("history"); ?>">History</a><br>
							<a href="?page=<?= base64_encode("db"); ?>">Database</a><br>
							<a href="?page=<?= base64_encode("kosong"); ?>">Directory</a><br>
							<a href="?page=<?= base64_encode("akses"); ?>">Akses Login</a>

							<?php } ?>

							<a href="?page=<?= base64_encode("cp"); ?>">Contact Person</a><br>
							<?php 

							$level = $_SESSION['level'] == 'siswa';
							if($level){

							?>
							
							<a href="?page=<?= base64_encode("g_pass"); ?>&user=<?= base64_encode($_SESSION['user']);?>">Ganti Password
							</a><br>

							<?php }else{ ?>

							<a href="?page=<?= base64_encode("g_pass_admin"); ?>&user=<?=base64_encode($_SESSION['user']);?>">Ganti Password
							</a><br>

							<?php } ?>
							
						</div>
					</div>
					<div class="main">

						<?php

						$page = base64_decode(@$_GET['page']);
						$action = base64_decode(@$_GET['action']);
						$level = $_SESSION['level'] == 'siswa';
						$nama = $_SESSION['nama'] == 'Admin';

						if($level){
							if($page == ''){
								include 'admin/info/i_siswa.php';
							}else if($page == 'hasil'){
								include 'siswa/hasil.php';
							}else if($page == 'diri'){
								include 'siswa/d_diri.php';
							}else if($page == 'un'){
								include 'siswa/d_nilai.php';
							}else if($page == 'g_pass'){
								include 'admin/g_pass.php';
							}else if($page == 'saran'){
								include 'siswa/saran.php';
							}else if($page == 'adm'){
								include 'siswa/adm.php';
							}else if($page == 'cp'){
								include 'admin/c_p.php';
							}else if($page == 'pesan_s'){
								if($action == ""){
									include 'siswa/pesan_s.php';
								}else if($action == "b_pesan_s"){
									include 'siswa/b_pesan_s.php';
								}else if($action == "h_pesan_s"){
									include 'siswa/h_pesan_s.php';
								}else if($action == "l_pesan_s"){
									include 'siswa/l_pesan_s.php';
								}
							}
						}else{
							if($page == 'd_siswa'){
								if($action == ""){
									include 'admin/data_s/d_siswa.php';
								}else if($action == "tambah"){
									include 'admin/data_s/t_siswa.php';
								}else if($action == "hapus"){
									include 'admin/data_s/h_siswa.php';
								}else if($action == "edit"){
									include 'admin/data_s/e_siswa.php';
								}else if($action == "impor"){
									include 'admin/impor/siswa.php';
								}else if($action == "u_foto"){
									include 'admin/upload/u_foto.php';
								}
							}else if($page == 'd_nilai'){
								if($action == ""){
									include 'admin/data_n/d_nilai.php';
								}else if($action == "tambah_n"){
									include 'admin/data_n/t_nilai.php';
								}else if($action == "hapus_n"){
									include 'admin/data_n/h_nilai.php';
								}else if($action == "edit_n"){
									include 'admin/data_n/e_nilai.php';
								}else if($action == "impor_n"){
									include 'admin/impor/nilai.php';
								}
							}else if($page == 'nilai_r'){
								if($action == ""){
									include 'admin/nilai_r/nilai_r.php';
								}else if($action == "tambah_n_r"){
									include 'admin/nilai_r/t_nilai_r.php';
								}else if($action == "hapus_n_r"){
									include 'admin/nilai_r/h_nilai_r.php';
								}else if($action == "edit_n_r"){
									include 'admin/nilai_r/e_nilai_r.php';
								}else if($action == "impor_n_r"){
									include 'admin/impor/rapor.php';
								}
							}else if($page == 'nilai_us'){
								if($action == ""){
									include 'admin/nilai_us/nilai_us.php';
								}else if($action == "tambah_n_us"){
									include 'admin/nilai_us/t_nilai_us.php';
								}else if($action == "hapus_n_us"){
									include 'admin/nilai_us/h_nilai_us.php';
								}else if($action == "edit_n_us"){
									include 'admin/nilai_us/e_nilai_us.php';
								}else if($action == "impor_n_us"){
									include 'admin/impor/n_sekolah.php';
								}
							}else if($page == 'd_user'){
								if($action == ""){
									include 'admin/data_u/d_user.php';
								}else if($action == "tambah_u"){
									include 'admin/data_u/t_user.php';
								}else if($action == "hapus_u"){
									include 'admin/data_u/h_user.php';
								}else if($action == "r_pass"){
									include 'admin/data_u/r_pass.php';
								}else if($action == "impor_u"){
									include 'admin/impor/user.php';
								}else if ($action == "a_status") {
									include 'admin/data_u/a_status.php';
								}else if ($action == "n_status") {
									include 'admin/data_u/n_status.php';
								}
							}else if($page == 'u_on'){
								if($action == ""){
									include 'admin/data_u/u_on.php';
								}else if($action == "hapus_u_o"){
									include 'admin/data_u/h_u_on.php';
								}
							}else if($page == 'info'){
								if($action == ""){
									include 'admin/info/d_info.php';
								}else if($action == "t_info"){
									include 'admin/info/t_info.php';
								}else if($action == "e_info"){
									include 'admin/info/e_info.php';
								}else if($action == "h_info"){
									include 'admin/info/h_info.php';
								}
							}else if($page == ''){
								include 'admin/info/i_admin.php';
							}else if($page == 'g_pass_admin'){
								include 'admin/g_pass_admin.php';
							}else if($page == 'k_saran'){
								include 'admin/k_saran.php';
							}else if($page == 'b_adm'){
								if($action == ""){
									include 'admin/adm/b_adm.php';
								}else if($action == "hapus_b"){
									include 'admin/adm/h_adm.php';
								}
							}else if($page == 'cp'){
								include 'admin/c_p.php';
							}else if($page == 'pesan'){
								if($action == ""){
									include 'admin/pesan/pesan.php';
								}else if($action == "b_pesan"){
									include 'admin/pesan/b_pesan.php';
								}else if($action == "h_pesan"){
									include 'admin/pesan/h_pesan.php';
								}
							}else if($page == 'cetak' ){
								include 'admin/daftar_skl.php';
							}
						}

						if($nama){
							if($page == 'd_admin'){
								if($action == ""){
									include 'admin/data_a/d_admin.php';
								}else if($action == "tambah_a"){
									include 'admin/data_a/t_admin.php';
								}else if($action == "r_pass_a"){
									include 'admin/data_a/r_pass_a.php';
								}else if($action == "hapus_a"){
									include 'admin/data_a/h_admin.php';
								}else if ($action == "on_admin") {
									include 'admin/data_a/on_admin.php';
								}else if ($action == "off_admin") {
									include 'admin/data_a/off_admin.php';
								}
							}else if($page == 'a_on'){
								if($action == ""){
									include 'admin/data_a/a_on.php';
								}else if($action == "hapus_a_o"){
									include 'admin/data_a/h_a_on.php';
								}
							}else if($page == 'info_a'){
								if($action == ""){
									include 'admin/info/d_info_a.php';
								}else if($action == "t_info_a"){
									include 'admin/info/t_info_a.php';
								}else if($action == "e_info_a"){
									include 'admin/info/e_info_a.php';
								}else if($action == "h_info_a"){
									include 'admin/info/h_info_a.php';
								}
							}else if($page == 'kosong'){
								include 'admin/drop/kosong.php';
							}else if($page == 'db'){
								include 'admin/drop/db.php';
							}else if($page == 'akses'){
								if($action == ""){
									include 'admin/akses/akses.php';
								}else if($action == "buka"){
									include 'admin/akses/buka.php';
								}else if($action == "tutup"){
									include 'admin/akses/tutup.php';
								}else if($action == "awal_login"){
									include 'admin/akses/awal_login.php';
								}else if($action == "awal_timer"){
									include 'admin/akses/awal_timer.php';
								}else if($action == "awal_maintenance"){
									include 'admin/akses/awal_maintenance.php';
								}
							}else if($page == 'history'){
								if($action == ""){
									include 'admin/history/history.php';
								}else if($action == "hapus_h"){
									include 'admin/history/h_history.php';
								}
							}
						}

						 ?>
					</div>
			</div>		
			<div class="footer">
				V.1.0 logged <b><?= $logged ?></b><br>
				&copy 2018 <i>Kali</i>
			</div>
		</center>
	</div>
</body>
</html>