<?php

$kd = base64_decode(@$_GET['nama']);

mysqli_query($conn, "DELETE FROM t_luser WHERE nama = '$kd' ");
mysqli_query($conn, "INSERT INTO t_history VALUES('', 'hapus user $kd', '$_SESSION[user]', NULL) ");

?>

<script type="text/javascript">
	window.location.href="?page=<?= base64_encode("d_user"); ?>";
</script>