<fieldset>
	<legend>Masukan Nilai USBN</legend>
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
				<td><input type="text" name="no_pes" placeholder="12-0xx-xxx-x" /></td>
			</tr>
			<tr>
				<td>PAI</td>
				<td>:</td>
				<td><input type="text" name="pai" /></td>
			</tr>
			<tr>
				<td>PPKN</td>
				<td>:</td>
				<td><input type="text" name="ppkn" /></td>
			</tr>
			<tr>
				<td>IND</td>
				<td>:</td>
				<td><input type="text" name="ind" /></td>
			</tr>
			<tr>
				<td>MTK</td>
				<td>:</td>
				<td><input type="text" name="mtk" /></td>
			</tr>
			<tr>
				<td>SEJIND</td>
				<td>:</td>
				<td><input type="text" name="sejind" /></td>
			</tr>
			<tr>
				<td>ING</td>
				<td>:</td>
				<td><input type="text" name="ing" /></td>
			</tr>
			<tr>
				<td>SENBUD</td>
				<td>:</td>
				<td><input type="text" name="senbud" /></td>
			</tr>
			<tr>
				<td>PJOK</td>
				<td>:</td>
				<td><input type="text" name="pjok" /></td>
			</tr>
			<tr>
				<td>PKWU</td>
				<td>:</td>
				<td><input type="text" name="pkwu" /></td>
			</tr>
			<tr>
				<td>MAT/SEJ</td>
				<td>:</td>
				<td><input type="text" name="mat_sej" /></td>
			</tr>
			<tr>
				<td>FIS/EKO</td>
				<td>:</td>
				<td><input type="text" name="fis_eko" /></td>
			</tr>
			<tr>
				<td>KIM/SOS</td>
				<td>:</td>
				<td><input type="text" name="kim_sos" /></td>
			</tr>
			<tr>
				<td>BIO/GEO</td>
				<td>:</td>
				<td><input type="text" name="bio_geo" /></td>
			</tr>
			<tr>
				<td>LM</td>
				<td>:</td>
				<td><input type="text" name="lm" /></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td>
					<button name="tambah" class="btn btn-success btn-sm">
						<span class="glyphicon glyphicon-saved"></span> Tambah
					</button>
					<button type="reset" class="btn btn-danger btn-sm">
						<span class="glyphicon glyphicon-repeat"></span> Reset
					</button>
					<a href="?page=<?= base64_encode("nilai_us"); ?>" class="btn btn-warning btn-sm">
						<span class="glyphicon glyphicon-remove"></span> Batal
					</a>
				</td>
			</tr>
		</table>

	</form>

	<?php

	$nama = strtoupper(@$_POST['nama']);
	$no_pes = @$_POST['no_pes'];
	$pai = @$_POST['pai'];
	$ppkn = @$_POST['ppkn'];
	$ind = @$_POST['ind'];
	$mtk  = @$_POST['mtk'];
	$sejind  = @$_POST['sejind'];
	$ing  = @$_POST['ing'];
	$senbud  = @$_POST['senbud'];
	$pjok  = @$_POST['pjok'];
	$pkwu  = @$_POST['pkwu'];
	$mat_sej  = @$_POST['mat_sej'];
	$fis_eko  = @$_POST['fis_eko'];
	$kim_sos  = @$_POST['kim_sos'];
	$bio_geo  = @$_POST['bio_geo'];
	$lm  = @$_POST['lm'];


	if(isset($_POST['tambah'])){
		if($nama == "" || $no_pes == "" || $pai == "" || $ppkn == "" || $ind == "" || $mtk == "" || $sejind == "" || $ing == "" || $senbud == "" || $pjok == "" || $pkwu == "" || $mat_sej == "" || $fis_eko == "" || $kim_sos == "" || $bio_geo == "" || $lm == ""){
			?>
			<script type="text/javascript"> 
				alert("Data tidak boleh ada yang kosong");
				window.location.href="?page=<?= base64_encode("nilai_us"); ?>&action=<?= base64_encode("tambah_n_us"); ?>"; 
			</script>

			<?php
		}else{
				mysqli_query($conn, "INSERT INTO t_n_sekolah VALUES('$nama', '$no_pes', '$pai', '$ppkn', '$ind', '$mtk', '$sejind', '$ing', '$senbud', '$pjok', '$pkwu', '$mat_sej', '$fis_eko', '$kim_sos', '$bio_geo', '$lm')");
				mysqli_query($conn, "INSERT INTO t_history VALUES('', 'tambah nilai USBN $nama', '$_SESSION[user]', NULL) ");
				?>
				<script type="text/javascript"> alert("Nilai sudah di tambah"); window.location.href="?page=<?= base64_encode("nilai_us"); ?>"; </script>

				<?php
			}
		}		
	?>

</fieldset>