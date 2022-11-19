<?php

	include 'conn.php';

	session_start();

	if($_SESSION['user'] != 'admin'){

	mysqli_query($conn, "DELETE FROM t_online WHERE user = '$_SESSION[user]' ");

	}
	$_SESSION = [];
	session_unset();
	session_destroy();

?>

<script type="text/javascript">
 window.location.href="index.php";
</script>