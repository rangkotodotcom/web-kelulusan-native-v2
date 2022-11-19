<?php

$kd = base64_decode(@$_GET['nisn']);
$sql = mysqli_query($conn, "SELECT * FROM t_ld_siswa WHERE nisn= '$kd' ");
$data = mysqli_fetch_assoc($sql);

$nama = $data['nama'];
$foto = $data['foto'];

unlink('img/siswa/' .$foto);


mysqli_query($conn, "DELETE FROM t_ld_siswa WHERE nisn = '$kd' ");
mysqli_query($conn, "INSERT INTO t_history VALUES('', 'hapus data $nama', '$_SESSION[user]', NULL) ");

?>

<script type="text/javascript">
	window.location.href="?page=<?= base64_encode("d_siswa"); ?>";
</script>