<fieldset>
	<legend>Masukan Nilai</legend>
	<link rel="stylesheet" type="text/css" href="css/tambah.css">

	<form action="" method="post">
		<table class="table table-striped" width="100%">
			<tr>
				<td>Nama Siswa</td>
				<td>:</td>
				<td><input type="text" name="nama" /></td>
			</tr>
			<tr>
				<td>No Peserta</td>
				<td>:</td>
				<td><input type="text" name="no_pes" placeholder="12-004-xxx-x" /></td>
			</tr>
			<tr>
				<td>B. Indonesia</td>
				<td>:</td>
				<td><input type="text" name="bin" /></td>
			</tr>
			<tr>
				<td>B. Inggris</td>
				<td>:</td>
				<td><input type="text" name="bing" /></td>
			</tr>
			<tr>
				<td>Matematika</td>
				<td>:</td>
				<td><input type="text" name="mat" /></td>
			</tr>
			<tr>
				<td>Pilihan</td>
				<td>:</td>
				<td><input type="text" name="pil" /></td>
			</tr>
			<tr>
				<td>Keterangan</td>
				<td>:</td>
				<td>
					<input type="radio" name="ket" value="LULUS" /> Lulus <br>
					<input type="radio" name="ket" value="TIDAK LULUS" /> Tidak Lulus
				</td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td>
					<button name="tambah" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-saved"></span> Tambah</button>
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
	$pil  = @$_POST['pil'];
	$ket  = @$_POST['ket'];


	if(isset($_POST['tambah'])){
		if($nama == "" || $no_pes == "" || $bin == "" || $bing == "" || $mat == "" || $pil == "" || $ket == ""){
			?>
			<script type="text/javascript"> 
				alert("Data tidak boleh ada yang kosong");
				window.location.href="?page=<?= base64_encode("d_nilai"); ?>&action=<?= base64_encode("tambah_n"); ?>"; 
			</script>

			<?php
		}else{
				mysqli_query($conn, "INSERT INTO t_ln_siswa VALUES('$nama', '$no_pes', '$bin', '$bing', '$mat', '$pil', '$ket')");
				mysqli_query($conn, "INSERT INTO t_history VALUES('', 'tambah nilai $nama', '$_SESSION[user]', NULL) ");
				?>
				<script type="text/javascript"> alert("Nilai sudah di tambah"); window.location.href="?page=<?= base64_encode("d_nilai"); ?>"; </script>

				<?php
			}
		}		
	?>



</fieldset>