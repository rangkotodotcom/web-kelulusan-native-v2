<?php

$kd = base64_decode(@$_GET['id']);

$sql = mysqli_query($conn, "SELECT * FROM t_linfo WHERE id = '$kd' ");
$data = mysqli_fetch_assoc($sql);
$subjek = $data['subjek'];


mysqli_query($conn, "DELETE FROM t_linfo WHERE id = '$kd' ");

mysqli_query($conn, "INSERT INTO t_history VALUES('', 'hapus info $subjek', '$_SESSION[user]', NULL) ");

?>

<script type="text/javascript">
	window.location.href="?page=<?= base64_encode("info"); ?>";
</script>