<?php

$kd = base64_decode(@$_GET['nama']);
$sql = mysqli_query($conn, "SELECT * FROM t_ln_siswa WHERE nama = '$kd' ");
$data = mysqli_fetch_assoc($sql);

?>

<fieldset>
	<legend>Edit Nilai Siswa</legend>
	<link rel="stylesheet" type="text/css" href="css/tambah.css">

	<form action="" method="post">
		<table class="table table-striped" width="100%">
			<tr>
				<td>Nama Siswa</td>
				<td>:</td>
				<td><input type="text" name="nama" value="<?= $data['nama']; ?>" autocomplete="off" /></td>
			</tr>
			<tr>
				<td>No peserta</td>
				<td>:</td>
				<td><input type="text" name="no_pes" value="<?= $data['no_pes']; ?>" readonly /></td>
			</tr>
			<tr>
				<td>B Indonesia</td>
				<td>:</td>
				<td><input type="text" name="bin" value="<?= $data['bin']; ?>" /></td>
			</tr>
			<tr>
				<td>B Inggris</td>
				<td>:</td>
				<td><input type="text" name="bing" value="<?= $data['bing']; ?>" /></td>
			</tr>
			<tr>
				<td>Matematika</td>
				<td>:</td>
				<td><input type="text" name="mat" value="<?= $data['mat']; ?>" /></td>
			</tr>
			<tr>
				<td>Pilihan</td>
				<td>:</td>
				<td><input type="text" name="pil" value="<?= $data['pil']; ?>" /></td>
			</tr>
			<tr>
				<td>Keterangan</td>
				<td>:</td>
				<td>
					<input type="radio" name="ket" value="LULUS" <?php if($data['ket'] == 'LULUS') {echo "checked";} ?> /> Lulus <br>
					<input type="radio" name="ket" value="TIDAK LULUS" <?php if($data['ket'] == 'TIDAK LULUS') {echo "checked";} ?> /> Tidak Lulus
				</td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td>
					<button name="edit" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-saved"></span> Simpan</button>
					<button type="reset" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-repeat"></span> Reset</button>
					<a href="?page=<?= base64_encode("d_nilai"); ?>" class="btn btn-warning btn-sm"><span class="glyphicon glyphicon-remove"></span> Batal</a>
				</td>
			</tr>
		</table>

	</form>

	<?php

	$nama = strtoupper(@$_POST['nama']);
	$no_pes = @$_POST['no_pes'];
	$bin = @$_POST['bin'];
	$bing = @$_POST['bing'];
	$mat = @$_POST['mat'];
	$pil = @$_POST['pil'];
	$ket = @$_POST['ket'];


	if(isset($_POST['edit'])){
		if($nama == "" || $no_pes == "" || $bin == "" || $bing == "" || $mat == "" || $pil == "" || $ket == ""){
			?>
			<script type="text/javascript"> 
			alert("Data tidak boleh ada yang kosong"); 
			window.location.href="?page=<?= base64_encode("d_nilai"); ?>&action=<?= base64_encode("edit_n"); ?>&nama=<?= base64_encode($data['nama']); ?>";
		</script>

			<?php
		}else{
				mysqli_query($conn, "UPDATE t_ln_siswa SET nama = '$nama', no_pes = '$no_pes', bin = '$bin', bing = '$bing', mat = '$mat', pil = '$pil', ket = '$ket' WHERE nama = '$kd' ");
				mysqli_query($conn, "INSERT INTO t_history VALUES('', 'edit nilai $nama', '$_SESSION[user]', NULL) ");
				?>
				<script type="text/javascript"> alert("Nilai sudah di Edit"); window.location.href="?page=<?= base64_encode("d_nilai"); ?>"; </script>

				<?php
			}
	}

	?>


</fieldset>