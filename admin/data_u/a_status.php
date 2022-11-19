<?php 

$kd = base64_decode(@$_GET['nama']);

if(!isset($_POST['non-aktif'])){
	mysqli_query($conn, "UPDATE t_luser SET status = 'non-aktif' WHERE nama = '$kd' ");
	mysqli_query($conn, "INSERT INTO t_history VALUES('', 'non-aktif user $kd', '$_SESSION[user]', NULL) ");
}

echo "<script>window.location.href='?page=".base64_encode("d_user")."';</script>";

 ?>