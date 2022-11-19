<?php 

$kd = base64_decode(@$_GET['user']);
$sql = mysqli_query($conn, "SELECT * FROM t_ln_siswa WHERE no_pes = '$kd' ");
$sql1 = mysqli_query($conn, "SELECT * FROM t_luser WHERE user = '$kd' ");
$data = mysqli_fetch_assoc($sql);
$data1 = mysqli_fetch_assoc($sql1);
	
?>

<fieldset>
	<legend style="font-size: 30px;"><b>Data Nilai</b></legend>
	<div class="table-responsive">
		<table style="font-size:25px; padding: 20px 0;" align="center" class="table table-hover">
			<tr>
				<td>Nama Lengkap</td>
				<td>  :  </td>
				<td><b><?= $data['nama']; ?></b></td>
			</tr>
			<tr>
				<td>No Peserta</td>
				<td>  :  </td>
				<td><?= $data['no_pes']; ?></td>
			</tr>
			<tr>
				<td>B. Indonesia</td>
				<td>  :  </td>
				<td><?= $data['bin']; ?></td>
			</tr>
			<tr>
				<td>B. Inggris</td>
				<td>  :  </td>
				<td><?= $data['bing']; ?></td>
			</tr>
			<tr>
				<td>Matematika</td>
				<td>  :  </td>
				<td><?= $data['mat']; ?></td>
			</tr>
			<tr>
				<td>Pilihan</td>
				<td>  :  </td>
				<td><?= $data['pil']; ?></td>
			</tr>

		</table><br><br>
	</div>

			<?php
				$status = $data1['status'] == 'aktif';
				if($status){
				 ?>

				<a href="print/cetak_skl.php?user=<?= base64_encode($data['no_pes']); ?>" target="blank" class="btn btn-success btn-lg">
					<span class="glyphicon glyphicon-print"></span> Cetak Surat Kelulusan 
				</a>

			<?php }else{ ?>

				<a onclick="return confirm('Status Anda Belum Aktif. Silahkan Hubungi Admin')" href="?page=<?= base64_encode("un"); ?>&user=<?= base64_encode($_SESSION['user']);?>" class="btn btn-success btn-lg">
					<span class="glyphicon glyphicon-print"></span> Cetak Surat Kelulusan 
				</a>

			<?php } ?>

</fieldset>		