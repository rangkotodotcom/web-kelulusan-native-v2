<?php 

mysqli_query($conn, "UPDATE t_izin_login SET awal = 'timer' ");

 ?>

 <script type="text/javascript">
	window.location.href="?page=<?= base64_encode("akses"); ?>";
</script>