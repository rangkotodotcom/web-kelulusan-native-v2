<?php

$kd = base64_decode(@$_GET['id']);

mysqli_query($conn, "DELETE FROM t_history WHERE id = '$kd' ");

?>

<script type="text/javascript">
	window.location.href="?page=<?= base64_encode("history"); ?>";
</script>