<?php

$kd = base64_decode(@$_GET['nama']);

mysqli_query($conn, "DELETE FROM t_luser WHERE nama = '$kd' ");

?>

<script type="text/javascript">
	window.location.href="?page=<?= base64_encode('d_admin')?>";
</script>