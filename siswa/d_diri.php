<?php

$kd = base64_decode(@$_GET['user']);
$sql = mysqli_query($conn, "SELECT * FROM t_ld_siswa WHERE no_pes = '$kd' ");
$data = mysqli_fetch_assoc($sql);

?>

<fieldset>
	<legend style="font-size: 30px;"><b>Data Diri</b></legend>
	<div class="table-responsive">
		<table style="font-size:25px; padding: 20px 0;" align="center" class="table table-hover">
			<tr>
				<td>Nama Lengkap</td>
				<td>  :  </td>
				<td><b><?= $data['nama']; ?></b></td>
			</tr>
			<tr>
				<td>Tempat, Tanggal Lahir</td>
				<td>  :  </td>
				<td><?= $data['t_lahir']; ?>, <?= $data['tgl_lhr']; ?></td>
			</tr>
			<tr>
				<td>Nama Orang Tua</td>
				<td>  :  </td>
				<td><?= $data['n_ortu']; ?></td>
			</tr>
			<tr>
				<td>NIS</td>
				<td>  :  </td>
				<td><?= $data['nis']; ?></td>
			</tr>
			<tr>
				<td>NISN</td>
				<td>  :  </td>
				<td><?= $data['nisn']; ?></td>
			</tr>
			<tr>
				<td>No Peserta</td>
				<td>  :  </td>
				<td><?= $data['no_pes']; ?></td>
			</tr>
			
		</table>
	</div>
</fieldset>