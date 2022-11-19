<?php

	date_default_timezone_set('Asia/Jakarta');

	$conn = mysqli_connect('localhost', 'root', '', 'lulus');
	if(!$conn){
	echo "alun konek";
}
?>