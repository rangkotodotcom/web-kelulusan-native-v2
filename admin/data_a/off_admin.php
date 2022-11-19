<?php

$kd = base64_decode(@$_GET['nama']);

if(!isset($_POST['non-aktif'])){
	mysqli_query($conn, "UPDATE t_luser SET status = 'aktif' WHERE nama = '$kd' ");
}

echo "<script>window.location.href='?page=".base64_encode('d_admin')."';</script>";

 ?>