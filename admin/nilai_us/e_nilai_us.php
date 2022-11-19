<?php

$kd = base64_decode(@$_GET['nama']);
$sql = mysqli_query($conn, "SELECT * FROM t_n_sekolah WHERE nama = '$kd' ");
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
				<td>PAI</td>
				<td>:</td>
				<td><input type="text" name="pai" value="<?= $data['pai']; ?>" /></td>
			</tr>
			<tr>
				<td>PPKN</td>
				<td>:</td>
				<td><input type="text" name="ppkn" value="<?= $data['ppkn']; ?>" /></td>
			</tr>
			<tr>
				<td>IND</td>
				<td>:</td>
				<td><input type="text" name="ind" value="<?= $data['ind']; ?>" /></td>
			</tr>
			<tr>
				<td>MTK</td>
				<td>:</td>
				<td><input type="text" name="mtk" value="<?= $data['mtk']; ?>" /></td>
			</tr>
			<tr>
				<td>SEJIND</td>
				<td>:</td>
				<td><input type="text" name="sejind" value="<?= $data['sejind']; ?>" /></td>
			</tr>
			<tr>
				<td>ING</td>
				<td>:</td>
				<td><input type="text" name="ing" value="<?= $data['ing']; ?>" /></td>
			</tr>
			<tr>
				<td>SENBUD</td>
				<td>:</td>
				<td><input type="text" name="senbud" value="<?= $data['senbud']; ?>" /></td>
			</tr>
			<tr>
				<td>PJOK</td>
				<td>:</td>
				<td><input type="text" name="pjok" value="<?= $data['pjok']; ?>" /></td>
			</tr>
			<tr>
				<td>PKWU</td>
				<td>:</td>
				<td><input type="text" name="pkwu" value="<?= $data['pkwu']; ?>" /></td>
			</tr>
			<tr>
				<td>MATK/SEJ</td>
				<td>:</td>
				<td><input type="text" name="mat_sej" value="<?= $data['mat_sej']; ?>" /></td>
			</tr>
			<tr>
				<td>FIS/EKO</td>
				<td>:</td>
				<td><input type="text" name="fis_eko" value="<?= $data['fis_eko']; ?>" /></td>
			</tr>
			<tr>
				<td>KIM/SOS</td>
				<td>:</td>
				<td><input type="text" name="kim_sos" value="<?= $data['kim_sos']; ?>" /></td>
			</tr>
			<tr>
				<td>BIO/GEO</td>
				<td>:</td>
				<td><input type="text" name="bio_geo" value="<?= $data['bio_geo']; ?>" /></td>
			</tr>
			<tr>
				<td>LM</td>
				<td>:</td>
				<td><input type="text" name="lm" value="<?= $data['lm']; ?>" /></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td>
					<button name="edit" class="btn btn-success btn-sm">
						<span class="glyphicon glyphicon-saved"></span> Simpan
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
	$mtk = @$_POST['mtk'];
	$sejind = @$_POST['sejind'];
	$ing = @$_POST['ing'];
	$senbud = @$_POST['senbud'];
	$pjok = @$_POST['pjok'];
	$pkwu = @$_POST['pkwu'];
	$mat_sej = @$_POST['mat_sej'];
	$fis_eko = @$_POST['fis_eko'];
	$kim_sos = @$_POST['kim_sos'];
	$bio_geo = @$_POST['bio_geo'];
	$lm = @$_POST['lm'];


	if(isset($_POST['edit'])){
		if($nama == "" || $no_pes == "" || $pai == "" || $ppkn == "" || $ind == "" || $mtk == "" || $sejind == "" || $ing == "" || $senbud == "" || $pjok == "" || $pkwu == "" || $mat_sej == "" || $fis_eko == "" || $kim_sos == "" || $bio_geo == "" || $lm == ""){
			?>
			<script type="text/javascript"> 
				alert("Data tidak boleh ada yang kosong"); 
				window.location.href="?page=<?= base64_encode("nilai_us"); ?>&action=<?= base64_encode("edit_n_us"); ?>&nama=<?= base64_encode($data['nama']); ?>";
			</script>

			<?php
		}else{
				mysqli_query($conn, "UPDATE t_n_sekolah SET nama = '$nama', no_pes = '$no_pes', pai = '$pai', ppkn = '$ppkn', ind = '$ind', mtk = '$mtk', sejind = '$sejind', ing = '$ing', senbud = '$senbud', pjok = '$pjok', pkwu = '$pkwu', mat_sej = '$mat_sej', fis_eko = '$fis_eko', kim_sos = '$kim_sos', bio_geo = '$bio_geo', lm = '$lm' WHERE nama = '$kd' ");
				mysqli_query($conn, "INSERT INTO t_history VALUES('', 'edit nilai USBN $nama', '$_SESSION[user]', NULL) ");
				?>
				<script type="text/javascript"> alert("Nilai sudah di Edit"); window.location.href="?page=<?= base64_encode("nilai_us"); ?>"; </script>

				<?php
			}
	}

	?>


</fieldset>