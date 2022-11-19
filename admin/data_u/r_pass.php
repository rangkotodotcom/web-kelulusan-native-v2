<?php

$kd = base64_decode(@$_GET['nama']);

$cek = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM t_online WHERE nama = '$kd' "));

if(!isset($_POST['reset'])){
	if($cek > 0){
		echo "
				<script>
					alert('Tidak bisa Mereset Password. User tersebut sedang login');
					document.location.href = '?page=".base64_encode("d_user")."';
				</script>
			 ";
	}else{
		$pass = kodeAcak(8);

		$r_pass = mysqli_query($conn, "UPDATE t_luser SET pass = '$pass', ganti = 'belum' WHERE nama = '$kd' ");
		mysqli_query($conn, "INSERT INTO t_history VALUES('', 'reset pass user $kd', '$_SESSION[user]', NULL) ");


		if($r_pass){
			echo "
					<script>
						alert('Password Berhasil di reset.');
						document.location.href = '?page=".base64_encode("d_user")."';
					</script>
				 ";
		}
	}
}

?>