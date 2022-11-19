<?php


$kd = base64_decode(@$_GET['nama']);
$sql = mysqli_query($conn, "SELECT * FROM t_adm WHERE nama= '$kd' ");
$data = mysqli_fetch_assoc($sql);

$nama = ucwords($data['nama']);
$komite = $data['komite']; 
$pustaka = $data['pustaka'];

unlink('img/adm/' .$komite);
unlink('img/adm/' .$pustaka);


mysqli_query($conn, "DELETE FROM t_adm WHERE nama = '$kd' ");
mysqli_query($conn, "INSERT INTO t_history VALUES('', 'hapus bukti adm $nama', '$_SESSION[user]', NULL) ");

?>

<script type="text/javascript">
	window.location.href="?page=<?= base64_encode("b_adm"); ?>";
</script>