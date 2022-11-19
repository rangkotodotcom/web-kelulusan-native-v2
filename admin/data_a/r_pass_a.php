<?php

$kd = base64_decode(@$_GET['nama']);

$cek = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM t_online WHERE nama = '$kd' "));

if(!isset($_POST['reset'])){
	if($cek > 0){
		echo "
				<script>
					alert('Tidak bisa Mereset Password. User tersebut sedang login');
					document.location.href = '?page=".base64_encode('d_admin')."';
				</script>
			 ";
	}else{
		$pas = kodeAcak(8);
		$pass = password_hash($pas, PASSWORD_DEFAULT);

		$r_pass = mysqli_query($conn, "UPDATE t_luser SET pass = '$pass', ganti = 'belum' WHERE nama = '$kd' ");

		if($r_pass){
			echo "
					<script>
						alert('Password Berhasil di reset. Password ".$kd." adalah ".$pas." ');
						document.location.href = '?page=".base64_encode("d_admin")."';
					</script>
				 ";
		}
	}
}

?>