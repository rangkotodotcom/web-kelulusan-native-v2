<?php 
include 'conn.php';

$sql = mysqli_query($conn, "SELECT * FROM t_izin_login");
$data = mysqli_fetch_assoc($sql);

if($data['awal'] == 'login'){
	include 'login.php';
}else if($data['awal'] == 'timer'){
	include 'timer.php';
}else if($data['awal'] == 'maintenance'){
	include 'maintenance.php';
}

 ?>