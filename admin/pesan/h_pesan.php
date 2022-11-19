<?php

$kd = base64_decode(@$_GET['pengirim']);

mysqli_query($conn, "UPDATE t_pesan SET penerima = '' WHERE pengirim = '$kd' ");

?>

<script type="text/javascript">
	window.location.href="?page=<?= base64_encode("pesan"); ?>";
</script>