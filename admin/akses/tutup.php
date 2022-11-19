<?php 

$kd = base64_decode(@$_GET['id']);

if(!isset($_POST['tutup'])){
	mysqli_query($conn, "UPDATE t_izin_login SET akses = 'buka' WHERE id = '$kd' ");
}

echo "<script>window.location.href='?page=".base64_encode('akses')."';</script>";

 ?>